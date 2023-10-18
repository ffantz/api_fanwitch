<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Amizade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class AmizadeRepository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return Amizade::class;
    }

    public static function getPrimaryKeyName() : string
    {
        return (new Amizade)->getKeyName();
    }
}

