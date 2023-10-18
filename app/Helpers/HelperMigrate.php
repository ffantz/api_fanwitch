<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;

class HelperMigrate
{
    public function bluePrintMacros()
    {
        Blueprint::macro('usuario', function($nullable = false, $after = null){
            $result = $nullable ? $this->bigInteger('id_usuario')->nullable()->unsigned() : $this->bigInteger('id_usuario')->unsigned();
            !\is_null($after) ? $result->after($after) : true;
        });

        Blueprint::macro('status', function(){
            $this->enum('status', ['0', '1'])->default('0');
        });

        Blueprint::macro('addUuid', function($after = null, $nullable = false){
            $queryBuilder = $this->uuid("uuid")->index();
            if (\is_null($after))
            {
                $queryBuilder->after($after);
            }
            if ($nullable)
            {
                $queryBuilder->nullable();
            }
        });

        Blueprint::macro('addFk', function($nomeTabela, $nomeFk, $onDelete = 'RESTRICT'){
            $this->foreign('id_'.$nomeTabela, $nomeFk)->references('id')->on($nomeTabela)->onUpdate('RESTRICT')->onDelete($onDelete);
        });

        Blueprint::macro('dropFk', function($nomeFk){
            $this->dropForeign($nomeFk);
        });

        Blueprint::macro('comment', function($comentario){
            \DB::statement("ALTER TABLE `$this->table` COMMENT = '$comentario'");
        });
    }
}