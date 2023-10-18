namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{{$className}};
use App\Http\Requests\{{$className}}Request;
use App\BO\{{$className}}BO;

class {{$className}}Controller extends Controller
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
        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->initialize();

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
        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->index();

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
     * @param  \App\Http\Requests\{{$className}}Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store({{$className}}Request $request)
    {
        $this->code = config('httpstatus.success.created');

        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->store($request);
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
     * @param  \App\Http\Requests\{{$className}}Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save({{$className}}Request $request)
    {
        $this->code = config('httpstatus.success.created');

        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->save($request);
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
     * @param  \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return \Illuminate\Http\Response
     */
    public function show({{$className}} ${{$lowerClassName}})
    {
        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->show(${{$lowerClassName}});

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
     * @param  \App\Http\Requests\{{$className}}Request  $request
     * @param  \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return \Illuminate\Http\Response
     */
    public function update({{$className}}Request $request, {{$className}} ${{$lowerClassName}})
    {
        $this->code = config('httpstatus.success.created');

        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->update($request, ${{$lowerClassName}});

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
     * @param  \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return \Illuminate\Http\Response
     */
    public function destroy({{$className}} ${{$lowerClassName}})
    {
        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->destroy(${{$lowerClassName}});

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao remover";
        }

        return collection($this->return, $this->code, $this->message);
    }

    public function downloadArquivoModelo()
    {
        ${{$lowerClassName}}BO = new {{$className}}BO();
        $this->return = ${{$lowerClassName}}BO->downloadArquivoModelo();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return collection(false, $this->code, $this->message);
        }
        return response()->file($this->return);
    }
}