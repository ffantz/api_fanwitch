<?php

namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\MensagemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\MensagemTrait;
use App\Models\Mensagem;
use App\Models\Uuid;
use Illuminate\Support\Facades\Storage;
use Log;

class MensagemBO
{
    use MensagemTrait;
    use Uuid;

    private $prosseguir;
    private $mensagem;

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): object
    {
        $retorno = [];
        $usuarios = [ 'mensagens' ];
        $mensagens = MensagemRepository::initialize();
        foreach ($mensagens as $mensagem) {
            if (!isset($usuarios[$mensagem->id_usuario_remetente])) {
                $usuarios[$mensagem->id_usuario_remetente] = (new UsuarioBO())->findById($mensagem->id_usuario_remetente);
            }

            if (!isset($usuarios[$mensagem->id_usuario_destinatario])) {
                $usuarios[$mensagem->id_usuario_destinatario] = (new UsuarioBO())->findById($mensagem->id_usuario_destinatario);
            }

            $retorno['mensagens']
        }

        return $retorno;
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return MensagemRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return MensagemRepository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  Mensagem
    */
    public function findById($id): Mensagem
    {
        return MensagemRepository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  Mensagem
    */
    public static function findByUuid($uuid): Mensagem
    {
        return MensagemRepository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\MensagemRequest  $request
     * @return Mensagem
     */
    public function store($request): Mensagem
    {
        return MensagemRepository::store($this->prepare($request));
    }

    public function save($request, Mensagem $mensagem = null): ?Mensagem
    {
        $objeto = new \stdClass();
        $objeto->mensagem = $mensagem;
        if ($mensagem === null) {
            $objeto->mensagem = MensagemRepository::firstOrNew($request->get('id'));
        }
        return MensagemRepository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\Mensagem  $mensagem
     * @return \App\Models\Mensagem
     */
    public function show($mensagem): \App\Models\Mensagem
    {
        return $mensagem;
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\MensagemRequest  $request
     * @param \App\Models\Mensagem  $mensagem
     * @return bool
     */
    public function update($request, $mensagem): bool
    {
        return MensagemRepository::update($this->prepare($request, $mensagem), $mensagem);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\Mensagem  $mensagem
     * @return bool
     */
    public function destroy($mensagem): bool
    {
        return MensagemRepository::destroy($mensagem);
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}
