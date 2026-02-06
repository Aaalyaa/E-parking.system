<?php

namespace App\Helpers;

class RoleHelper
{
    public static function isAdmin(): bool
    {
        return auth()->check()
            && auth()->user()->role->peran === 'admin';
    }
}