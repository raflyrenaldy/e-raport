<?php
namespace App\Traits;
use App\Model\User;
use Storage;
use Auth;

trait UserTrait {

public function getRolesNameAttribute(){
        return User::getStatus($this->roles_id);
    }

    public function getAvatarlinkAttribute()
    {
        return asset('assets/img/avatar/avatar-1.png');
    }

    public function getIsmeAttribute()
    {
        if(Auth::check() && Auth::id() == $this->id)
        {
            return true;
        }
        return false;
    }
}
