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
        return CanalRepository::initialize([ 'usuario', 'seguidores' => function ($query) {
            $query->with("usuario");
        }])->map(function($canal) {
            $canal->recomendacoes = count($canal->seguidores->where("recomendado", 1));
            return $canal;
        });
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
        return CanalRepository::destroy($canal);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
