<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UsuarioRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\UsuarioTrait;
use App\Models\Usuario;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class UsuarioBO
{
    use UsuarioTrait;
    use Uuid;

    private $prosseguir;
    private $usuario;

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
     * Return initialization page data
     *
     * @return Object
     */
    public function pesquisar($request): object
    {
        return UsuarioRepository::pesquisar($request->nome, [ 'canal' ]);
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return UsuarioRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return UsuarioRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  Usuario
    */
    public function findById($id): Usuario
    {
        return UsuarioRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  Usuario
    */
    public static function findByUuid($uuid): Usuario
    {
        return UsuarioRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\UsuarioRequest  $request
     * @return Usuario
     */
    public function store($request): Usuario
    {
        $usuario = UsuarioRepository::store($this->prepare($request));
        (new NotificacoesBO())->notificacaoBoasVindas($usuario);
        return $usuario;
    }

    public function save($request, Usuario $usuario = null): ?Usuario
    {
        $objeto = new \stdClass();
        $objeto->usuario = $usuario;
        if ($usuario === null) {
            $objeto->usuario = UsuarioRepository::firstOrNew($request->get('id'));
        }
        return UsuarioRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\Usuario  $usuario
     * @return \App\Models\Usuario
     */
    public function show($usuario): \App\Models\Usuario
    {
        return $usuario;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\UsuarioRequest  $request
     * @param \App\Models\Usuario  $usuario
     * @return bool
     */
    public function update($request, $usuario): bool
    {
        return UsuarioRepository::update($this->prepare($request, $usuario), $usuario);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\Usuario  $usuario
     * @return bool
     */
    public function destroy($usuario): bool
    {
        return UsuarioRepository::destroy($usuario);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }

    public function dadosUsuario()
    {
        $usuario = UsuarioRepository::dadosUsuario();

        return $usuario;
    }
}
