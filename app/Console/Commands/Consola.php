<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Consola extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diario';
    #https://laravel.com/docs/5.4/artisan#generating-commands
    #http://programacion.net/articulo/gestionando_cronjobs_con_laravel_1091
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //AQUI VA LO QUE HARA EL COMANDO

        
        
    }
}
