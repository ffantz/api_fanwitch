<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public static function getClass();
    public static function getPrimaryKeyName(): string;
}
