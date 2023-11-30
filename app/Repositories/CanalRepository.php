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

    public static function getPrimaryKeyName(): string
    {
        return (new Canal())->getKeyName();
    }

    public static function initialize($with = []): ?Collection
    {
        return Canal::with($with)
            ->orderBy('status', 'DESC')
            ->get();
    }

    public static function buscaCanaisRecomendados(): ?Collection
    {
        return Canal::select('canal.*')
            ->orderBy('status', 'DESC')
            ->join('usuario_has_canal AS uhc', 'uhc.id_canal', '=', 'canal.id')
            ->where('uhc.id_usuario', \Auth::user()->id)
            ->where('uhc.recomendado', '1')
            ->get();
    }

    public static function updateOrCreate($dados): ?Collection
    {
        return Canal::updateOrCreate([
            'id_usuario' => $dados['id_usuario']
        ], [
            $dados
        ]);
    }

    public static function pesquisar($nome, $with = []): ?Collection
    {
        return Canal::where('nome_canal', 'like', '%' . $nome . '%')
            ->orWhere('username', 'like', '%' . $nome . '%')
            ->with($with)
            ->get();
    }
}
