<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // protected $connection = 'mysql'; 
    protected $table = 'sales';
    public $timestamps = true;
    public $primaryKey = 'sale_id';
    public $incrementing = false;
    protected $guarded = [];
}
