<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amizade;
use App\Http\Requests\AmizadeRequest;
use App\BO\AmizadeBO;

class AmizadeController extends Controller
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
        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->initialize();

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
        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->index();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\AmizadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmizadeRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->store($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a new resource in storage.
     *
     * @param  \App\Http\Requests\AmizadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(AmizadeRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->save($request);
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao salvar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amizade  $amizade
     * @return \Illuminate\Http\Response
     */
    public function show(Amizade $amizade)
    {
        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->show($amizade);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao exibir";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AmizadeRequest  $request
     * @param  \App\Models\Amizade  $amizade
     * @return \Illuminate\Http\Response
     */
    public function update(AmizadeRequest $request, Amizade $amizade)
    {
        $this->code = config('httpstatus.success.created');

        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->update($request, $amizade);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao editar";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amizade  $amizade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amizade $amizade)
    {
        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->destroy($amizade);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $amizadeBO = new AmizadeBO();
        $this->return = $amizadeBO->downloadArquivoModelo();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
