<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//use App\Traits\NasabahTrait;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{

//    use NasabahTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    protected $fillable = [
        'nis',
        'user_id',
        'username',
        'class_id',
        'path_download'
    ];

//    protected $appends = [
//        'status_name',
//        'ktp_link',
//        'npwp_link',
//        'profilelink',
//        'default_pict',
//        'edit_customer',
//        'marketings_name'
//    ];

    /**
     * Get marketing data
     */
    public function get_user()
    {
        return $this->belongsTo('App\Model\User','user_id');
    }

    public function get_class()
    {
        return $this->belongsTo('App\Model\Class','class_id');
    }


}
