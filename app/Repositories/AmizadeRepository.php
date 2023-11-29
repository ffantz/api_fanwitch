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

    public static function getPrimaryKeyName(): string
    {
        return (new Amizade())->getKeyName();
    }

    public static function buscaPedidoAmizade($usuarioSolicitante): Amizade
    {
        return Amizade::where("id_usuario", $usuarioSolicitante)
            ->where("id_usuario_adicionado", \Auth::user()->id)
            ->first();
    }

    public static function buscaAmizade($dados): Amizade
    {
        return Amizade::where(function ($query) use ($dados) {
            $query->where("id_usuario", $dados["id_usuario"]);
            $query->where("id_usuario_adicionado", $dados["id_usuario_adicionado"]);
        })
            ->orWhere(function ($query) use ($dados) {
                $query->where("id_usuario_adicionado", $dados["id_usuario"]);
                $query->where("id_usuario", $dados["id_usuario_adicionado"]);
        })
            ->first();
    }
}
