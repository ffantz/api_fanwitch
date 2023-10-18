<?php
namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * Canal trait
 *
 */
trait CanalTrait
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
        $arrayRetorno['id_usuario'] = $objetoRequest->id_usuario;
        $arrayRetorno['nome_canal'] = $objetoRequest->nome_canal;
        $arrayRetorno['username']   = $objetoRequest->username;
        $arrayRetorno['status']     = $objetoRequest->status;
        $arrayRetorno['avatar']     = $objetoRequest->avatar;
        $arrayRetorno['foto_capa']  = $objetoRequest->foto_capa;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $canal = $objetoClasse->canal;

        foreach (getArrayWithoutTimestamps($canal->getTableColumns()) as $value) {
            $canal->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $canal->$value;
        }

        return $canal;
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
        $arrayRetorno['id_usuario'] = $objetoRequest->id_usuario;
        $arrayRetorno['nome_canal'] = $objetoRequest->nome_canal;
        $arrayRetorno['username']   = $objetoRequest->username;
        $arrayRetorno['status']     = $objetoRequest->status;
        $arrayRetorno['avatar']     = $objetoRequest->avatar;
        $arrayRetorno['foto_capa']  = $objetoRequest->foto_capa;

        return array_filter($arrayRetorno);
    }
}
