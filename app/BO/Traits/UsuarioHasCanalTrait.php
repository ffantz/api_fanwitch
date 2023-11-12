<?php

namespace App\BO\Traits;

use Illuminate\Http\Request;
use App\Resources\Traits\PrepareTrait;

/**
 * UsuarioHasCanal trait
 *
 */
trait UsuarioHasCanalTrait
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
        $arrayRetorno['id_canal']      = $objetoRequest->id_canal;
        $arrayRetorno['id_usuario']    = $objetoRequest->id_usuario;
        $arrayRetorno['moderador']     = $objetoRequest->moderador;
        $arrayRetorno['administrador'] = $objetoRequest->administrador;
        $arrayRetorno['inscrito']      = $objetoRequest->inscrito;
        $arrayRetorno['recomendado']   = $objetoRequest->recomendado;

        return array_filter($arrayRetorno);
    }

    public function prepareSave(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $usuarioHasCanal = $objetoClasse->usuarioHasCanal;

        foreach (getArrayWithoutTimestamps($usuarioHasCanal->getTableColumns()) as $value) {
            $usuarioHasCanal->$value        = $objetoRequest->has($value) ? $objetoRequest->$value : $usuarioHasCanal->$value;
        }

        return $usuarioHasCanal;
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
        $arrayRetorno['id_canal']      = $objetoRequest->id_canal;
        $arrayRetorno['id_usuario']    = $objetoRequest->id_usuario;
        $arrayRetorno['moderador']     = $objetoRequest->moderador;
        $arrayRetorno['administrador'] = $objetoRequest->administrador;
        $arrayRetorno['inscrito']      = $objetoRequest->inscrito;
        $arrayRetorno['recomendado']   = $objetoRequest->recomendado;

        return array_filter($arrayRetorno);
    }

    public function prepareUpdateOrCreate(array $params)
    {
        $objetoRequest                   = $params['request'];
        $objetoClasse                    = $params['object'];

        $arrayRetorno = [];
        $arrayRetorno['id_canal']      = $objetoRequest->id_canal;
        $arrayRetorno['id_usuario']    = $objetoRequest->id_usuario;

        switch ($objetoRequest->acao) {
            case 'MODERADOR':
                $arrayRetorno['moderador'] = '1';
            break;
            case 'ADMINISTRADOR':
                $arrayRetorno['administrador'] = '1';
            break;
            case 'INSCREVER':
                $arrayRetorno['inscrito'] = '1';
            break;
            case 'RECOMENDADO':
                $arrayRetorno['recomendado'] = '1';
            break;
            case 'REMOVER_MODERADOR':
                $arrayRetorno['moderador'] = '0';
            break;
            case 'REMOVER_ADMINISTRADOR':
                $arrayRetorno['administrador'] = '0';
            break;
            case 'DESINSCREVER':
                $arrayRetorno['inscrito'] = '0';
            break;
            case 'REMOVER_RECOMENDADO':
                $arrayRetorno['recomendado'] = '0';
            break;
        }

        return $arrayRetorno;
    }
}
