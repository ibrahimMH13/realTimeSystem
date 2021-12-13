<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class KeyGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:generate ?';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the application key';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $appKey = $this->getGenerateKey();

        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents(
                $path,
                preg_replace('/(APP_KEY=)(\s|.*)\n/', ("APP_KEY={$appKey}\n"),
                file_get_contents($path))
            );
        }
        $this->info("Application key [$appKey] set successfully.");
    }
    protected function getGenerateKey()
    {
        return 'base64:'.base64_encode(Encrypter::generateKey($this->laravel['config']['app.cipher']));
    }


}
