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
        if (!$request->user()->is_admin) {
            abort(403);
        }

        $query = Customer::query();

        if ($userId = $request->input('user_id')) {
            $query->where('user_id', $userId);
        }

        // Filter by customers' status (active or trashed)
        if ($request->has('customer_status')) {
            if ($request->input('customer_status') === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->input('customer_status') === 'trashed') {
                $query->onlyTrashed();
            }
        }

        $customers = $query->latest()->paginate(10);

        return view('admin.index', [
            'users' => User::all(),
            'customers' => $customers,
        ]);
    }

    public function restore($id)
    {
        $restoreCustomer = Customer::withTrashed()->findOrFail($id);
        $restoreCustomer->restore();

        return redirect()->route('admin.index');
    }
}