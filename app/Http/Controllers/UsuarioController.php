<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use App\BO\UsuarioBO;

class UsuarioController extends Controller
{
    private $return;
    private $code;
    private $message;

    /**
     * Set default values to return in
     */
    public function __construct()
    {
        $this->return  = false;
        $this->code    = config('httpstatus.success.ok');
        $this->message = null;
    }

    /**
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */
    public function initialize()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->initialize();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Displays a resource's list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->index();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->store($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(UsuarioRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->save($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->show($usuario);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao exibir";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->update($request, $usuario);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao editar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->destroy($usuario);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->downloadArquivoModelo();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
