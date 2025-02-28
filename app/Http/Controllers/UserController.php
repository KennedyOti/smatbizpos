<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portal.users.users');
    }

    /**
     * Get all users data
     */
    public function users_data()
    {
        $Users = User::all();
        return DataTables::Of($Users)
            ->addColumn('action', function ($row) {
                return '
                    <div class="text-nowrap text-end">
                        <a href="/users/user_management/' . $row->id . '" class="btn btn-outline-primary btn-sm w-100"><i class="fas fa-briefcase"></i> Manage</a>
                    </div>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function user_management(string $id)
    {
        return view('portal.users.user_management', [
            'user_info' => User::where('id', $id)->first(),
            'user_categories' => ['admin', 'employee', 'customer']
        ]);
    }

    public function user_update(Request $request)
    {
        try {
            $User = User::findOrFail($request->update_id);
            $User->name = $request->input('name');
            $User->phone = $request->input('phone');
            $User->category = $request->input('category');
            $User->save();
            // Redirect or return a response as needed
            return redirect('/users/user_management/' . $request->update_id)->with('success', 'User information updated successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect('/users/user_management/' . $request->update_id)->with('error', 'Specified code was not found.');
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
