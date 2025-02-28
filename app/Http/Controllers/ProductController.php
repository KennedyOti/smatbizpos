<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('portal.product.product', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Get resource data
     */
    public function data()
    {
        $Product = Product::all();
        return DataTables::Of($Product)
            ->addColumn('image_URL', function ($row) {
                return '<img src="/assets/images/products/' . $row->image_URL . '" alt="" style="max-width: 30px; max-height: 30px">';
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="text-nowrap">
                        <a href="/product/manage/' . $row->product_id . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i> View | Manage</a>
                    </div>
                    ';
            })
            ->rawColumns(['image_URL', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('portal.product.add_product', [
            'user' => $request->user(),
        ]);
    }

    public function getCategorySubCategories(Request $request)
    {
        try {
            $SubCategory = SubCategory::where(['category_id' => $request->category_id])->get();
            return response(json_encode($SubCategory));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), []);
            if ($validator) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('assets/images/products'), $imageName);

                $product_id = time();

                Product::create(
                    [
                        'product_id' => $product_id,
                        'category_id' => $request->category_id,
                        'sub_category_id' => $request->sub_category_id,
                        'product_name' => strip_tags($request->product_name),
                        'description' => $request->description,
                        'SKU' => $request->SKU,
                        'supplier' => $request->supplier,
                        'buying_price' => $request->buying_price,
                        'marked_price' => $request->marked_price,
                        'stock_quantity' => $request->stock_quantity,
                        'remaining_stock' => $request->stock_quantity,
                        'image_URL' => $imageName,
                        'created_by' => Auth::user()->id,
                    ]
                );
                return redirect('/product/add_product/')->with('success', 'product added successfully');
            } else {
                Session::flash('error', 'some field are missing');
                return [
                    'code' => -1,
                    'msg' => $validator->errors(),
                ];
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $routeName = $request->route()->getName();
        $var = explode('.', $routeName);
        if (in_array('product_details', $var)) {
            return view('view-product', [
                'product' => Product::where("product_id", $request->product_id)->first(),
            ]);
        } else {
            return view('portal.product.manage', [
                'product' => Product::where("product_id", $request->product_id)->first(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), []);
            if ($validator) {
                $Product = Product::findOrFail($request->ed_product_id);

                if (isset($request->image)) {
                    $request->validate([
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/images/products'), $imageName);
                } else {
                    $imageName = $Product->image_URL;
                }

                $Product->product_name = $request->input('ed_product_name');
                $Product->category_id = $request->input('ed_category_id');
                $Product->sub_category_id = $request->input('ed_sub_category_id');
                $Product->supplier = $request->input('ed_supplier');
                $Product->status = $request->input('ed_status');
                $Product->image_URL = $imageName;
                $Product->SKU = $request->input('ed_SKU');
                $Product->stock_quantity = $request->input('ed_stock_quantity');
                $Product->buying_price = $request->input('ed_buying_price');
                $Product->marked_price = $request->input('ed_marked_price');
                $Product->description = $request->input('ed_description');
                $Product->save();

                return redirect('/product/manage/' . $request->ed_product_id)->with('success', 'product updated successfully');
            } else {
                Session::flash('error', 'some field are missing');
                return [
                    'code' => -1,
                    'msg' => $validator->errors(),
                ];
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $product = Product::findOrFail($request->del_product_id);
            $product->delete();
            return redirect('/product')->with('success', 'product deleted successfully');
        } catch (\Throwable $th) {
            return redirect('/product')->with('error', 'error deleting the product');
        }
    }
}
