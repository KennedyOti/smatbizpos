<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->category == 'employee') {
            return redirect()->route('pos.sales');
        }

        if (Auth::user()->category == 'customer') {
            return view('portal.dashboard.' . Auth::user()->category . '_dashboard', []);
        }

        if (Auth::user()->category == 'admin') {
            $sales = Sale::all();
            $totalBilled = 0;
            $totalSales = 0;
            $totalPaid = 0;

            foreach ($sales as $key => $value) {
                $totalBilled += $value->sale_buying_price;
                $totalSales += $value->sale_amount;
                $totalPaid += $value->amount_paid;
            }

            return view('portal.dashboard.' . Auth::user()->category . '_dashboard', [
                'users' => User::all(),
                'products' => Product::all(),
                'categories' => Categories::all(),
                'totalBilled' => $totalBilled,
                'totalSales' => $totalSales,
                'totalPaid' => $totalPaid,
            ]);
        }
    }
}
