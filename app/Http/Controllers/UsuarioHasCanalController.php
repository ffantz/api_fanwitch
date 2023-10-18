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
    public function initialize()
    {
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->initialize();

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
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->index();

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
     * @param  \App\Http\Requests\UsuarioHasCanalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioHasCanalRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->store($request);
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
     * @param  \App\Http\Requests\UsuarioHasCanalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function save(UsuarioHasCanalRequest $request)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->save($request);
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
     * @param  \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioHasCanal $usuarioHasCanal)
    {
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->show($usuarioHasCanal);

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
     * @param  \App\Http\Requests\UsuarioHasCanalRequest  $request
     * @param  \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioHasCanalRequest $request, UsuarioHasCanal $usuarioHasCanal)
    {
        $this->code = config('httpstatus.success.created');

        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->update($request, $usuarioHasCanal);

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
     * @param  \App\Models\UsuarioHasCanal  $usuarioHasCanal
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioHasCanal $usuarioHasCanal)
    {
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->destroy($usuarioHasCanal);

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        $usuarioHasCanalBO = new UsuarioHasCanalBO();
        $this->return = $usuarioHasCanalBO->downloadArquivoModelo();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}
