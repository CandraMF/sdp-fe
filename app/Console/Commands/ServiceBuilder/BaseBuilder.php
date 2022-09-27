<?php

namespace App\Console\Commands\ServiceBuilder;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

abstract class BaseBuilder
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /**
     * stub for template
     *
     * @var string
     */
    protected $stub;


    /**
     * Get the builder
     *
     * @return string
     */
    abstract public function setStubPath($stubPath);

    /**
     * Get the builder
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Get the builder
     *
     * @return string
     */
    abstract protected function buildStub();


    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return app()->path().'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * check file exists
     *
     * @param  string  $path
     * @return boolean
     */
    protected function makeFile($name, $path, $stub)
    {
        return $this->files->put($path, $stub);
    }


    /**
     * check file exists
     *
     * @param  string  $path
     * @return boolean
     */
    protected function fileExists($path)
    {
        return $this->files->exists($path);
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->getName());
    }


    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return app()->getNamespace();
    }


    /**
     * Get Controller Class Name
     *
     * @return string
     */
    protected function getClassName()
    {
        return $this->getName() . $this->getType();
    }

    /**
     * Get Repository Class Name
     *
     * @return string
     */
    protected function getRepositoryName()
    {
        return $this->getName() . "Service";
    }

    /**
     * Get Transformer Class Name
     *
     * @return string
     */
    protected function getTransformerName()
    {
        return $this->getName() . "Transformer";
    }

    /**
     * Get Eloquent Class Name
     *
     * @return string
     */
    protected function getEloquentName()
    {
        return $this->getName();
    }

    /**
     * Get Request Class Name
     *
     * @return string
     */
    protected function getRequestName()
    {
        return $this->getName() . "Request";
    }

    /**
     * Get plural name
     *
     * @return string
     */
    protected function getPluralName($lowercase = false)
    {
        if ($lowercase) {
            return Str::studly(strtolower(Str::plural($this->getName())));
        }

        return Str::studly(Str::plural($this->getName()));
    }

    /**
     * Get search criteria name
     *
     * @return string
     */
    protected function getSearchCriteriaName()
    {
        return $this->getName() . "SearchCriteria";

    }

}
