<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::all();
        $query = Customer::query();

        if ($request->has('customer_status')) {
            if ($request->input('customer_status') === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->input('customer_status') === 'trashed') {
                $query->onlyTrashed()->get();
            }

            $customers = $query->latest()->paginate(10);
        } else {
            $customers = collect();
        }

        return view('admin.index', [
            'users' => $users,
            'customers' => $customers
        ]);
    }

    public function restore($id)
    {
        $restoreCustomer = Customer::withTrashed()->findOrFail($id);
        $restoreCustomer->restore();

        return view('admin.restore', [
            'restoreCustomer' => $restoreCustomer
        ]);
    }
}