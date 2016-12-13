<?php

namespace Common;

class Di
{
    private $services = [];

    private $di = [];

    public function __construct()
    {
        $this->di = require __DIR__ . '/../config/di.php';
    }

    public function get(string $name)
    {
        if ($this->services[$name] === null) {
            $this->services[$name] = $this->di[$name]();
        }
        return $this->services[$name];
    }
}
