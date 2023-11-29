<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoNotificacao;
use App\Http\Requests\TipoNotificacaoRequest;
use App\BO\TipoNotificacaoBO;

class TipoNotificacaoController extends Controller
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
        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->initialize();

        if (!$this->return)
        {
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
        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->index();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\TipoNotificacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoNotificacaoRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->store($request);
        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\TipoNotificacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(TipoNotificacaoRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->save($request);
        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoNotificacao  $tipoNotificacao
     * @return \Illuminate\Http\Response
     */
    public function show(TipoNotificacao $tipoNotificacao)
    {
        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->show($tipoNotificacao);

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao exibir";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TipoNotificacaoRequest  $request
     * @param  \App\Models\TipoNotificacao  $tipoNotificacao
     * @return \Illuminate\Http\Response
     */
    public function update(TipoNotificacaoRequest $request, TipoNotificacao $tipoNotificacao)
    {
        $this->code = config('httpstatus.success.created');

        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->update($request, $tipoNotificacao);

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao editar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoNotificacao  $tipoNotificacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoNotificacao $tipoNotificacao)
    {
        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->destroy($tipoNotificacao);

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $tipoNotificacaoBO = new TipoNotificacaoBO();
        $this->return = $tipoNotificacaoBO->downloadArquivoModelo();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
