<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\EloquentBuilderInterface;
use DB;

class FactoryBuilder extends BaseBuilder implements BuilderInterface, EloquentBuilderInterface
{

    protected $stub;

    protected $stubPath;

    protected $name;

    protected $tableName;

    protected $primaryKey;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';


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

    public function setStub()
    {
        $this->stub = $this->files->get($this->getStubPath());
        return $this;
    }

    public function setTable($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
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
        $path = database_path("factories/".$this->name."Factory.php");

        $stub = $this->setStub()
                     ->replaceNamespace($className)
                     ->replaceNameFactory()
                     ->replaceValueFillable()
                     ->buildStub();

        $this->files->put($path, $stub);

        return $this->type.' created successfully.';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $path
     * @param  string  $stub
     * @return int
     */
    protected function addFactoryToFactoryFile($path, $stub)
    {
        return file_put_contents(
            $path,
            $stub,
            FILE_APPEND
        );
    }

    public function buildStub()
    {
        return $this->stub;
    }


    /**
     * Replace the namespace dummy for the given stub.
     *
     * @param  string  $namespace
     * @return $this
     */
    protected function replaceNamespace($namespace)
    {
        $this->stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace'],
            [$this->getNamespace($namespace), $this->rootNamespace()],
            $this->stub
        );

        return $this;
    }

    protected function replaceNameFactory()
    {
        $this->stub = str_replace('DummyNameFactory', $this->name, $this->stub);
        return $this;
    }

    /**
     * Replace the fillable dummy for the given stub.
     *
     * @return $this
     */
    public function replaceValueFillable()
    {
        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            "ID",  "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $fillable = [];
        $faker = ' - ';
        foreach ($columns as $key => $value) {
            if (!in_array(Str::upper($key), $removeFieldList)) {
                $fillable[] = "'{$key}' => '$faker' \r\n\t\t\t";
            }
        }

        $this->stub = str_replace('DummyValueFillable', implode(",", $fillable), $this->stub);

        return $this;
    }

    /**
     * Get the default namespace for the class.
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\Services\\" . $this->getPluralName();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new model factory file for the model.'],
        ];
    }

}
