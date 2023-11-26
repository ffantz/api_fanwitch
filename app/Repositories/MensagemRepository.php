<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class MensagemRepository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return Mensagem::class;
    }

    public static function getPrimaryKeyName(): string
    {
        return (new Mensagem())->getKeyName();
    }

    public static function initialize($with = []): Collection
    {
        return Mensagem::where('id_usuario_remetente', \Auth::user()->id)
            ->orWhere('id_usuario_destinatario', \Auth::user()->id)
            ->get()
            ;
    }
}
