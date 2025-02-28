<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portal.pos.sales');
    }

    /**
     * Get resource data
     */
    public function sale_data()
    {
        $Sales = Sale::all();
        return DataTables::Of($Sales)
            ->addColumn('created_by', function ($row) {
                $user = User::where(['id' => $row->created_by])->first();
                return $user->name;
            })
            ->addColumn('created_at', function ($row) {
                return date('M d, Y', strtotime($row->created_at));
            })
            ->addColumn('action', function ($row) {
                $buttons = '
                    <a href="/pos/sale_receipt/' . $row->sale_id . '" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print"></i> Print</a>
                ';

                if (Auth::user()->category == 'admin') {
                    $buttons .= '<button class="btn btn-outline-danger btn-sm" value="' . $row->sale_id . '" id="del_sale"><i class="fas fa-trash-alt"></i> Delete</button>';
                }

                return '<div class="text-nowrap">' . $buttons . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portal.pos.make_sale', [
            'productsIDs' => Product::select('product_id')->get()
        ]);
    }

    /**
     * Search product.
     */
    public function search_product(Request $request)
    {
        try {
            $Product = Product::where('product_id', $request->product_id)
                ->orWhere('product_name', $request->product_id)
                ->firstOrFail();

            // $Product = Product::where('product_id', 'like', "%$request->product_id%")
            //     ->orWhere('product_name', 'like', "%$request->product_id%")
            //     ->firstOrFail();

            return response(json_encode($Product));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * store_sale a newly created resource in storage.
     */
    public function store_sale(Request $request)
    {
        if (isset($_COOKIE['cart'])) {

            $sale_key = Str::uuid();

            $ref_no = time();

            $saleData = json_decode($_COOKIE['cart']);

            $sale_amount = 0;
            $sale_buying_amount = 0;
            foreach ($saleData as $key => $value) {
                $sale_buying_amount += ($value->productBuyingPrice * $value->productQuantity);
                $sale_amount += ($value->productSellingPrice * $value->productQuantity);
            }

            $sale = Sale::create(
                [
                    'sale_id' => $sale_key,
                    'ref_no' => $ref_no,
                    'sale_buying_price' => $sale_buying_amount,
                    'sale_amount' => $sale_amount,
                    'payment_method' => $request->payment_method,
                    'amount_paid' => $request->amount_paid,
                    'created_by' => Auth::user()->id
                ]
            );

            if ($sale) {
                foreach ($saleData as $key => $value) {
                    $sale_item_key = Str::uuid();
                    SaleItems::create(
                        [
                            'sale_item_id' => $sale_item_key,
                            'sale_id' => $sale_key,
                            'product_id' => $value->productId,
                            'product_name' => $value->productName,
                            'product_quantity' => $value->productQuantity,
                            'product_buying_price' => $value->productBuyingPrice,
                            'product_amount' => $value->productSellingPrice
                        ]
                    );

                    // get product details
                    $product = Product::findOrFail($value->productId);
                    if ($product) {
                        $product->remaining_stock = ($product->remaining_stock - $value->productQuantity);
                        $product->save();
                    }
                }
            }

            return redirect('/pos/sale_receipt/' . $sale_key)->withCookie(Cookie::forget('cart'));
        }
    }

    public function sale_receipt(Request $request)
    {

        $receiptItems = [];
        $salesReceipt = Sale::where(['sale_id' => $request->receipt_id])->firstOrFail();

        if ($salesReceipt) {
            $receiptItems = SaleItems::where(['sale_id' => $request->receipt_id])->get();
        }

        return view('portal.pos.sale_receipt', [
            'receipt_info' => $salesReceipt,
            'receipt_items' => $receiptItems
        ]);
    }

    public function destroy(Request $request)
    {
        try {
            $sale = Sale::findOrFail($request->del_sale_id);
            if ($sale) {
                $saleItems = SaleItems::where('sale_id', $sale->sale_id)->get();
                foreach ($saleItems as $key => $value) {
                    $Product = Product::findOrFail($value->product_id);
                    $Product->remaining_stock = ($Product->remaining_stock + $value->product_quantity);
                    $Product->save();
                    $value->delete();
                }
                $sale->delete();
            }
            return redirect('/pos/sales')->with('success', 'sale record deleted successfully, you can now re-enter the sale record again!');
        } catch (\Throwable $th) {
            return redirect('/pos/sales')->with('error', 'error encountered deleting the sale record');
        }
    }
}
