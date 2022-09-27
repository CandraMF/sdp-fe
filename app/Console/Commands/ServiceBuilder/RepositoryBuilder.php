<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\EloquentBuilderInterface;
use DB;

class RepositoryBuilder extends BaseBuilder implements BuilderInterface, EloquentBuilderInterface
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
    protected $type = 'Service';

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
        $path = $this->getPath($className);

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
                     ->replaceEloquentName()
                     ->replaceTableName()
                     ->replaceDbField()
                     ->buildStub();

        $this->files->put($path, $stub);

        return $this->type.' created successfully.';
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
     * Replace the namespace dummy for the given stub.
     *
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
     * Replace the name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceEloquentName()
    {
        $this->stub = str_replace('DummyEloquentName', $this->getEloquentName(), $this->stub);
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

        $this->stub = str_replace('DummyClass', $class. $this->type, $this->stub);
        return $this;
    }

    /**
     * Replace the repository rule dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceDbField()
    {

        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            Str::upper($this->primaryKey), "CREATED_AT", "UPDATED_AT", "DELETED_AT"
        ];

        $fields = [];
        $mappingFields = [];
        $showFields = [];
        foreach ($columns as $key => $value) {
            $fields[] = '"'.$key.'"';
            $mappingFields[$key] = "\$val[".$key."]";
            $showFields[$key] = "\${$this->tableName}->$key";
        }

        $mapping_val = var_export($mappingFields, true);
        $mapping_val = str_replace("=> '", "=> ", $mapping_val);
        $mapping_val = str_replace("[", "['", $mapping_val);
        $mapping_val = str_replace("]'", "']", $mapping_val);

        $show_val = var_export($showFields, true);
        $show_val = str_replace("=> '", "=> ", $show_val);
        $show_val = str_replace("',", ",", $show_val);

        $this->stub = str_replace('DummyFieldList', implode(",", $fields), $this->stub);
        $this->stub = str_replace('DummyMappingList', $mapping_val, $this->stub);
        $this->stub = str_replace('DummyShowList', $show_val, $this->stub);
        $this->stub = str_replace('DummyPKey', $this->primaryKey, $this->stub);
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
        return $rootNamespace . "\Services";
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
