<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItems;
use App\Models\SubCategory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function sales()
    {
        $firstDayOfMonth = new DateTime('first day of this month');
        $lastDayOfMonth = new DateTime('last day of this month');

        return view('portal.report.sales', [
            'startDate' => $firstDayOfMonth->format('m/d/Y'),
            'endDate' => $lastDayOfMonth->format('m/d/Y')
        ]);
    }

    public function sales_data(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate = date('Y-m-d', strtotime($request->endDate));

        $sales = Sale::whereRaw("(created_at >= ? AND created_at <= ?)", [
            Carbon::parse($startDate)->startOfDay(),  // 2023-04-15 00:00:00
            Carbon::parse($endDate)->endOfDay()       // 2023-04-15 23:59:59
        ])->get();

        return DataTables::Of($sales)
            ->addColumn('date', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->created_at));
            })
            ->addColumn('customer', function ($row) {
                return 'N/A';
            })
            ->addColumn('item_count', function ($row) {
                $count = SaleItems::where('sale_id', $row->sale_id)->count();
                return $count;
            })
            ->addColumn('sale_amount', function ($row) {
                return '<div class="text-end">' . number_format($row->sale_amount, 2) . '</div>';
            })
            ->addColumn('amount_paid', function ($row) {
                return '<div class="text-end">' . number_format($row->amount_paid, 2) . '</div>';
            })
            ->addColumn('balance', function ($row) {
                return '<div class="text-end">' . number_format(($row->sale_amount - $row->amount_paid), 2) . '</div>';
            })
            ->rawColumns(['sale_amount', 'amount_paid', 'balance'])
            ->make(true);
    }

    public function sales_arithmetics(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate = date('Y-m-d', strtotime($request->endDate));

        $sales = Sale::whereRaw("(created_at >= ? AND created_at <= ?)", [
            Carbon::parse($startDate)->startOfDay(),  // 2023-04-15 00:00:00
            Carbon::parse($endDate)->endOfDay()       // 2023-04-15 23:59:59
        ])->get();

        $totalprice = 0;
        $totalsales = 0;
        $totalpaid = 0;
        foreach ($sales as $key => $value) {
            $totalprice += $value->sale_buying_price;
            $totalsales += $value->sale_amount;
            $totalpaid += $value->amount_paid;
        }

        return response(json_encode([
            'price' => number_format($totalprice, 2),
            'sales' => number_format($totalsales, 2),
            'paid' => number_format($totalpaid, 2),
            'balance' => number_format(($totalsales - $totalpaid), 2),
            'profit' => number_format(($totalpaid - $totalprice), 2) // Income - Expenses
        ]));
    }

    public function sales_details(Request $request)
    {
        $firstDayOfMonth = new DateTime('first day of this month');
        $lastDayOfMonth = new DateTime('last day of this month');

        return view('portal.report.sales_details', [
            'sale_id' => $request->sale_id,
            'startDate' => $firstDayOfMonth->format('m/d/Y'),
            'endDate' => $lastDayOfMonth->format('m/d/Y')
        ]);
    }

    public function sales_details_data(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate = date('Y-m-d', strtotime($request->endDate));

        $salesItems = SaleItems::whereRaw("(created_at >= ? AND created_at <= ?)", [
            Carbon::parse($startDate)->startOfDay(),  // 2023-04-15 00:00:00
            Carbon::parse($endDate)->endOfDay()       // 2023-04-15 23:59:59
        ])
            ->where('sale_id', $request->sale_id)
            ->get();

        return DataTables::Of($salesItems)
            ->addColumn('date', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->created_at));
            })
            ->addColumn('product_buying_price', function ($row) {
                return '<div class="text-end">' . number_format($row->product_buying_price, 2) . '</div>';
            })
            ->addColumn('product_quantity', function ($row) {
                return '<div class="text-end">' . $row->product_quantity . '</div>';
            })
            ->addColumn('product_amount', function ($row) {
                return '<div class="text-end">' . number_format($row->product_amount, 2) . '</div>';
            })
            ->rawColumns(['product_buying_price', 'product_quantity', 'product_amount'])
            ->make();
    }

    public function sales_details_arithmetics(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate = date('Y-m-d', strtotime($request->endDate));

        $salesItems = SaleItems::whereRaw("(created_at >= ? AND created_at <= ?)", [
            Carbon::parse($startDate)->startOfDay(),  // 2023-04-15 00:00:00
            Carbon::parse($endDate)->endOfDay()       // 2023-04-15 23:59:59
        ])
            ->where('sale_id', $request->sale_id)
            ->get();

        $totalprice = 0;
        $totalsales = 0;
        foreach ($salesItems as $key => $value) {
            $totalprice += $value->product_buying_price;
            $totalsales += $value->product_amount;
        }

        return response(json_encode([
            'marked price' => number_format($totalprice, 2),
            'amount paid' => number_format($totalsales, 2),
            'profit/loss' => number_format($totalsales - $totalprice, 2)
        ]));
    }

    public function stock()
    {
        $category_list = [];
        $categories = Categories::all();

        foreach ($categories as $key => $value) {
            $catSubCat = [];
            $SubCategory = SubCategory::where('category_id', $value->category_id)->get();
            $productsCount = 0;
            foreach ($SubCategory as $subcatvalue) {
                $Product = Product::where('category_id', $value->category_id)
                    ->where('sub_category_id', $subcatvalue->sub_category_id)
                    ->get();

                $productsCount += count($Product);

                $catSubCat[] = [
                    'sub_rowspan' => count($Product) + 1,
                    'sub_category_name' => $subcatvalue->sub_category_name,
                    'products' => $Product,
                ];
            }

            $category_list[] = [
                'cat_rowspan' => count($SubCategory) + $productsCount + 1,
                'name' => $value->name,
                'sub_categories' => $catSubCat
            ];
        }

        return view('portal.report.stock', [
            'stock' => $category_list
        ]);
    }
}
