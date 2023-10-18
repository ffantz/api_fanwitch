<?php
namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * Mensagem trait
 *
 */
trait MensagemTrait
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
        $arrayRetorno['id_usuario_remetente']    = $objetoRequest->id_usuario_remetente;
        $arrayRetorno['id_usuario_destinatario'] = $objetoRequest->id_usuario_destinatario;
        $arrayRetorno['mensagem']                = $objetoRequest->mensagem;
        $arrayRetorno['lida']                    = $objetoRequest->lida;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $mensagem = $objetoClasse->mensagem;

        foreach (getArrayWithoutTimestamps($mensagem->getTableColumns()) as $value) {
            $mensagem->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $mensagem->$value;
        }

        return $mensagem;
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
        $arrayRetorno['id_usuario_remetente']    = $objetoRequest->id_usuario_remetente;
        $arrayRetorno['id_usuario_destinatario'] = $objetoRequest->id_usuario_destinatario;
        $arrayRetorno['mensagem']                = $objetoRequest->mensagem;
        $arrayRetorno['lida']                    = $objetoRequest->lida;

        return array_filter($arrayRetorno);
    }
}
