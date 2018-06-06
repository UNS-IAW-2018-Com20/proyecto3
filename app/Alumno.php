<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Alumno extends Eloquent
{
  protected $connection = 'mongodb';
  #Automáticamente lee la tabla
}
