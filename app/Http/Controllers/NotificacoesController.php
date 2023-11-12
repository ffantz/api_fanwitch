<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacoes;
use App\Http\Requests\NotificacoesRequest;
use App\BO\NotificacoesBO;

class NotificacoesController extends Controller
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
        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->initialize();

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
        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->index();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\NotificacoesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificacoesRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->store($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\NotificacoesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(NotificacoesRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->save($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notificacoes  $notificacoes
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacoes $notificacoes)
    {
        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->show($notificacoes);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao exibir";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NotificacoesRequest  $request
     * @param  \App\Models\Notificacoes  $notificacoes
     * @return \Illuminate\Http\Response
     */
    public function update(NotificacoesRequest $request, Notificacoes $notificacoes)
    {
        $request->merge([ 'id_usuario' => Auth::user()->id ]);
        $this->code = config('httpstatus.success.created');

        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->update($request, $notificacoes);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao editar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacoes  $notificacoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacoes $notificacoes)
    {
        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->destroy($notificacoes);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $notificacoesBO = new NotificacoesBO();
        $this->return = $notificacoesBO->downloadArquivoModelo();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
