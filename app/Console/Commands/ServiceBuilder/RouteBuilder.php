<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;

class RouteBuilder extends BaseBuilder implements BuilderInterface
{

    protected $stub;

    protected $stubPath;

    protected $name;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Route';

    /**
     * Constructor
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function setStubPath($stubPath)
    {
        $this->stubPath = $stubPath;
        return $this;
    }

    protected function getStubPath()
    {
        return $this->stubPath;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function build()
    {
        $className = $this->qualifyClass($this->getClassName());

        // get path
        $path = base_path("routes/web.php");

        // blank stub
        $blankStub = $this->files->get(__DIR__.'/../Stubs/blank.stub');

        $stub = $this->setStub()
                     ->replaceName()
                     ->replacePluralName()
                     ->buildStub();

        if (!$this->fileExists($path)) {
            $this->makeFile("web.php", $path, $blankStub);
        }

        $this->addRoutesToDomainRouteFile($path, $stub);

        return $this->type.' created successfully.';
    }


    /**
     * Build the class with the given name.
     *
     * @param  string  $path
     * @param  string  $stub
     * @return int
     */
    protected function addRoutesToDomainRouteFile($path, $stub)
    {
        return file_put_contents(
            $path,
            $stub,
            FILE_APPEND
        );
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function setStub()
    {
        $this->stub = $this->files->get($this->getStubPath());

        return $this;
    }

    /**
     * Replace the plural name dummy for the given stub.
     *
     * @return $this
     */
    protected function replacePluralName()
    {
        $this->stub = str_replace('DummyPluralName', Str::lower($this->getName()), $this->stub);
        return $this;
    }

    /**
     * Replace the name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceName()
    {
        $this->stub = str_replace('DummyName', Str::studly($this->getName()), $this->stub);
        return $this;
    }


    protected function buildStub()
    {
        return $this->stub;
    }

    /**
     * Overide Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', null, InputOption::VALUE_NONE, 'Generate a resource controller class.'],
        ];
    }

}
