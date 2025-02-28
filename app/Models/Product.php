<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $connection = 'mysql'; 
    protected $table = 'products';
    public $timestamps = true;
    public $primaryKey = 'product_id';
    public $incrementing = false;
    protected $guarded = [];
}
