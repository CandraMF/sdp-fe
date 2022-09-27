<?php

namespace App\HealthChecks;

use Illuminate\Support\Facades\Redis;
use UKFast\HealthCheck\HealthCheck;
use Exception;

class MicroserviceHealthCheck extends HealthCheck
{
    protected $name = 'services';

    public function status()
    {
        return $this->okay();
    }
}