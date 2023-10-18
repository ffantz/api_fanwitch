<?php

namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * Usuario trait
 *
 */
trait UsuarioTrait
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
        $arrayRetorno['nome']              = $objetoRequest->nome;
        $arrayRetorno['username']          = $objetoRequest->username;
        $arrayRetorno['email']             = $objetoRequest->email;
        $arrayRetorno['data_nascimento']   = $objetoRequest->data_nascimento;
        $arrayRetorno['email_verified_at'] = $objetoRequest->email_verified_at;
        $arrayRetorno['avatar']            = $objetoRequest->avatar;
        $arrayRetorno['status']            = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $usuario = $objetoClasse->usuario;

        foreach (getArrayWithoutTimestamps($usuario->getTableColumns()) as $value) {
            $usuario->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $usuario->$value;
        }

        return $usuario;
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
        $arrayRetorno['nome']              = $objetoRequest->nome;
        $arrayRetorno['username']          = $objetoRequest->username;
        $arrayRetorno['email']             = $objetoRequest->email;
        $arrayRetorno['data_nascimento']   = $objetoRequest->data_nascimento;
        $arrayRetorno['email_verified_at'] = $objetoRequest->email_verified_at;
        $arrayRetorno['avatar']            = $objetoRequest->avatar;
        $arrayRetorno['status']            = $objetoRequest->status;

        return array_filter($arrayRetorno);
    }
}
