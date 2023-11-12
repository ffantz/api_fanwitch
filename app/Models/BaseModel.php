<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use Traits\Scope;

    public static function insereHistoricoAlteracoes($model, $indexDebug = 8)
    {
        try {
            $table = $model->table;
            $classe = "-";
            $funcao = "-";
            $linha = "-";
            $logsAlteracao = [];

            //Verifica e adiciona no array os valores modificados
            foreach ($model->original as $index => $data) {
                if ($model->original[$index] != $model->attributes[$index]) {
                    $logsAlteracao["de"][$index] = $model->original[$index];
                    $logsAlteracao["para"][$index] = $model->attributes[$index];
                }
            }

            //Verifica se existe usuario logado e atribui ao array.
            if (\Auth::check()) {
                $logsAlteracao["id_usuario"] = \Auth::user()->id;
            }

            // Popula o array com as informações do Model e Origem da Modificação;
            $logsAlteracao["id"] = strtotime('now');
            $logsAlteracao["tabela"] = $table . "_" . $model->id;
            $logsAlteracao["updated_at"] = \Carbon\Carbon::now()->format("Y-m-d H:i:s");

            $backTrace = isset(debug_backtrace()[$indexDebug]) ? debug_backtrace()[$indexDebug] : null ;
            if ($backTrace) {
                $classe = isset($backTrace["class"]) ? $backTrace["class"] : $classe;
                $funcao = isset($backTrace["function"]) ? $backTrace["function"] : $funcao;
                $linha = isset($backTrace["line"]) ? $backTrace["line"] : $linha;
            }

            $logsAlteracao["route_information"]["class"] = $classe;
            $logsAlteracao["route_information"]["function"] = $funcao;
            $logsAlteracao["route_information"]["line"] = $linha;

            // Cria registro no Elastic
            \App\Jobs\ElasticsearchJob::dispatch("inserirHistoricoAlteracao", null, new \Illuminate\Http\Request($logsAlteracao))->onQueue("elasticsearch");
        } catch (\Exception $e) {
            customLog("historico-alteracoes", "Erro ao inserir registro no historico de alteracoes.| ERRO: {$e->getMessage()} | ");
        }
    }

    public function getTableColumns()
    {
        $self = $this;
        $nomeCache = str_replace('{NOME_TABELA}', strtoupper($this->table), config('arquivos_cache.tables.tables_columns'));
        return \Cache::tags(['tables', 'tables-columns'])->rememberForever($nomeCache, function () use ($self) {
            return \Schema::getColumnListing($self->table);
        });
    }
}
