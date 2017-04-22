<?php

namespace App\Controllers;

class Controller
{
    /**
     * [$container description].
     *
     * @var [type]
     */
    protected $container;

    /**
     * @param [type]
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param  [type]
     *
     * @return [type]
     */
    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}
