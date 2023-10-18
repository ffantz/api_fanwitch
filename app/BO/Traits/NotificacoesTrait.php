<?php
namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * Notificacoes trait
 *
 */
trait NotificacoesTrait
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
        $arrayRetorno['titulo']     = $objetoRequest->titulo;
        $arrayRetorno['texto']      = $objetoRequest->texto;
        $arrayRetorno['lida']       = $objetoRequest->lida;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $notificacoes = $objetoClasse->notificacoes;

        foreach (getArrayWithoutTimestamps($notificacoes->getTableColumns()) as $value) {
            $notificacoes->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $notificacoes->$value;
        }

        return $notificacoes;
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
        $arrayRetorno['titulo']     = $objetoRequest->titulo;
        $arrayRetorno['texto']      = $objetoRequest->texto;
        $arrayRetorno['lida']       = $objetoRequest->lida;

        return array_filter($arrayRetorno);
    }
}
