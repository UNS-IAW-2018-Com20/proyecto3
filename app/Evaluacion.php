<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Evaluacion extends Eloquent
{
  protected $connection = 'mongodb';
  #Automáticamente lee la tabla

  protected $collection = 'evaluaciones';
}
