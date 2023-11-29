<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\TipoNotificacaoRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\TipoNotificacaoTrait;
use App\Models\TipoNotificacao;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class TipoNotificacaoBO
{
    use TipoNotificacaoTrait;
    use Uuid;

    private $prosseguir;
    private $tipoNotificacao;

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): object
    {
        $retorno = new \stdClass();

        return $retorno;
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return TipoNotificacaoRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return TipoNotificacaoRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  TipoNotificacao
    */
    public function findById($id): TipoNotificacao
    {
        return TipoNotificacaoRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  TipoNotificacao
    */
    public static function findByUuid($uuid): TipoNotificacao
    {
        return TipoNotificacaoRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\TipoNotificacaoRequest  $request
     * @return TipoNotificacao
     */
    public function store($request): TipoNotificacao
    {
        return TipoNotificacaoRepository::store($this->prepare($request));
    }

    public function save($request, TipoNotificacao $tipoNotificacao = null): ?TipoNotificacao
    {
        $objeto = new \stdClass();
        $objeto->tipoNotificacao = $tipoNotificacao;
        if ($tipoNotificacao === null) {
            $objeto->tipoNotificacao = TipoNotificacaoRepository::firstOrNew($request->get('id'));
        }
        return TipoNotificacaoRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\TipoNotificacao  $tipoNotificacao
     * @return \App\Models\TipoNotificacao
     */
    public function show($tipoNotificacao): \App\Models\TipoNotificacao
    {
        return $tipoNotificacao;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\TipoNotificacaoRequest  $request
     * @param \App\Models\TipoNotificacao  $tipoNotificacao
     * @return bool
     */
    public function update($request, $tipoNotificacao): bool
    {
        return TipoNotificacaoRepository::update($this->prepare($request, $tipoNotificacao), $tipoNotificacao);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\TipoNotificacao  $tipoNotificacao
     * @return bool
     */
    public function destroy($tipoNotificacao): bool
    {
        return TipoNotificacaoRepository::destroy($tipoNotificacao);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
