<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Liststorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Liste les images contenues dans le storage';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Voici la contenu du dossier image');
        dump(Storage::allFiles('images'));

        return 0;
    }
}
