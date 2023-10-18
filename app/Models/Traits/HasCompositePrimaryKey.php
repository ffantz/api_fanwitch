<?php

namespace App\Models\Traits;

use LaravelTreats\Model\Traits\HasCompositePrimaryKey as LaravelTreatsHasCompositePrimaryKey;

trait HasCompositePrimaryKey
{
    use LaravelTreatsHasCompositePrimaryKey {
        LaravelTreatsHasCompositePrimaryKey::setKeysForSaveQuery as parentSetKeysForSaveQuery;
    }

    protected function setKeysForSaveQuery($query)
    {
        return $this->parentSetKeysForSaveQuery($query);
    }
}
