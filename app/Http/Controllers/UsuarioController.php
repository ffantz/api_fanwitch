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
    public function dadosUsuario()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->dadosUsuario();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar os dados";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */
    public function cadastrar(UsuarioRequest $request)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao cadastrar";
        } else {
            $this->message = "Cadastro realizado com sucesso. Valide seu email e termine de preencher seu perfil";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */
    public function atualizarInformacoes(UsuarioRequest $request)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->update($request, Usuario::whereId(\Auth::user()->id)->first());

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao atualizar informações";
        } else {
            $this->message = "Informações atualizadas com sucesso";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */
    public function validarEmail(UsuarioRequest $request)
    {
        $usuario = Usuario::whereId(\Auth::user()->id)->first();
        $usuarioBO = new UsuarioBO();

        if (is_null($usuario->email_verified_at)) {
            $this->return = $usuarioBO->update(new Request([ 'email_verified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s') ]), $usuario);
        } else {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Email já validado";

            return collection($this->return, $this->code, $this->message);
        }

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao validar o email";
        } else {
            $this->message = "Email validado com sucesso";
        }

        return collection($this->return, $this->code, $this->message);
    }
}
