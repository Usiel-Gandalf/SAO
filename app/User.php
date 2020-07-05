<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol(){
        return User::get()->rol;
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function scopeNameUser($query, $nameUser)
    {
        if ($nameUser) {
            return $query->where('nameUser', 'LIKE', "%$nameUser%");
        }
    }

    public function scopeFirstSurnameUser($query, $firstSurnameUser)
    {
        if ($firstSurnameUser) {
            return $query->where('firstSurname', 'LIKE', "%$firstSurnameUser%");
        }
    }

    public function scopeSecondSurnameUser($query, $secondSurnameUser)
    {
        if ($secondSurnameUser) {
            return $query->where('secondSurname', 'LIKE', "%$secondSurnameUser%");
        }
    }

    public function scopeRol($query, $rol)
    {
        if ($rol) {
            return $query->where('rol', 'LIKE', "%$rol%");
        }
    }

    public function scopeEmail($query, $email)
    {
        if ($email) {
            return $query->where('email', 'LIKE', "%$email%");
        }
    }
}
