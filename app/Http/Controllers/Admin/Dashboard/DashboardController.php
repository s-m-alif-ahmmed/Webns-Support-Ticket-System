<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        try {
            $role = Auth::user()->role;
            $user_name = Auth::user()->name;
            $notifications = auth()->user()->notifications;

            $allowedRoles = ['Super Admin', 'Admin', 'Viewer', 'Editor'];

            if (in_array($role, $allowedRoles)) {
                $users = User::all();
                $company_users = CompanyUser::all();
                $tickets = Ticket::all();

                return view('admin.dashboard.dashboard',[
                    'tickets' => $tickets,
                ], compact('user_name', 'users', 'company_users', 'notifications'));
            } else {
                return view('auth.login');
            }
        } catch (DecryptException $e) {
            return view('auth.login');
        }
    }


    public function companyDashboard()
    {
        $company_user_id = Session('company_user_id');

        // Retrieve the company user object from the database
        $company_admin = CompanyUser::find($company_user_id);

        if ($company_admin) {
            $role = $company_admin->role;
            $user_name = $company_admin->name;

            $allowedRoles = ['Employee', 'Admin'];

            if (in_array($role, $allowedRoles)) {
                $company_users = CompanyUser::all();
                $tickets = Ticket::where('sub_company_id', $company_admin->sub_company_id)->latest()->get();

                return view('company.dashboard.dashboard',[
                    'tickets' => $tickets,
                ], compact('user_name', 'company_users','company_admin'));
            } else {
                return view('company.auth.login');
            }
        } else {
            // Handle the case where the company user is not found
            return view('company.auth.login')->withErrors(['User not found']);
        }
    }


}
