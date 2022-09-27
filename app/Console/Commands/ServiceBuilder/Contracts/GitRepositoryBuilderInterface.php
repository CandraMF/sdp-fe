<?php

namespace App\Console\Commands\ServiceBuilder\Contracts;

interface GitRepositoryBuilderInterface
{
    /**
     * Set repo name
     *
     * @return string
     */
    public function setRepoName($repoName);

}
