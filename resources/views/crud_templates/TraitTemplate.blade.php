namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * {{ $className }} trait
 *
 */
trait {{ $className }}Trait
{
    use PrepareTrait;

    /**
     * Método responsável por receber os dados e prepará-los para chamar a função desejada
     *   seu nome deve ser a junção da palavra prepare com o nome do método que o chamará
     *
     * @param array $params
     * @return void
     */
    public function prepareStore(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $arrayRetorno = [];
        // $arrayRetorno['id_usuario']      = $objetoRequest->id;
        // $arrayRetorno['id_grupo_acesso'] = $objetoRequest->id_grupo_acesso;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        ${{$lowerClassName}} = $objetoClasse->{{$lowerClassName}};

        foreach (getArrayWithoutTimestamps(${{$lowerClassName}}->getTableColumns()) as $value) {
            ${{$lowerClassName}}->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : ${{$lowerClassName}}->$value;
        }

        return ${{$lowerClassName}};
    }

    /**
     * Método responsável por receber os dados e prepará-los para chamar a função desejada
     *   seu nome deve ser a junção da palavra prepare com o nome do método que o chamará
     *
     * @param array $params
     * @return void
     */
    public function prepareUpdate(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $arrayRetorno = [];
        // $arrayRetorno['id_usuario']      = $objetoRequest->id;
        // $arrayRetorno['id_grupo_acesso'] = $objetoRequest->id_grupo_acesso;

        return array_filter($arrayRetorno);
    }
}