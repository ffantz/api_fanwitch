<?php

namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * TipoNotificacao trait
 *
 */
trait TipoNotificacaoTrait
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
        $arrayRetorno['nome']   = $objetoRequest->nome;
        $arrayRetorno['sigla']  = $objetoRequest->sigla;
        $arrayRetorno['status'] = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $tipoNotificacao = $objetoClasse->tipoNotificacao;

        foreach (getArrayWithoutTimestamps($tipoNotificacao->getTableColumns()) as $value) {
            $tipoNotificacao->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $tipoNotificacao->$value;
        }

        return $tipoNotificacao;
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
        $arrayRetorno['nome']   = $objetoRequest->nome;
        $arrayRetorno['sigla']  = $objetoRequest->sigla;
        $arrayRetorno['status'] = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }
}
