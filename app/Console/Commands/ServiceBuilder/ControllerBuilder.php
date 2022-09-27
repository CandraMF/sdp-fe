<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Console\Commands\ServiceBuilder\Contracts\BuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\EloquentBuilderInterface;
use App\Console\Commands\ServiceBuilder\Contracts\GitRepositoryBuilderInterface;
use DB;

class ControllerBuilder extends BaseBuilder implements BuilderInterface, EloquentBuilderInterface, GitRepositoryBuilderInterface
{

    protected $stub;
    protected $stubPath;
    protected $name;
    protected $tableName;
    protected $primaryKey;
    protected $repoName;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

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

    public function setRepoName($repoName)
    {
        $this->repoName = $repoName;
        return $this;
    }

    public function getRepoName()
    {
        return $this->repoName;
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
                     ->replaceTableName()
                     ->replacePrimaryKey()
                     ->replaceClass()
                     ->replaceRepositoryName()
                     ->replaceRepositoryRule()
                     ->replaceName()
                     ->replacePluralName()
                     ->replaceJsonResourceName()
                     ->replaceUseServiceName()
                     ->replaceRequestName()
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
     * Replace the repository rule dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceRepositoryRule()
    {

        $schema = DB::getDoctrineSchemaManager();
        $columns = collect($schema->listTableDetails($this->tableName)->getColumns());

        $removeFieldList = [
            Str::upper($this->primaryKey), "CREATED_AT", "UPDATED_AT", "DELETED_AT", "IS_DELETED", 
            "STATUS_DOWNLOAD", "CREATED,CREATED_BY", "UPDATED", "UPDATED_BY"
        ];

        $fillable = [];
        $swagger_post_param = [];
        $swagger_post_response = [];
        $swagger_put_param = [];
        $swagger_put_response = [];
        $path_id = "id";
        $label_dropdown_v = [];
        $fields_list = [];
        foreach ($columns as $key => $value) {
            $path_id = (strtoupper($key) == strtoupper($this->primaryKey)) ? $value->getType()->getName() : "id";
            if (!in_array(Str::upper($key), $removeFieldList)) {
                $fillable[$key] = ($value->getNotnull()) ? 'required' : 'nullable';
                if ($value->getNotnull()) {
                    $label_dropdown_v[] = $key;
                    $swagger_post_param[] = '*              @OA\Property(property="'.$key.'", ref="#/components/schemas/'.$this->getName().'/properties/'.$key.'")';
                    $swagger_post_response[] = '*              @OA\Property(property="'.$key.'", type="array", @OA\Items(example={"'.ucfirst($key).' field is required."}))';
                    $swagger_put_response[] = '*              @OA\Property(property="'.$key.'", type="array", @OA\Items(example={"'.ucfirst($key).' field is required."}))';
                }
            }
            $f_type = $this->getDBType($value->getType()->getName());
            switch ($f_type) {
                case "TINYINT" :
                    $f_type .= "(1)";
                    break;
                case "VARCHAR" : 
                case "INT" : 
                case "SMALLINT" : 
                case "BIGINT" : 
                    $f_type .= "(".$value->getLength().")";
                    break;
                case "DECIMAL" : 
                    $f_type .= "(".$value->getLength().", ".$value->getPrecision().")";
                    break;
                default :
                    $f_type .= "";
                    break;                    
            }
            $f_null = $value->getNotnull() ? "NO" : "YES";
            $f_key = (strtoupper($key) == strtoupper($this->primaryKey)) ? "PRI" : null;
            $f_extra = '';
            if ($value->getUnsigned()) {
                $f_extra .= ' UNSIGNED';
            }
            if ($value->getAutoincrement()) {
                $f_extra .= ' AUTO_INCREMENT';
            }
            $fields_list[] = [
                'Field' => $key,
                'Type' => $f_type,
                'Null' => $f_null,
                'Key' => $f_key, 
                'Default' => $value->getDefault(),
                'Extra' => $f_extra
            ];
        }
        $sw_post_param = !empty($swagger_post_param) ? implode(",\r\n", $swagger_post_param)."," : null;
        $sw_post_response = !empty($swagger_post_response) ? implode(",\r\n", $swagger_post_response) : null;
        //$sw_put_param = !empty($swagger_put_param) ? implode(",\r\n", $swagger_put_param)."," : null;
        $sw_put_response = !empty($swagger_put_response) ? implode(",\r\n", $swagger_put_response) : null;
        $label_dropdown = !empty($label_dropdown_v) ? $label_dropdown_v[0] : $this->primaryKey;
        $sort_field = $label_dropdown.":desc";

        $this->stub = str_replace('DummyRepositoryRules', var_export($fillable, true), $this->stub);
        $this->stub = str_replace('DummySwaggerPostParam', $sw_post_param, $this->stub);
        $this->stub = str_replace('DummySwaggerPostResponse', $sw_post_response, $this->stub);
        $this->stub = str_replace('DummySwaggerPutParam', $sw_post_param, $this->stub);
        $this->stub = str_replace('DummySwaggerPutResponse', $sw_put_response, $this->stub);
        $this->stub = str_replace('DummyPathID', $path_id, $this->stub);
        $this->stub = str_replace('DummyLabelDropdown', $label_dropdown, $this->stub);
        $this->stub = str_replace('DummySchemaFields', var_export($fields_list, true), $this->stub);
        $this->stub = str_replace('DummySortField', $sort_field, $this->stub);
        $this->stub = str_replace('DummyListFields', implode(",", array_keys($fillable)), $this->stub);
        $this->stub = str_replace('DummyRepoName', $this->repoName, $this->stub);

        return $this;
    }

    protected function getDBType($search="") 
    {
        $types = array(
            'string' => 'VARCHAR',
            'integer' => 'INT',
            'smallint' => 'SMALLINT',
            'bigint' => 'BIGINT',
            'boolean' => 'TINYINT',
            'decimal' => 'DECIMAL',
            'date' => 'DATETIME',
            'time' => 'TIME',
            'datetime' => 'TIMESTAMP',
            'datetimetz' => 'TIMESTAMP',
            'text' => 'TEXT',
            'float' => 'DECIMAL',
            'guid' => 'VARCHAR',
            'blob' => 'BLOB'
        );
        return isset($types[strtolower($search)]) ? $types[strtolower($search)] : "VARCHAR";
    }

    /**
     * Replace the repository name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceRepositoryName()
    {
        $this->stub = str_replace('DummyRepositoryName', $this->getRepositoryName(), $this->stub);
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
     * Replace the name dummy for the given stub.
     *
     * @return $this
     */
    protected function replacePluralName()
    {
        $this->stub = str_replace('DummyPluralName', $this->getPluralName(), $this->stub);
        return $this;
    }

    /**
     * Replace the name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceJsonResourceName()
    {
        $this->stub = str_replace('DummyJsonResourceName', strtolower($this->getName()), $this->stub);
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
    protected function replaceName()
    {
        $this->stub = str_replace('DummyName', Str::studly($this->getName()), $this->stub);
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

    protected function buildStub()
    {
        return $this->stub;
    }

    /**
     * Replace the service name dummy for the given stub.
     *
     * @return string
     */
    public function replaceUseServiceName()
    {
        $this->stub = str_replace(
            "DummyUseServiceName",
            $this->getName()."\\".$this->getRepositoryName(),
            $this->stub);

        return $this;
    }

    /**
     * Replace the reqyest name dummy for the given stub.
     *
     * @return $this
     */
    protected function replaceRequestName()
    {
        $this->stub = str_replace('DummyRequestName', $this->getRequestName(), $this->stub);
        return $this;
    }

    /**
     * Overide Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
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
