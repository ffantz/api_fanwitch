<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioHasCanal;
use App\Http\Requests\UsuarioHasCanalRequest;
use App\BO\UsuarioHasCanalBO;

class UsuarioHasCanalController extends Controller
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
    public function acaoCanal(UsuarioHasCanalRequest $request)
    {
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->updateOrCreate($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao realizar a ação";
        } else {
            $this->message = "Ação realizada com sucesso";
        }

        return collection($this->return, $this->code, $this->message);
    }
}
