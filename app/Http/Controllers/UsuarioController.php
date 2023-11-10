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
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */
    public function cadastrar(UsuarioRequest $request)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->cadastrar($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao cadastrar";
        }

        return collection($this->return, $this->code, $this->message);
    }
}
