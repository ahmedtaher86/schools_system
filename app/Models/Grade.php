<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{


    protected $fillable = ['name_ar','name_en','notes' ,'created_at' , 'updated_at'];
    protected $table = 'grades';
    public $timestamps = true;



    public function classrooms()
    {
        return $this->hasMany('App\Models\Classroom', 'grade_id');
    }

    




}