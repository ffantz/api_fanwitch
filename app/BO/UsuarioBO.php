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
    public function pesquisar($request)
    {
        $listaUsuarios = [];
        $usuarios = UsuarioRepository::pesquisar($request->nome, [ 'canal', 'amigos', 'amigosAdicionados' ]);
        foreach ($usuarios as $usuario) {
            $listaUsuarios[] = [
                "id"                => $usuario->id,
                "nome"              => $usuario->nome,
                "username"          => $usuario->username,
                "email"             => $usuario->email,
                "descricao"         => $usuario->descricao,
                "data_nascimento"   => $usuario->data_nascimento,
                "email_verified_at" => $usuario->email_verified_at,
                "avatar"            => $usuario->avatar,
                "status"            => $usuario->status,
                'amigos'            => count($usuario->amigos) + count($usuario->amigosAdicionados),
                'amigo'             => \Auth::check()
                    && \Auth::user()->id != $usuario->id
                    && (count($usuario->amigos->where("id_usuario_adicionado", \Auth::user()->id)) > 0
                    || count($usuario->amigos->where("id_usuario", \Auth::user()->id)) > 0
                    || count($usuario->amigosAdicionados->where("id_usuario_adicionado", \Auth::user()->id)) > 0
                    || count($usuario->amigosAdicionados->where("id_usuario", \Auth::user()->id)) > 0)
                    ? true : false,
            ];
        };

        return $listaUsuarios;
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
    * Find an specific resource by username
    *
    * @return  Usuario
    */
    public static function findByUsername($username): Usuario
    {
        return UsuarioRepository::findByUsername($username);
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
        if ($request->has('imagem_avatar')) {
            \upload($request, "avatar", $request->file('imagem_avatar'), "public/imagens/perfil");
        }
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
