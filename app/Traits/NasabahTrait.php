<?php
namespace App\Traits;

use App\Model\Nasabah;
use App\Model\User;
use Storage;

trait NasabahTrait {

    public function getProfilelinkAttribute()
    {
        return route('marketing.customers.show', ['customer' => $this->id]);
    }

    public function getEditCustomerAttribute()
    {
        return route('marketing.customers.edit', ['customer' => $this->id]);
    }

    public function getStatusNameAttribute(){
        return Nasabah::getStatus($this->status);
    }

    public function getKtpLinkAttribute()
    {
        if(Storage::disk('public')->exists($this->image_ktp))
        {
            return Storage::disk('public')->url($this->image_ktp);
        }
        return '';
    }

    public function getNpwpLinkAttribute()
    {
        if(Storage::disk('public')->exists($this->image_npwp))
        {
            return Storage::disk('public')->url($this->image_npwp);
        }
        return '';
    }

    public function getDefaultPictAttribute()
    {
        return asset('assets/img/avatar/avatar-1.png');
    }

    public function getMarketingsNameAttribute()
    {
        return User::where('id', $this->user_id)->select('name')->first() ? User::where('id', $this->user_id)->select('name')->first()->name : '';
    }

}
