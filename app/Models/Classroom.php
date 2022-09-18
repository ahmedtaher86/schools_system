<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model 
{

    protected $table = 'classrooms';
    public $timestamps = true;
    
    protected $fillable = ['name_ar','name_en','grade_id','created_at','updated_at'];



    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    

}