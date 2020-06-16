<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Spatie\Permission\Traits\HasRoles;
use App\Traits\UserTrait;

class User extends Authenticatable
{
    use Notifiable;
//    use HasRoles;
    use UserTrait;

    const ADMIN             = 1;
    const STUDENT           = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'roles_id',
    ];

    protected $appends = ['isme', 'rolesname', 'Avatarlink'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//        'data'              => 'array',
//    ];

    public function getStatusNameAttribute(){
        return $this->getStatus($this->status);
    }

    public static function getStatus($status)
    {
        switch ($status) {
            case self::ADMIN:
                return "Admin";
            case self::STUDENT:
                return "Student";
            default: break;
        }
    }
}
