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
    public function validateToStore(): array
    {
        return [
            // 'name' => 'required|max:60',
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
            // 'name' => 'max:60',
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
            // 'id.required' => 'O id é obrigatório!',
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
