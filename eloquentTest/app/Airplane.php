<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    //
    protected $table = 'my_airplane';

    // how to use
    public function getAll()
    {
        $filters = self::where('active', 1);

    }

}
