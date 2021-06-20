<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    public function department(){
       // return $this->belongsTo(Department::class);
        return $this->belongsTo(Department::class, 'department_id', 'id');

    }
}
