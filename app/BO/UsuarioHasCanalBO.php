<?php
namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UsuarioHasCanalRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\UsuarioHasCanalTrait;
use App\Models\UsuarioHasCanal;
use App\Models\Uuid;

use Illuminate\Support\Facades\Storage;
use Log;

class UsuarioHasCanalBO
{
    use UsuarioHasCanalTrait, Uuid;

    private $prosseguir;
    private $usuarioHasCanal;

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): Object
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
        return UsuarioHasCanalRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return UsuarioHasCanalRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  UsuarioHasCanal
    */
    public function findById($id): UsuarioHasCanal
    {
        return UsuarioHasCanalRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  UsuarioHasCanal
    */
    public static function findByUuid($uuid): UsuarioHasCanal
    {
        return UsuarioHasCanalRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\UsuarioHasCanalRequest  $request
     * @return UsuarioHasCanal
     */
    public function store($request): UsuarioHasCanal
    {
        return UsuarioHasCanalRepository::store($this->prepare($request));
    }

    public function save($request, UsuarioHasCanal $usuarioHasCanal = null):? UsuarioHasCanal
    {
        $objeto = new \stdClass();
        $objeto->usuarioHasCanal = $usuarioHasCanal;
        if ($usuarioHasCanal === null)
        {
            $objeto->usuarioHasCanal = UsuarioHasCanalRepository::firstOrNew($request->get('id'));
        }
        return UsuarioHasCanalRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return \App\Models\UsuarioHasCanal
     */
    public function show($usuarioHasCanal): \App\Models\UsuarioHasCanal
    {
        return $usuarioHasCanal;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\UsuarioHasCanalRequest  $request
     * @param \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return bool
     */
    public function update($request, $usuarioHasCanal): bool
    {
        return UsuarioHasCanalRepository::update($this->prepare($request, $usuarioHasCanal), $usuarioHasCanal);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return bool
     */
    public function destroy($usuarioHasCanal): bool
    {
        return UsuarioHasCanalRepository::destroy($usuarioHasCanal);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
