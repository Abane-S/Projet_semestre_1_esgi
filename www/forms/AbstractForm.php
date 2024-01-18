<?php
namespace App\Forms;

abstract class AbstractForm
{
    abstract public function getConfig(): array;
    public function isSubmit(): bool
    {   
        // echo $this->getMethod() . ' ' . $_SERVER['REQUEST_METHOD'];
        return $_SERVER['REQUEST_METHOD'] === $this->getMethod();   
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}