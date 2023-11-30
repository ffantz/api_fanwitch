<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class UsuarioHasCanalRequest extends CustomRulesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return Bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return Array
     */
    public function validateDefault(): array
    {
        return [
            // Your default validation
        ];
    }

    /**
     * @return Array
     */
    public function validateToAcaoCanal(): array
    {
        return [
            'acao' => 'in:SEGUIR,PARAR_SEGUIR,INSCREVER,DESINSCREVER,MODERADOR,REMOVER_MODERADOR,ADMINISTRADOR,REMOVER_ADMINISTRADOR,RECOMENDADO,REMOVER_RECOMENDADO'
        ];
    }

    /**
     * @return Array
     */
    public function messages(): array
    {
        return [
            'acao.in' => 'Ação inválida',
        ];
    }

    protected function getValidatorInstance()
    {
        // Captura o parâmetro injetado na rota sem utilizar query.
        // Assim, a rota que seria dessa forma: /usuario?id=12
        // passa a ser utilizada dessa forma: /usuario/12
        // $data = $this->all();
        // $data['exemplo'] = trim($this->exemplo);

        // foreach ($this->getNameParams() AS $key => $value)
        // {
        //     if (\trim($this->$value) != ""){
        //         $data[$value] = trim($this->$value);
        //     }
        // }
        // $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
