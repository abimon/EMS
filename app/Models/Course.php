<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'dep_id',
        'course_name',
    ];
    protected $guarded = ['id'];
    public function Dep(){
        return $this->belongsTo(Department::class, 'dep_id', 'id');
    }
    public function units()
    {
        return $this->hasMany(Unit::class, 'course_id', 'id');
    }

}
