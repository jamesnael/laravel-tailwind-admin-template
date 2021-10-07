<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class GenerateLaravelVuei18nCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'i18n:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate localization files for vue js based on laravel\'s localization.';

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
        $output = [];
        $langFolders = File::directories(resource_path('lang'));
        foreach ($langFolders as $lang) {
            $langName = collect(explode('\\', $lang))->last();
            App::setLocale($langName);
            $json = File::exists(resource_path('lang\\'.$langName.'.json')) ? json_decode(File::get(resource_path('lang\\'.$langName.'.json'))) : [];

            $output[$langName] = collect(File::allFiles($lang))->flatMap(function ($file) {
                return [
                    ($translation = $file->getBasename('.php')) => trans($translation),
                ];
            })->merge(["default" => $json]);
        }
        File::put(resource_path('js\\i18n.json'), json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
        $this->info('i18n file generated successfully!');
    }
}
