<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Environment.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('sec_env')) {
    /**
     * @param $name
     * @param null $fallback
     *
     * @return mixed|string
     */
    function sec_env($name, $fallback = null)
    {
        $env = require __DIR__.'./../config/env.php';
        $crypt = new Illuminate\Encryption\Encrypter($env['key']);

        $value = env($name);

        return empty($value)
                    ? env($name, $fallback)
                    : $crypt->decrypt(substr($value, 4));
    }
}
