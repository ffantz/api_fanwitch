<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class UsuarioRepository
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return Usuario::class;
    }

    public static function getPrimaryKeyName(): string
    {
        return (new Usuario())->getKeyName();
    }

    public static function dadosUsuario(): Usuario
    {
        return Usuario::whereId(\Auth::user()->id)
            ->with([ 'canal', 'seguindo', 'notificacoes' => function($query) {
                $query->orderBy('notificacoes.created_at', 'DESC');
            } ])
            ->first();
    }

    /**
     * Obtem o nome da classe que realizou o acionamento
     *
     * @return \App\Models\Usuario
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
     * @return \App\Models\Usuario|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function findById(int $id): ?Usuario
    {
        return self::getCalledClass()::where(self::getClassPrimaryKey(), $id)->first();
    }

    /**
     * Realiza a busca de um determinado registro na base considerando o uuid fornecido
     *
     * @param string $uuid
     * @return \App\Models\Usuario
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function findByUuid(string $uuid): ?Usuario
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
     * @return \App\Models\Usuario
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function firstOrNew(?int $id): Usuario
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
     * @return \App\Models\Usuario
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function firstOrNewHasComposite(array $arrayData): Usuario
    {
        $class = self::getCalledClass();
        return \count($arrayData) > 0 ? $class::firstOrNew($arrayData) : new $class();
    }

   /**
    * Cria um novo registro no banco de dados
    *
    * @param array $arrayData
    * @return \App\Models\Usuario
    * @author Flávio Caetano <flavioluzio22@gmail.com>
    */
    public static function store(array $arrayData): Usuario
    {
        return self::getCalledClass()::create($arrayData);
    }

    /**
     * Sava as alterações do modelo que realizou o acionamento.
     * Se o registro existir o mesmo será atualizado, caso contrário, um novo registro será criado
     *
     * @param \App\Models\Usuario $calledClass
     * @return \App\Models\Usuario|null
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function save(Usuario $calledClass): ?Usuario
    {
        return $calledClass->save() ? $calledClass : null;
    }

    /**
     * Atualiza os dados do registro considerando o modelo e dados fornecidos
     *
     * @param array $arrayData
     * @param App\Models\Usuario $calledClass
     * @return bool
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function update(array $arrayData, Usuario $calledClass): bool
    {
        return $calledClass->update($arrayData);
    }

    /**
     * Remove o registro considerando o modelo fornecido
     *
     * @param Usuario $calledClass
     * @return bool
     * @author Flávio Caetano <flavioluzio22@gmail.com>
     */
    public static function destroy(Usuario $calledClass): bool
    {
        return $calledClass->delete();
    }
}
