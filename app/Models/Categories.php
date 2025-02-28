<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // protected $connection = 'mysql'; 
    protected $table = 'categories';
    public $timestamps = true;
    public $primaryKey = 'category_id';
    public $incrementing = false;
    protected $guarded = [];
}
