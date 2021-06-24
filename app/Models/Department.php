<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    public function officers(){

          //  return $this->hasMany(Officer::class);
            return $this->hasMany(Officer::class, 'department_id', 'id');
    }


}
