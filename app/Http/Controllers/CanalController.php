<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canal;
use App\Http\Requests\CanalRequest;
use App\BO\CanalBO;

class CanalController extends Controller
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
        $canalBO = new CanalBO();
        $this->return = $canalBO->initialize();

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
    public function initializeUsuario()
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->initialize();

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
    public function pesquisar(Request $request)
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->pesquisar($request);

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
    public function removerFoto(Request $request)
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->removerFoto($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        } else {
            $this->message = "Foto removida com sucesso.";
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
        $canalBO = new CanalBO();
        $this->return = $canalBO->index();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\CanalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CanalRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $canalBO = new CanalBO();
        $this->return = $canalBO->store($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        } else {
            $this->message = "Canal criado com sucesso.";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\CanalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(CanalRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $canalBO = new CanalBO();
        $this->return = $canalBO->save($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Canal  $canal
     * @return \Illuminate\Http\Response
     */
    public function show(Canal $canal)
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->show($canal);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao exibir";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CanalRequest  $request
     * @param  \App\Models\Canal  $canal
     * @return \Illuminate\Http\Response
     */
    public function update(CanalRequest $request, Canal $canal)
    {
        $this->code = config('httpstatus.success.created');

        $canalBO = new CanalBO();
        $this->return = $canalBO->update($request, $canal);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao editar";
        } else {
            $this->message = "Canal atualizado com sucesso.";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Canal  $canal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Canal $canal)
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->destroy($canal);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        } else {
            $this->message = "Canal deletado com sucesso.";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $canalBO = new CanalBO();
        $this->return = $canalBO->downloadArquivoModelo();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
