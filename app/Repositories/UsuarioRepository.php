<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class UsuarioRepository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return Usuario::class;
    }

    public static function getPrimaryKeyName(): string
    {
        return (new Usuario())->getKeyName();
    }
}
