<?php

namespace App\Models\Traits;

/**
 * Defining generic scope to be reused in models to assist in queries
 *
 * @author Flávio Caetano <flavioluzio22@gmail.com>
 */
trait Scope
{
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAscCreatedAt($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}
