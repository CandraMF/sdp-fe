<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\EloquentBuilderInterface;
use DB;

class TestCaseBuilder extends BaseBuilder implements BuilderInterface, EloquentBuilderInterface
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
    protected $type = 'TestCase';


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
        $className = $this->getName().'ControllerTest';

        // get path

        $path = base_path("tests/".$className.".php");

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ($this->alreadyExists($this->getName())) {
            return $this->type.' already exists!';
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $stub = $this->setStub()
                     ->replaceNamespace($className)
                     ->replaceClass()
                     ->replaceValueFillableAdd()
                     ->replaceValueFillableEdit()
                     ->replaceEloquentName()
                     ->replaceLowerPluralName()
                     ->replacePluralName()
                     ->buildStub();

        $this->files->put($path, $stub);

        return $this->type.' created successfully.';
    }

    public function buildStub()
    {
        return $this->stub;
    }

    /**
     * Replace the plural name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceLowerPluralName()
    {
        $this->stub = str_replace('LowerPluralName', Str::lower($this->getName()), $this->stub);
        return $this;
    }

    /**
     * Replace the plural name dummy for the given stub.
     *
     * @return $this
     */
    protected function replacePluralName()
    {
        $this->stub = str_replace('DummyPluralName',$this->getName(), $this->stub);
        return $this;
    }

    /**
     * Replace the class name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceClass()
    {
        $this->stub = str_replace('DummyControllerTest', $this->getName().'ControllerTest', $this->stub);
        return $this;
    }
        /**
     * Replace the eloquent name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceEloquentName()
    {
        $this->stub = str_replace('DummyEloquentName', $this->getEloquentName(), $this->stub);
        return $this;
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
    public function replaceValueFillableAdd()
    {
        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            "ID",  "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $fillable = "";
        foreach ($columns as $key => $value) {
            if (!in_array(Str::upper($key), $removeFieldList)) {
                $fillable .= "'{$key}' => '1' , ";
            }
        }

        $this->stub = str_replace('DummyFillableAdd', rtrim($fillable,", "), $this->stub);

        return $this;
    }

    /**
     * Replace the fillable dummy for the given stub.
     *
     * @return $this
     */
    public function replaceValueFillableEdit()
    {
        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            "ID",  "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $fillable = "";
        foreach ($columns as $key => $value) {
            if (!in_array(Str::upper($key), $removeFieldList)) {
                $fillable .= "'{$key}' => '1' , ";
            }
        }

        $this->stub = str_replace('DummyFillableEdit', rtrim($fillable,", "), $this->stub);

        return $this;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new test case file for the model.'],
        ];
    }

}
