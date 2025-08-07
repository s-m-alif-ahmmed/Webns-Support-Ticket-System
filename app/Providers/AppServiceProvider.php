<?php

namespace App\Providers;

use App\Models\Admin\Company\Company;
use App\Models\Admin\Ticket\Module;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAssign;
use App\Models\Admin\Ticket\TicketNature;
use App\Models\Admin\User\CompanyUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $permissionData = json_decode(Auth::user()->permission, true);
                $view->with('permissionData', $permissionData);
            }
        });
        View::composer('*', function ($view) {
            $company_user_id = Session('company_user_id');

            // Retrieve the company user object from the database
            $company_admin = CompanyUser::find($company_user_id);
            if ($company_admin) {
                $companyPermissionData = json_decode($company_admin->permission, true);
                $view->with('companyPermissionData', $companyPermissionData);
            }
        });


        // Run only if tables exist
        if (
            Schema::hasTable('companies') &&
            Schema::hasTable('modules') &&
            Schema::hasTable('ticket_natures') &&
            Schema::hasTable('tickets') &&
            Schema::hasTable('ticket_assigns')
        ) {
            // Global Shared Data
            View::share('companies', Company::where('status', 'Published')->get());
            View::share('modules', Module::where('status', 'Published')->get());
            View::share('ticket_natures', TicketNature::where('status', 'Published')->get());

            $all_tickets = Ticket::all();
            View::share('total_tickets', $all_tickets->count());
            View::share('total_open_tickets', Ticket::where('status', 'Open')->count());
            View::share('total_closed_tickets', Ticket::where('status', 'Closed')->count());
            View::share('total_ticket_assigns', TicketAssign::count());
        }

        //  Notifications
//        $notifications = auth()->user()->notifications;
//        View::share('notifications', $notifications);

    }
}
