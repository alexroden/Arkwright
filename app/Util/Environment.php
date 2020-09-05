<?php

namespace App\Util;

use Illuminate\Support\Facades\Config;

final class Environment
{
    /**
     * @return bool
     */
    public static function isLocal(): bool
    {
        return Config::get('app.env') === 'local';
    }

    /**
     * @return bool
     */
    public static function isProduction(): bool
    {
        return Config::get('app.env') === 'production';
    }

    /**
     * @return bool
     */
    public static function isTest(): bool
    {
        return Config::get('app.env') === 'testing';
    }
}
