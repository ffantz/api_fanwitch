<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class UsuarioRequest extends CustomRulesRequest
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
    public function validateToCadastrar(): array
    {
        return [
            'username' => 'required_without:email|unique:usuario,username|max:35',
            'email' => 'required_without:username|unique:usuario,email|max:100',
            'password' => 'min:6|max:100',
        ];
    }

    /**
     * @return Array
     */
    public function messages(): array
    {
        return [
            'username.max' => 'O nome de usuário deve ter no máximo 35 caracteres!',
            'username.unique' => 'O nome de usuário já está cadastrado!',
            'username.required_without' => 'Informe um email ou nome de usuário!',

            'email.max' => 'O email deve ter no máximo 100 caracteres!',
            'email.unique' => 'O email já está cadastrado!',
            'email.required_without' => 'Informe um email ou nome de usuário!',

            'password.max' => 'A senha deve ter no máximo 100 caracteres!',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres!',
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
