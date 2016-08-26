<?php
namespace App\Http;

class Controller
{

  protected $ci;


  public function __construct($ci)
  {
    $this->ci = $ci;
  }

}
