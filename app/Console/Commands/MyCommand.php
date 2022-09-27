<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Console\Commands\ServiceBuilder\ServiceFactory;
use App\Console\Commands\ServiceBuilder\ControllerBuilder;
use App\Console\Commands\ServiceBuilder\ModelBuilder;
use App\Console\Commands\ServiceBuilder\RepositoryBuilder;
use App\Console\Commands\ServiceBuilder\SearchCriteriaBuilder;
use App\Console\Commands\ServiceBuilder\RouteBuilder;
use App\Console\Commands\ServiceBuilder\StoreRequestBuilder;
use App\Console\Commands\ServiceBuilder\UpdateRequestBuilder;
use App\Console\Commands\ServiceBuilder\FactoryBuilder;
use App\Console\Commands\ServiceBuilder\TestCaseBuilder;
use Illuminate\Filesystem\Filesystem;


class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name : Service Name} 
                            {--force : Replace existing service} 
                            {--route : Also add routing table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD Generator Command';


    /**
     * handle
     *
     * @return string
     */
    public function handle()
    {
        $name = Str::studly($this->argument('name'));

        if ((! $this->hasOption('force') || ! $this->option('force')) && $this->alreadyExists($name)) {
            $this->error("\n Service already exists!");
            $this->info("\n add --force option for replace existing service.");
            exit;
        }

        // get table name
        $defaultTableName = strtolower(Str::plural($name));
        $tableName = $this->ask('Table name?', $defaultTableName);
        if (!Schema::hasTable($tableName)) {
            $this->question("Table not found, create migration first.");
            exit(1);
        }

        // get primary key
        $defaultPrimaryKey = 'id';
        $primaryKey = $this->ask("PRIMARY KEY {$tableName} table?", $defaultPrimaryKey);
        if (!Schema::hasColumn($tableName, $primaryKey)) {
            $this->question("Field not found, please recheck table.");
            exit(1);
        }

        // get reposiroty
        $repoName = $this->ask("Git Repository/Microservices Name?", "common-tools");

        // service factory builder
        $factory = new ServiceFactory($name, $tableName, $primaryKey, $repoName);
        $factory->register(ControllerBuilder::class, "controller")->build();
        $factory->register(RepositoryBuilder::class, "service")->build();
        $factory->register(FactoryBuilder::class, "factory")->build();
        $factory->register(TestCaseBuilder::class, "testcase")->build();
        $factory->register(ModelBuilder::class, "model")->build();
        $this->info("Service has been generated.\n");

        if ($this->hasOption('route') && $this->option('route')) {
            $factory->register(RouteBuilder::class, "route")->build();
            $this->info($name . " Routing Table");
            $serviceName = strtolower($name);
            $headers = ["Method", "URI", "Action"];
            $body = [
                ["GET", "/{$serviceName}/schema", "{$name}Controller@schema"],
                ["GET", "/{$serviceName}", "{$name}Controller@index"],
                ["GET", "/{$serviceName}/dropdown", "{$name}Controller@dropdown"],
                ["POST", "/{$serviceName}", "{$name}Controller@store"],
                ["GET", "/{$serviceName}/{id}", "{$name}Controller@show"],
                ["PUT", "/{$serviceName}/{id}", "{$name}Controller@update"],
                ["DELETE", "/{$serviceName}", "{$name}Controller@destroy"],
            ];
            $this->table($headers, $body);
        }

    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($serviceName)
    {
        $file = new Filesystem;
        return $file->exists(app()->path()."/Services/".Str::studly($serviceName)."Service.php");
    }
}
