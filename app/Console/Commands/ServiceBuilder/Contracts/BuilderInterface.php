<?php

namespace App\Console\Commands\ServiceBuilder\Contracts;

interface BuilderInterface
{

    /**
     * Get the name file for the generator.
     *
     */
    public function getName();

    /**
     * Get the type file for the generator.
     *
     */
    public function getType();


    /**
     * Get the builder
     *
     */
    public function build();
}
