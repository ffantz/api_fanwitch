<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class CanalRequest extends CustomRulesRequest
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
    public function validateToStore(): array
    {
        return [
            'username' => 'required|unique:canal,username|max:35',
            'nome_canal' => 'required|max:75',
        ];
    }

    /**
     * @return Array
     */
    public function validateToSave(): array
    {
        return [
            // 'name' => 'required|max:60',
        ];
    }

    /**
     * @return Array
     */
    public function validateToUpdate(): array
    {
        return [
            'nome_canal' => 'max:75',
        ];
    }

    /**
     * @return Array
     */
    public function validateToDestroy(): array
    {
        return [
            // 'id' => 'required',
        ];
    }

    /**
     * @return Array
     */
    public function messages(): array
    {
        return [
            'username.required' => 'O nome de usuário é obrigatório!',
            'username.max' => 'O nome de usuário deve ter no máximo 35 caracteres!',
            'username.unique' => 'O nome de usuário já está cadastrado!',

            'nome_canal.max' => 'O nome do canal deve ter no máximo 75 caracteres!',
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
