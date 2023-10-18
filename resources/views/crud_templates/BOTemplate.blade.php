namespace App\BO;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\{{$className}}Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BO\Traits\{{$className}}Trait;
use App\Models\{{ $className }};
use App\Models\Uuid;

use Illuminate\Support\Facades\Storage;
use Log;

class {{$className}}BO
{
    use {{ $className }}Trait, Uuid;

    private $prosseguir;
    private ${{$lowerClassName}};

    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): Object
    {
        $retorno = new \stdClass();

        return $retorno;
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return {{$className}}Repository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActive(): Collection
    {
        return {{$className}}Repository::findActive();
    }

    /**
    * Find an specific resource by Id
    *
    * @return  {{$className}}
    */
    public function findById($id): {{$className}}
    {
        return {{$className}}Repository::findById($id);
    }

    /**
    * Find an specific resource by Uuid
    *
    * @return  {{$className}}
    */
    public static function findByUuid($uuid): {{$className}}
    {
        return {{$className}}Repository::findByUuid($uuid);
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\{{$className}}Request  $request
     * @return {{$className}}
     */
    public function store($request): {{$className}}
    {
        return {{$className}}Repository::store($this->prepare($request));
    }

    public function save($request, {{$className}} ${{$lowerClassName}} = null):? {{$className}}
    {
        $objeto = new \stdClass();
        $objeto->{{$lowerClassName}} = ${{$lowerClassName}};
        if (${{$lowerClassName}} === null)
        {
            $objeto->{{$lowerClassName}} = {{$className}}Repository::firstOrNew($request->get('id'));
        }
        return {{$className}}Repository::save($this->prepare($request, $objeto));
    }

    /**
     * Display an specific resource.
     *
     * @param \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return \App\Models\{{$className}}
     */
    public function show(${{$lowerClassName}}): \App\Models\{{$className}}
    {
        return ${{$lowerClassName}};
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\{{$className}}Request  $request
     * @param \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return bool
     */
    public function update($request, ${{$lowerClassName}}): bool
    {
        return {{$className}}Repository::update($this->prepare($request, ${{$lowerClassName}}), ${{$lowerClassName}});
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\{{$className}}  ${{$lowerClassName}}
     * @return bool
     */
    public function destroy(${{$lowerClassName}}): bool
    {
        return {{$className}}Repository::destroy(${{$lowerClassName}});
    }

    public function downloadArquivoModelo()
    {
        // return storage_path("app/public/modelos/mailing/modelo_importacao.csv");
    }
}