<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\BaseModel;

/**
 * GenericRepository class
 *
 * @author Flávio Caetano <flavioluzio22@gmail.com>
 */
abstract class GenericRepository
{
    /**
     * Obtem o nome da classe que realizou o acionamento
     *
     * @return \App\Models\BaseModel
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    protected static function getCalledClass(): string
    {
        return \get_called_class()::getClass();
    }

    /**
     * Obtem o nome da coluna responsável por armazenar o identificador único da tabela
     *
     * @return string
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    protected static function getClassPrimaryKey(): string
    {
        return \get_called_class()::getPrimaryKeyName();
    }

    /**
     * Retorna os registros do Model responsável pelo acionamento.
     * A quantidade dos dados disponibilizados serão limitados pelo formato da paginação
     *
     * @return LengthAwarePaginator|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function index(): ?LengthAwarePaginator
    {
        return self::getCalledClass()::paginate();
    }

    /**
     * Retorna todos os registros do Model responsável pelo acionamento.
     *
     * @return Collection|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function initialize($with = []): ?Collection
    {
        $queryBuild = self::getCalledClass();
        return \count($with) ? self::getCalledClass()::with($with)->get() : self::getCalledClass()::get();
    }

    /**
     * Realiza a busca de um determinado registro na base considerando o id fornecido
     *
     * @param int $id
     * @return \App\Models\BaseModel|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function findById(int $id): ?BaseModel
    {
        return self::getCalledClass()::where(self::getClassPrimaryKey(), $id)->first();
    }

    /**
     * Realiza a busca de um determinado registro na base considerando o uuid fornecido
     *
     * @param string $uuid
     * @return \App\Models\BaseModel
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function findByUuid(string $uuid): ?BaseModel
    {
        return self::getCalledClass()::whereUuid($uuid)->first();
    }

    public static function findActive($columns = ['id','nome']): Collection
    {
        return self::getCalledClass()::active()->get($columns);
    }

    /**
     * Realiza a busca de um determinado registro na base considerando o id fornecido,
     * caso a consulta não obtenha sucesso, será disponibilizado um objeto do modelo que
     * realizou o acionamento do recurso
     *
     * @param int $id
     * @return \App\Models\BaseModel
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function firstOrNew(?int $id): BaseModel
    {
        $class = self::getCalledClass();
        return !is_null($id) && $id > 0 ? $class::firstOrNew([self::getClassPrimaryKey() => $id]) : new $class();
    }

    /**
     * Realiza a busca de um determinado registro na base considerando a chave composta fornecida,
     * caso a consulta não obtenha sucesso, será disponibilizado um objeto do modelo que
     * realizou o acionamento do recurso
     *
     * @param array $id
     * @return \App\Models\BaseModel
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function firstOrNewHasComposite(array $arrayData): BaseModel
    {
        $class = self::getCalledClass();
        return \count($arrayData) > 0 ? $class::firstOrNew($arrayData) : new $class();
    }

   /**
    * Cria um novo registro no banco de dados
    *
    * @param array $arrayData
    * @return \App\Models\BaseModel
    * @author Flávio Caetano <flavioluzio22@gmail.com>
    */
    public static function store(array $arrayData): BaseModel
    {
        return self::getCalledClass()::create($arrayData);
    }

    /**
     * Sava as alterações do modelo que realizou o acionamento.
     * Se o registro existir o mesmo será atualizado, caso contrário, um novo registro será criado
     *
     * @param \App\Models\BaseModel $calledClass
     * @return \App\Models\BaseModel|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function save(BaseModel $calledClass): ?BaseModel
    {
        return $calledClass->save() ? $calledClass : null;
    }

    /**
     * Atualiza os dados do registro considerando o modelo e dados fornecidos
     *
     * @param array $arrayData
     * @param App\Models\BaseModel $calledClass
     * @return bool
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function update(array $arrayData, BaseModel $calledClass): bool
    {
        return $calledClass->update($arrayData);
    }

    /**
     * Remove o registro considerando o modelo fornecido
     *
     * @param BaseModel $calledClass
     * @return bool
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function destroy(BaseModel $calledClass): bool
    {
        return $calledClass->delete();
    }
}
