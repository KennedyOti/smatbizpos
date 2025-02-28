<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    use HasFactory;

    // protected $connection = 'mysql'; 
    protected $table = 'sale_items';
    public $timestamps = true;
    public $primaryKey = 'sale_item_id';
    public $incrementing = false;
    protected $guarded = [];
}
