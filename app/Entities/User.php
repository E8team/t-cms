<?php

namespace App\Entities;

use App\Entities\Traits\Listable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Ty666\PictureManager\Traits\Picture;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable, Picture, Listable;
    use EntrustUserTrait {
        restore as private restoreEntrust;
        EntrustUserTrait::can as may;
        Authorizable::can insteadof EntrustUserTrait;
    }

    protected static $allowSortFields = ['id', 'user_name', 'nick_name', 'created_at', 'is_locked'];
    protected static $allowSearchFields = ['id', 'user_name', 'nick_name', 'email'];

    protected $casts = [
        'is_locked' => 'boolean'
    ];
    //use SoftDeletes { restore as private restoreSoftDelete; }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'nick_name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * For EntrustUserTrait and SoftDeletes conflict
     */
    public function restore()
    {
        $this->restoreEntrust();
        //$this->restoreSoftDelete();
    }

    public function getAvatarAttribute($value)
    {
        return $this->getPicure($value, ['is', 'xs', 'l'], asset('images/default_avatar.jpg'));
    }
}
