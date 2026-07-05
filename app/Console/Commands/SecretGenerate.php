<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('secret:generate')]
#[Description('Command description')]
class SecretGenerate extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $key = Str::random(64);

        $path = base_path('.env');
        $env = file_get_contents($path);

        if (preg_match('/^APP_SECRET=.*/m', $env)) {
            $env = preg_replace(
                '/^APP_SECRET=.*/m',
                "APP_SECRET={$key}",
                $env
            );
        } else {
            $env .= PHP_EOL . "APP_SECRET={$key}" . PHP_EOL;
        }

        file_put_contents($path, $env);

        $this->components->info('APP_SECRET_KEY generated successfully.');
        $this->line($key);

        return self::SUCCESS;
    }
}
