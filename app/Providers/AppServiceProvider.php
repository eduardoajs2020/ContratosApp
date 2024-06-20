<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       // Obter o caminho do banco de dados do arquivo .env
        $databasePath = env('DB_DATABASE', database_path('contratosDb.db'));

        // Certifique-se de que o diretório existe
        $directory = dirname($databasePath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Criar o banco de dados SQLite se não existir
        if (env('DB_CONNECTION') === 'sqlite' && !File::exists($databasePath)) {
            File::put($databasePath, '');
        }
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
