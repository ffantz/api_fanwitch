<?php
namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * Amizade trait
 *
 */
trait AmizadeTrait
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
        $arrayRetorno['id_usuario']            = $objetoRequest->id_usuario;
        $arrayRetorno['id_usuario_adicionado'] = $objetoRequest->id_usuario_adicionado;
        $arrayRetorno['status']                = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $amizade = $objetoClasse->amizade;

        foreach (getArrayWithoutTimestamps($amizade->getTableColumns()) as $value) {
            $amizade->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $amizade->$value;
        }

        return $amizade;
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
        $arrayRetorno['id_usuario']            = $objetoRequest->id_usuario;
        $arrayRetorno['id_usuario_adicionado'] = $objetoRequest->id_usuario_adicionado;
        $arrayRetorno['status']                = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }
}
