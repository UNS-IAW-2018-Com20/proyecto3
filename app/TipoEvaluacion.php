<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TipoEvaluacion extends Eloquent
{
  protected $connection = 'mongodb';
  #Automáticamente lee la tabla

  protected $collection = 'tipos_de_evaluacion'; 
}
