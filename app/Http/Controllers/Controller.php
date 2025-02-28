<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $menu = [];

        $categories = Categories::all();

        foreach ($categories as $category) {
            $SubCategory = SubCategory::where("category_id", $category->category_id)->get();
            $subCatArr = [];
            foreach ($SubCategory as $subCat) {
                $subCatArr[] = ["sub_category_id" => $subCat->sub_category_id, "sub_category_name" => $subCat->sub_category_name];
            }
            $menu[] = array_merge(
                ["category_id" => $category->category_id, "name" => $category->name],
                ['sub_categories' => $subCatArr],
            );
        }

        view()->share('menu', $menu);
        view()->share('supliers', ['Smart Biz', 'Frajosan IT consultancies', 'Techno', 'Infinix', 'Muthoni Agrovet']);
        view()->share('products_statuses', ['active', 'discontinued', 'out of stock']);
    }
}
