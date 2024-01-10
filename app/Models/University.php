<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'uni_name',
        'path'
    ];
    protected $guarded = ['id'];
    
    public function deps()
    {
        return $this->hasMany(Department::class, 'uni_id', 'id');
    }
}
