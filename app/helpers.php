<?php

use App\Model\User;
use App\Model\Nasabah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

if (! function_exists('rupiah_format')) {
    function rupiah_format($number) {
        return number_format($number, 0, ',', '.');
    }
}

if (! function_exists('idr')) {
    function idr($number) {
        return 'IDR '.rupiah_format($number);
    }
}

if (! function_exists('df')) {
    function df($var) {
        print_r($var); die;
    }
}

if (! function_exists('dm')) {
    function dm($var) {
        print_r($var->toArray()); die;
    }
}

if (! function_exists('dbl')) {
    function dbl() {
        DB::connection()->enableQueryLog();
    }
}

if (! function_exists('dbq')) {
    function dbq() {
        df(DB::getQueryLog());
    }
}

if (! function_exists('generateSignatureId')) {
    function generateSignatureId() {
        $last = Nasabah::orderBy('id', 'desc')->first();

        if (!$last) {
            $result = str_pad(1, 5, '0', STR_PAD_LEFT);
        }
        else {
            $id = $last->signature_id;
            $result = str_pad($id + 1, 5, '0', STR_PAD_LEFT);
        }
        return "{$result}";
    }
}


 if (! function_exists('setFileUrl')) {
     function setFileUrl($file) {
         return ($file) ? asset(Storage::disk('public')->url($file)) : null;
     }
 }

 if (! function_exists('storeFile')) {
     function storeFile($path, $file) {
         return ($file && $path) ? Storage::disk('public')->putFile($path, $file) : false;
     }
 }


if (! function_exists('dictionary')) {
    function dictionary() {
        return [
            'key1'  => 'isi 1',
            'key2'  => 'isi 2',
            'key3'  => 'isi 3'
        ];
    }
}


 if (! function_exists('storeFile64')) {
     function storeFile64($path, $file) {
         $base64 = explode(',', $file)[1];
         if ($file && $path) {
             $temp = 'tmp/'.Str::random(40);
             Storage::put($temp, base64_decode($base64));
             $result = storeFile($path, new File(storage_path('app/'.$temp)));
             Storage::delete($temp);
             return $result;
         }
     }
 }

 if (! function_exists('storeFileUrl')) {
     function storeFileUrl($path, $file) {
         if ($file && $path) {
             $temp = 'tmp/'.Str::random(40);
             Storage::put($temp, file_get_contents($file));
             $result = storeFile($path, new File(storage_path('app/'.$temp)));
             Storage::delete($temp);
             return $result;
         }
     }
 }

 if (! function_exists('deleteFile')) {
     function deleteFile($path) {
         return ($path) ? Storage::disk(env('DISK_INSTANCE'), 'public')->delete($path) : false;
     }
 }

if (! function_exists('downloadFile')) {
    function downloadFile($path) {
        return ($path) ? Storage::disk(env('DISK_INSTANCE'), 'public')->download($path) : false;
    }
}

if (! function_exists('setDefaultAvatar')) {
    function setDefaultAvatar() {
        $avatar = setFileUrl('avatar/avatar_default.png');
        return $avatar;
    }
}

if (! function_exists('getLongUnitText')) {
    function getLongUnitText($unit) {
        switch ($unit) {
            case 1: return 'milligrams'; break;
            case 2: return 'grams'; break;
            case 3: return 'litre'; break;
            case 4: return 'millilitre'; break;
            case 5: return 'teaspoon'; break;
            case 6: return 'tablespoon'; break;
            default: return 'undefined'; break;
        }
    }
}

if (! function_exists('getUnitText')) {
    function getUnitText($unit) {
        switch ($unit) {
            case 1: return 'mg'; break; // MILLIGRAMS
            case 2: return 'g'; break; // GRAMS
            case 3: return 'l'; break; // MILLILITRE
            case 4: return 'ml'; break; // LITRE
            case 5: return 'tsp'; break; // TEASPOON
            case 6: return 'tbsp'; break; // TABLESPOON
            default: return 'undefined'; break;
        }
    }
}

if (! function_exists('getMonthName')) {
    function getMonthName($month) {
        $dateObj = DateTime::createFromFormat('!m', $month);
        return $dateObj->format('F');
    }
}

if (! function_exists('getDayNumber')) {
    function getDayNumber($day) {
        $dateObj = DateTime::createFromFormat('j', $day);
        return $dateObj->format('N');
    }
}

if (! function_exists('getDayName')) {
    function getDayName($day) {
        $dateObj = DateTime::createFromFormat('j', $day);
        return $dateObj->format('l');
    }
}

if (! function_exists('getHourName')) {
    function getHourName($hour) {
        $dateObj = DateTime::createFromFormat('!G', $hour);
        return $dateObj->format('H:i');
    }
}


if (! function_exists('timeAgo')) {
    function timeAgo($timestamp) {
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->y > 0){
            $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');
        }
        else if($diff->m > 0){
            $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
        }
        else if($diff->d > 0){
            $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
        }
        else if($diff->h > 0){
            $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
        }
        else if($diff->i > 0){
            $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
        }
        else if($diff->s > 0){
            $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
        }

        $timemsg = $timemsg.' ago';
        return $timemsg;
    }
}

if (! function_exists('convertDate')) {
    function convertDate($timestamp) {
        $date = new DateTime();
        $match_date = new DateTime($timestamp);
        $interval = $date->diff($match_date);

        if($interval->days == 0) {
            return 'Today';
        } elseif($interval->days == 1) {
            return 'Yesterday';
        } else {
            return 'Sometime';
        }
    }
}

