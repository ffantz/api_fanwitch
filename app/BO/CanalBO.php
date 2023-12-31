<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\CanalRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\CanalTrait;
use App\Models\Canal;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class CanalBO
{
    use CanalTrait;
    use Uuid;

    private $prosseguir;
    private $canal;

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): object
    {
        $listaCanais = [];
        $canais = CanalRepository::initialize([ 'usuario', 'seguidores' ]);
        foreach ($canais as $canal) {
            $listaCanais[] = [
                'id'            => $canal->id,
                'uuid'          => $canal->uuid,
                'id_usuario'    => $canal->id_usuario,
                'nome_canal'    => $canal->nome_canal,
                'username'      => $canal->username,
                'descricao'     => $canal->descricao,
                'status'        => $canal->status,
                'avatar'        => $canal->avatar,
                'foto_capa'     => $canal->foto_capa,
                'seguidores'    => count($canal->seguidores),
                'recomendacoes' => count($canal->seguidores->where("recomendado", 1)),
                'inscricoes'    => count($canal->seguidores->where("inscrito", 1)),
                'seguido'       => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)) > 0 ? true : false,
                'inscrito'      => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)->where("recomendado", 1)) > 0 ? true : false,
                'recomendado'   => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)->where("inscrito", 1)) > 0 ? true : false,
            ];
        };

        return collect($listaCanais);
    }

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function buscaCanaisRecomendados(): object
    {
        return CanalRepository::buscaCanaisRecomendados()->map(function ($item) {
            $item->qtdSeguidores = count($item->seguidores);
            return $item;
        });
    }

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function pesquisar($request): object
    {
        $listaCanais = [];
        $canais = CanalRepository::pesquisar($request->nome, [ 'usuario', 'seguidores' ]);
        foreach ($canais as $canal) {
            $listaCanais[] = [
                'id'            => $canal->id,
                'uuid'          => $canal->uuid,
                'id_usuario'    => $canal->id_usuario,
                'nome_canal'    => $canal->nome_canal,
                'username'      => $canal->username,
                'descricao'     => $canal->descricao,
                'status'        => $canal->status,
                'avatar'        => $canal->avatar,
                'foto_capa'     => $canal->foto_capa,
                'seguidores'    => count($canal->seguidores),
                'recomendacoes' => count($canal->seguidores->where("recomendado", 1)),
                'inscricoes'    => count($canal->seguidores->where("inscrito", 1)),
                'seguido'       => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)) > 0 ? true : false,
                'inscrito'      => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)->where("inscrito", 1)) > 0 ? true : false,
                'recomendado'   => \Auth::check() && count($canal->seguidores->where("id_usuario", \Auth::user()->id)->where("recomendado", 1)) > 0 ? true : false,
            ];
        };

        return collect($listaCanais);
    }

    public function removerFoto($request)
    {
        $canal = $this->findByUuid($request->uuid);

        $request->campo == 'avatar' ?
            unlink(storage_path('app/public/imagens/perfil/' . $canal->avatar)) :
            unlink(storage_path('app/public/imagens/capa/' . $canal->foto_capa));

        $campo = $request->campo;
        $canal->$campo = null;
        return $canal->update();
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return CanalRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return CanalRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  Canal
    */
    public function findById($id): Canal
    {
        return CanalRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  Canal
    */
    public static function findByUuid($uuid): Canal
    {
        return CanalRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\CanalRequest  $request
     * @return Canal
     */
    public function store($request): Canal
    {
        if ($request->has('imagem_avatar')) {
            \upload($request, "avatar", $request->file('imagem_avatar'), "public/imagens/perfil");
        }

        if ($request->has('imagem_capa')) {
            \upload($request, "capa", $request->file('imagem_capa'), "public/imagens/capa");
        }

        return CanalRepository::store($this->prepare($request));
    }

    public function save($request, Canal $canal = null): ?Canal
    {
        $objeto = new \stdClass();
        $objeto->canal = $canal;
        if ($canal === null) {
            $objeto->canal = CanalRepository::firstOrNew($request->get('id'));
        }
        return CanalRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\Canal  $canal
     * @return \App\Models\Canal
     */
    public function show($canal): \App\Models\Canal
    {
        return $canal;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\CanalRequest  $request
     * @param \App\Models\Canal  $canal
     * @return bool
     */
    public function update($request, $canal): bool
    {
        if ($request->has('imagem_avatar')) {
            \upload($request, "avatar", $request->file('imagem_avatar'), "public/imagens/perfil");
        }

        if ($request->has('imagem_capa')) {
            \upload($request, "capa", $request->file('imagem_capa'), "public/imagens/capa");
        }

        return CanalRepository::update($this->prepare($request, $canal), $canal);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\Canal  $canal
     * @return bool
     */
    public function destroy($canal): bool
    {
        (new UsuarioHasCanalBO())->deletarCanal($canal->id);
        return CanalRepository::destroy($canal);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
