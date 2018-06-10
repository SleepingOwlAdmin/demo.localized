<?php

namespace App\Console\Commands\System;

use Illuminate\Console\Command;

class OpcacheClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear php opcache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (opcache_reset()) {
            $this->info("Opcache cleared.");
            return;
        }

        $this->error("Opcache not cleared.");
    }
}