<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\EloquentBuilderInterface;
use DB;

class ModelBuilder extends BaseBuilder implements BuilderInterface, EloquentBuilderInterface
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
    protected $type = 'Eloquent';


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
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        return "App\Models\\". $name;
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function build()
    {
        $className = $this->qualifyClass($this->getName());

        // get path
        $path = $this->getPath($className);
        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ($this->alreadyExists($className)) {
            return $this->type.' already exists!';
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $stub = $this->setStub()
                     ->replaceNamespace($className)
                     ->replaceTableName()
                     ->replacePrimaryKey()
                     ->replaceFillable()
                     ->replaceClass()
                     ->buildStub();
        
        $this->files->put($path, $stub);

        return $this->type.' created successfully.';
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

    /**
     * Replace the fillable dummy for the given stub.
     *
     * @return $this
     */
    public function replaceFillable()
    {
        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            Str::upper($this->primaryKey), "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $fillable = "";
        $properties = [];
        $swagger_properties = [];
        foreach ($columns as $key => $value) {
            if (!in_array(Str::upper($key), $removeFieldList)) {
                $fillable .= "'{$key}' ,";
            }
            $properties[] = "     * @property ".$value->getType()->getName()." ".$key;
            $swagger_properties[] = '     *      @OA\Property(property="'.$key.'", type="'.$value->getType()->getName().'"),';
        }

        $this->stub = str_replace('DummyFillable', rtrim($fillable,", "), $this->stub);
        $this->stub = str_replace('DummySwaggerProperty', implode("\r\n", $swagger_properties), $this->stub);
        $this->stub = str_replace('DummyProperty', implode("\r\n", $properties), $this->stub);
        return $this;
    }


    /**
     * Replace the cast dummy for the given stub.
     *
     * @return $this
     */
    public function replaceCasts()
    {
        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $casts = "";
        foreach ($columns as $key => $column) {
            if (!in_array(Str::upper($key), $removeFieldList)){
                $casts .= "\t'{$key}' => '{$column->getType()->getName()}',\n";
            }
        }

        $this->stub = str_replace('DummyCasts', $casts, $this->stub);

        return $this;
    }

    /**
     * Replace the table name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceTableName()
    {
        $this->stub = str_replace('DummyTable', $this->tableName, $this->stub);

        return $this;
    }

    /**
     * Replace the primary key dummy for the given stub.
     *
     * @return $this
     */
    protected function replacePrimaryKey()
    {
        $this->stub = str_replace('DummyPrimaryKey', $this->primaryKey, $this->stub);

        return $this;
    }

    /**
     * Replace the class name dummy for the given stub.
     *
     * @return string
     */
    protected function replaceClass()
    {
        $class = str_replace($this->getNamespace($this->getName()).'\\', '', $this->getName());

        $this->stub = str_replace('DummyClass', $class, $this->stub);
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
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
        ];
    }

}
