<?php

namespace App\Console\Commands\ServiceBuilder;

use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use Illuminate\Support\Str;

class ServiceFactory
{

    protected $serviceName;
    protected $tableName;
    protected $primaryKey;
    protected $class;
    protected $type;
    protected $repoName;

    function __construct($serviceName, $tableName, $primaryKey, $repoName)
    {
        $this->serviceName = $serviceName;
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
        $this->repoName = $repoName;
    }

    protected function isExist($class)
    {
        if (class_exists($class)) {
            return true;
        }
        return $path;
    }

    public function register($class, $type)
    {
        $this->class = $class;
        $this->type = Str::studly($type);

        return $this;
    }

    public function build()
    {
        if (!$this->isExist($this->class)) {
            return "Class Not Found!";
        }

        switch ($this->type) {
            case 'Controller':
                $controller = app()->make($this->class);
                return $controller->setStubPath(__DIR__.'/../Stubs/controller.stub')
                            ->setTable($this->tableName)
                            ->setName($this->serviceName)
                            ->setPrimaryKey($this->primaryKey)
                            ->setRepoName($this->repoName)
                            ->build();
                break;
            case 'Model':
                $model = app()->make($this->class);
                return $model->setStubPath(__DIR__.'/../Stubs/model.stub')
                             ->setTable($this->tableName)
                             ->setName($this->serviceName)
                             ->setPrimaryKey($this->primaryKey)
                             ->build();
                break;
            case 'Service':
                $repository = app()->make($this->class);
                return $repository->setStubPath(__DIR__.'/../Stubs/repository.stub')
                            ->setTable($this->tableName)
                            ->setName($this->serviceName)
                            ->setPrimaryKey($this->primaryKey)
                            ->build();
                break;
            case 'Route':
                $repository = app()->make($this->class);
                return $repository->setStubPath(__DIR__.'/../Stubs/route.stub')
                                  ->setName($this->serviceName)
                                  ->build();
                break;
            case 'Factory':
                $repository = app()->make($this->class);
                return $repository->setStubPath(__DIR__.'/../Stubs/factory.stub')
                                  ->setTable($this->tableName)
                                  ->setName($this->serviceName)
                                  ->build();
                break;
            case 'Testcase':
                $repository = app()->make($this->class);
                return $repository->setStubPath(__DIR__.'/../Stubs/testcase.stub')
                                  ->setTable($this->tableName)
                                  ->setName($this->serviceName)
                                  ->build();
                break;

            default:
                return "Type not found!";
                break;
        }

    }

}
