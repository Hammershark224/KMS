<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        // 'firstname',
        // 'lastname',
        'email',
        'password',
        'gender',
        // 'address',
        // 'city',
        // 'country',
        // 'postal',
        // 'about'
        'phone_num',
        'ic',
        'role'
    ];


    //specifying user table primary key
    protected $primaryKey = "user_ID";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function parent()
    {
        return $this->hasOne(ParentDetail::class, 'user_ID');
    }

    public function staff()
    {
        return $this->hasOne(StaffDetail::class, 'user_ID');
    }

    public function parentDetail()
    {
        return $this->hasOne(ParentDetail::class, 'user_ID');
    }

    public function role()
    {
    return $this->belongsTo(Role::class);
    }
}