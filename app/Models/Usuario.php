<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
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
        'password'
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
