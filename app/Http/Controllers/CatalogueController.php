<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('portal.catalogue.catalogue', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Get resource data
     */
    public function data()
    {
        $Categories = Categories::all();
        return DataTables::Of($Categories)
            ->addColumn('action', function ($row) {
                $buttons = '
                    <a href="/catalogue/manage/' . $row->category_id . '" class="btn btn-outline-secondary btn-sm"><i class="fas fa-briefcase"></i> Manage</a>
                    <button class="btn btn-outline-primary btn-sm" id="edit_category"><i class="fas fa-pen"></i> Edit</button>
                ';

                if (Auth::user()->category == 'admin') {
                    $buttons .= '<button class="btn btn-outline-danger btn-sm" id="delete_category" value="' . $row->category_id . '"><i class="fas fa-trash-alt"></i> Delete</button>';
                }

                return '<div class="text-nowrap">' . $buttons . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), []);
            if ($validator) {
                $category_id = STR_PAD(time(), 6, '0', STR_PAD_LEFT);
                Categories::create(
                    [
                        'name' => $request->name,
                        'category_id' => $category_id
                    ]
                );
                return redirect('/catalogue')->with('success', 'catalogue created successfully');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $Category = Categories::findOrFail($request->ed_category_id);
            $Category->name = $request->input('ed_category_name');
            $Category->save();
            // Redirect or return a response as needed
            return redirect('/catalogue')->with('success', 'category information successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect('/catalogue')->with('error', 'Specified code was not found.');
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Manage catalogue
     */
    public function manage(string $category_id)
    {
        return view('portal.catalogue.manage', [
            'manage_category' => Categories::where("category_id", $category_id)->first(),
        ]);
    }

    /**
     * Get subcategories data
     */
    public function getSubCategories(string $category_id)
    {
        $SubCategory = SubCategory::where("category_id", $category_id)->get();
        return DataTables::Of($SubCategory)
            ->addColumn('action', function ($row) {
                $buttons = '';
                // $buttons .= '<button class="btn btn-outline-primary btn-sm" id="edit_category"><i class="fas fa-pen"></i> Edit</button>';
                if (Auth::user()->category == 'admin') {
                    $buttons .= '<button class="btn btn-outline-danger btn-sm" id="delete_sub_category" value="' . $row->sub_category_id . '"><i class="fas fa-trash-alt"></i> Delete</button>';
                }

                return '<div class="text-nowrap">' . $buttons . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Add subcategory
     */
    public function addSubCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), []);
            if ($validator) {
                $sub_category_id = STR_PAD(time(), 6, '0', STR_PAD_LEFT);
                SubCategory::create(
                    [
                        'sub_category_id' => $sub_category_id,
                        'category_id' => $request->category_id,
                        'sub_category_name' => $request->sub_category_name
                    ]
                );
                return redirect('/catalogue/manage/' . $request->category_id)->with('success', 'sub category created successfully');
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
            // Delete products
            $productsDeleted = Product::where('category_id', $request->delete_category_id)->delete();
            // Delete subcategories
            $subCategoriesDeleted = SubCategory::where('category_id', $request->delete_category_id)->delete();
            // Delete category
            $categoryDeleted = Categories::where('category_id', $request->delete_category_id)->delete();

            if ($categoryDeleted) {
                if ($productsDeleted || $subCategoriesDeleted) {
                    $message = 'Category deleted successfully!';
                } else {
                    $message = 'Category deleted successfully, but no products or subcategories were found for deletion.';
                }
                return redirect('/catalogue')->with('success', $message);
            } else {
                return redirect('/catalogue')->with('error', 'Error deleting the category');
            }
        } catch (\Throwable $th) {
            return redirect('/catalogue')->with('error', 'Error deleting the category');
        }
    }

    public function destroy_sub_category(Request $request, string $category_id)
    {
        try {
            // Delete products
            $productsDeleted = Product::where('sub_category_id', $request->delete_sub_category_id)->delete();
            // Delete subcategories
            $subCategoriesDeleted = SubCategory::where('sub_category_id', $request->delete_sub_category_id)->delete();

            if ($subCategoriesDeleted) {
                if ($productsDeleted) {
                    $message = 'Sub category deleted successfully!';
                } else {
                    $message = 'Sub category deleted successfully, but no products were found for deletion.';
                }
                return redirect('/catalogue/manage/' . $category_id)->with('success', $message);
            } else {
                return redirect('/catalogue/manage/' . $category_id)->with('error', 'Error deleting the sub category');
            }
        } catch (\Throwable $th) {
            return redirect('/catalogue/manage/' . $category_id)->with('error', 'Error deleting the sub category');
        }
    }
}
