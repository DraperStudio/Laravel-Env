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

namespace Artisanry\Environment\Console\Commands;

class RefreshEnvCommand extends EnvCommand
{
    /**
     * @var string
     */
    protected $signature = 'env:refresh';

    /**
     * @var string
     */
    protected $description = 'Re-Encrypt the .env file.';

    public function handle()
    {
        $contents = $this->getEnvVars('backup')->map(function ($value, $key) {
            return $this->buildEncryptedString($key, $value);
        });

        $this->write('encrypted', $contents);
    }
}
