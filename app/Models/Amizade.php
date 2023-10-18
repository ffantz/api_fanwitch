<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasCompositePrimaryKey;

class Amizade extends Model
{
    use Uuid;
    use HasCompositePrimaryKey;

    protected $table = 'amizade';
    public $incrementing = false;
    protected $primaryKey = [ "id_usuario", "id_usuario_adicionado" ];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_usuario",
        "id_usuario_adicionado",
        "status",
    ];
}
