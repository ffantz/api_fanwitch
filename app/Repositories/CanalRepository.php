<?php
namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Canal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class CanalRepository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return Canal::class;
    }

    public static function getPrimaryKeyName() : string
    {
        return (new Canal)->getKeyName();
    }
}

