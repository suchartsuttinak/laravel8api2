<?php

namespace App\Models;

use GuzzleHttp\Psr7\AppendStream;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

  //  เพิ่ม geter ไปยัง jasan

    protected $appends = ['fullname', 'age'];

    public function getFullnameAttribute(){
        return $this->firstname . ' ' . $this->lastname;

    }
    public function getAgeAttribute(){
        return now()->diffInYears($this->dob);

    }



    public function department(){
       // return $this->belongsTo(Department::class);
        return $this->belongsTo(Department::class, 'department_id', 'id');

    }

    public function user(){
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
