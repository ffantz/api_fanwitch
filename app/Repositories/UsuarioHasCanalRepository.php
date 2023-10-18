<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UsuarioHasCanal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class UsuarioHasCanalRepository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return UsuarioHasCanal::class;
    }

    public static function getPrimaryKeyName() : string
    {
        return (new UsuarioHasCanal)->getKeyName();
    }
}

