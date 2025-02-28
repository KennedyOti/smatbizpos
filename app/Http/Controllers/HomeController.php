<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function displayByCategory(Request $request)
    {
        $subCatData = [];
        $SubCategory = SubCategory::all();
        foreach ($SubCategory as $key => $value) {
            // get products
            $productCount = Product::where('sub_category_id', $value->sub_category_id)
                ->where('status', 'active')
                ->count();

            if ($productCount > 0) {
                $firstProduct = Product::where('sub_category_id', $value->sub_category_id)
                    ->where('status', 'active')
                    ->get(['product_id', 'product_name', 'image_URL'])
                    ->first();

                // create single subcat array
                $subCatData[] = [
                    'sub_category_id' => $value->sub_category_id,
                    'sub_category_name' => $value->sub_category_name,
                    'count' => $productCount,
                    'product' => $firstProduct,
                ];
            }
        }

        return response(json_encode($subCatData));
    }

    public function tradyProducts(Request $request)
    {
        $productCount = Product::where('status', 'active')
            ->orderBy('views', 'desc')
            ->limit(8)
            ->get();

        return response(json_encode($productCount));
    }

    public function latestProducts(Request $request)
    {
        $productCount = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return response(json_encode($productCount));
    }
}
