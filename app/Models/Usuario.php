<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    use Uuid;
    use Traits\Scope;

    protected $table = 'usuario';
    // protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome",
        "username",
        "email",
        "data_nascimento",
        "email_verified_at",
        "avatar",
        "status",
    ];

    /**
     * Attributes that are mass assignable.
     *
     * @var  array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email-verified_at'
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
