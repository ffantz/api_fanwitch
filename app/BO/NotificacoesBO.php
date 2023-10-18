<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NotificacoesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\NotificacoesTrait;
use App\Models\Notificacoes;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class NotificacoesBO
{
    use NotificacoesTrait;
    use Uuid;

    private $prosseguir;
    private $notificacoes;

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
        return NotificacoesRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return NotificacoesRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  Notificacoes
    */
    public function findById($id): Notificacoes
    {
        return NotificacoesRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  Notificacoes
    */
    public static function findByUuid($uuid): Notificacoes
    {
        return NotificacoesRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\NotificacoesRequest  $request
     * @return Notificacoes
     */
    public function store($request): Notificacoes
    {
        return NotificacoesRepository::store($this->prepare($request));
    }

    public function save($request, Notificacoes $notificacoes = null): ?Notificacoes
    {
        $objeto = new \stdClass();
        $objeto->notificacoes = $notificacoes;
        if ($notificacoes === null) {
            $objeto->notificacoes = NotificacoesRepository::firstOrNew($request->get('id'));
        }
        return NotificacoesRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\Notificacoes  $notificacoes
     * @return \App\Models\Notificacoes
     */
    public function show($notificacoes): \App\Models\Notificacoes
    {
        return $notificacoes;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\NotificacoesRequest  $request
     * @param \App\Models\Notificacoes  $notificacoes
     * @return bool
     */
    public function update($request, $notificacoes): bool
    {
        return NotificacoesRepository::update($this->prepare($request, $notificacoes), $notificacoes);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\Notificacoes  $notificacoes
     * @return bool
     */
    public function destroy($notificacoes): bool
    {
        return NotificacoesRepository::destroy($notificacoes);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
