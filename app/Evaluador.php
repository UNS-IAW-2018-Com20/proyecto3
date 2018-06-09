<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Evaluador extends Eloquent
{
  protected $connection = 'mongodb';
  #Automáticamente lee la tabla

  protected $collection = 'evaluadores'; 
}
