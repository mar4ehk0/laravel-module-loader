<?php

namespace Mar4ehk0\ModuleLoader;

use DirectoryIterator;
use Illuminate\Support\ServiceProvider;


class ModuleLoaderServiceProvider extends ServiceProvider
{

    private string $modulesPath;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->modulesPath = base_path('modules');
    }

    public function register()
    {

    }

    public function boot(): void
    {
        $this->bootRoutes();

        if ($this->app->runningInConsole()) {
            $this->bootMigrations();
        }
    }

    protected function bootRoutes(): void
    {
        $this->loadRoutesFrom(glob($this->modulesPath . '/*/Routes', GLOB_ONLYDIR));

//        foreach ($this->modulesName as $moduleName) {
//            $path = $this->modulesPath . '/' . $moduleName . '/Routes/web.php';
//            $this->loadRoutesFrom($path);
//        }
    }

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(glob($this->modulesPath . '/*/Database/Migrations', GLOB_ONLYDIR));
    }


}
