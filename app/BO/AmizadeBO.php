<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\AmizadeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\AmizadeTrait;
use App\Models\Amizade;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class AmizadeBO
{
    use AmizadeTrait;
    use Uuid;

    private $prosseguir;
    private $amizade;

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
        return AmizadeRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return AmizadeRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  Amizade
    */
    public function findById($id): Amizade
    {
        return AmizadeRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  Amizade
    */
    public static function findByUuid($uuid): Amizade
    {
        return AmizadeRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\AmizadeRequest  $request
     * @return Amizade
     */
    public function store($request): Amizade
    {
        return AmizadeRepository::store($this->prepare($request));
    }

    public function save($request, Amizade $amizade = null): ?Amizade
    {
        $objeto = new \stdClass();
        $objeto->amizade = $amizade;
        if ($amizade === null) {
            $objeto->amizade = AmizadeRepository::firstOrNew($request->get('id'));
        }
        return AmizadeRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\Amizade  $amizade
     * @return \App\Models\Amizade
     */
    public function show($amizade): \App\Models\Amizade
    {
        return $amizade;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\AmizadeRequest  $request
     * @param \App\Models\Amizade  $amizade
     * @return bool
     */
    public function update($request, $amizade): bool
    {
        return AmizadeRepository::update($this->prepare($request, $amizade), $amizade);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\Amizade  $amizade
     * @return bool
     */
    public function destroy($amizade): bool
    {
        return AmizadeRepository::destroy($amizade);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
