<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Escala extends Eloquent
{
  protected $connection = 'mongodb';
  #Automáticamente lee la tabla

  protected $collection = 'escalas_notas'; 
}
