<?php

namespace App\Console\Commands\ServiceBuilder\Contracts;

interface TransformerBuilderInterface
{
    /**
     * Set table
     *
     * @return string
     */
    public function setTable($tableName);

    /**
     * Set primary key
     *
     * @return string
     */
    public function setPrimaryKey($primaryKey);
}
