<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // protected $connection = 'mysql'; 
    protected $table = 'sub_category';
    public $timestamps = true;
    public $primaryKey = 'sub_category_id';
    public $incrementing = false;
    protected $guarded = [];
}
