<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\Ticket\CompanyTicketAssign;
use App\Models\Admin\Ticket\Message;
use App\Models\Admin\Ticket\Module;
use App\Models\Admin\Ticket\SubModule;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAssign;
use App\Models\Admin\Ticket\TicketNature;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Notifications\TicketStatusNotification;
use App\Notifications\TicketStatusChangeNotification;

class TicketController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_manage']) && $permissionData['tickets_all']['tickets']['ticket_manage'] == 'ticket_manage'){
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $modules = Module::where('status', 'Published')->latest()->get();
                $sub_modules = SubModule::where('status', 'Published')->latest()->get();
                $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
                return view('admin.ticket.ticket.manage',[
                    'tickets' => Ticket::all(),
                    'companies' => $companies,
                    'sub_companies' => $sub_companies,
                    'locations' => $locations,
                    'modules' => $modules,
                    'sub_modules' => $sub_modules,
                    'ticket_natures' => $ticket_natures,
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $ticket = Ticket::createTicket($request);
            // Notify the user of ticket creation
            $ticket->createdBy->notify(new TicketStatusNotification($ticket, 'Open'));
            return back()->with('message', 'Ticket create successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_detail']) && $permissionData['tickets_all']['tickets']['ticket_detail'] == 'ticket_detail'){
                $decryptID = Crypt::decryptString($id);
                $ticket = Ticket::find($decryptID);
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $modules = Module::where('status', 'Published')->latest()->get();
                $sub_modules = SubModule::where('status', 'Published')->latest()->get();
                $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
                $ticket_assigns = TicketAssign::where('ticket_id', $ticket->id)->where('status', 'On')->latest()->get();
                $company_ticket_assigns = CompanyTicketAssign::where('ticket_id', $ticket->id)->where('status', 'On')->latest()->get();
                $messages = Message::where('ticket_id', $ticket->id)->where('status', 'Published')->get();
                $users = User::all();
                $company_users = CompanyUser::all();

//                if ($ticket->status == 'Published') {
                    return view('admin.ticket.ticket.detail', [
                        'ticket' => $ticket,
                        'companies' => $companies,
                        'sub_companies' => $sub_companies,
                        'locations' => $locations,
                        'modules' => $modules,
                        'sub_modules' => $sub_modules,
                        'ticket_natures' => $ticket_natures,
                        'ticket_assigns' => $ticket_assigns,
                        'company_ticket_assigns' => $company_ticket_assigns,
                        'messages' => $messages,
                        'users' => $users,
                        'company_users' => $company_users,
                    ]);
//                } else {
//                    return view('admin.error.error');
//                }
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            Ticket::updateTicket($request, $decryptID);
            return redirect('/admin/tickets')->with('message','Ticket update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
    /**
     * Change Status the specified resource.
     */

    public function changeTicketOperationStatus($id)
    {
        try {
            $ticket_operation_status = Ticket::select('operation_status')->where('id', $id)->first();

            // Determine the new assign_status and set the work_end_time if status is changing to 'Complete'
            if ($ticket_operation_status->operation_status == 'Open') {
                $operation_status = 'Closed';
                $operation_end_time = now(); // Current date and time
            } elseif ($ticket_operation_status->operation_status == 'Closed') {
                $operation_status = 'Open';
                $operation_end_time = null; // Optionally set to null or keep it unchanged if reverting status
            }

            // Update the record with the new status and work_end_time
            Ticket::where('id', $id)->update([
                'operation_status' => $operation_status,
                'operation_end_time' => $operation_end_time
            ]);

            return back()->with('message', 'Ticket closed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    public function changeTicketAdminStatus($id)
    {
        try {
            // Fetch the current ticket with all necessary data
            $ticket = Ticket::findOrFail($id);

            // Determine the new status and end_time
            if ($ticket->status == 'Open') {
                $newStatus = 'Closed';
                $end_time = now(); // Set current time for end_time
            } elseif ($ticket->status == 'Closed') {
                $newStatus = 'Open';
                $end_time = null; // Clear end_time
            } else {
                return back()->with('error', 'Invalid ticket status.');
            }

            // Assign the new values directly to the model instance
            $ticket->status = $newStatus;
            $ticket->end_time = $end_time;

            // Save the updated ticket
            $ticket->save();

            // Notify the ticket creator about the status change
//            if ($ticket->createdBy) {
                $ticket->createdBy->notify(new TicketStatusChangeNotification($ticket, $newStatus));
//            }

            return back()->with('message', 'Ticket status updated successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

//    public function changeTicketAdminStatus($id)
//    {
//        try {
//            $ticket = Ticket::select('status')->where('id', $id)->first();
//
//            // Determine the new assign_status and set the work_end_time if status is changing to 'Complete'
//            if ($ticket->status == 'Open') {
//                $newStatus = 'Closed';
//                $end_time = now(); // Current date and time
//
//                // Update the record with the new status and work_end_time
//                $ticket = Ticket::where('id', $id)->update([
//                    'status' => $newStatus,
//                    'end_time' => $end_time
//                ]);
//
//                // Notify the ticket creator about the status change
//                $ticket->createdBy->notify(new TicketStatusChangeNotification($ticket, $newStatus));
//
//                return back()->with('message', 'Ticket closed successfully.');
//            } elseif ($ticket->status == 'Closed') {
//                $newStatus = 'Open';
//                $end_time = null; // Optionally set to null or keep it unchanged if reverting status
//
//                // Update the record with the new status and work_end_time
//                $ticket = Ticket::where('id', $id)->update([
//                    'status' => $newStatus,
//                    'end_time' => $end_time
//                ]);
//
//                // Notify the ticket creator about the status change
//                $ticket->createdBy->notify(new TicketStatusChangeNotification($ticket, $newStatus));
//
//                return back()->with('message', 'Ticket Open successfully.');
//            }
//
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Ticket::deleteTicket($id);
            return redirect('/admin/tickets')->with('message','Ticket delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


//    Company User

    public function indexCompany()
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['manage_tickets']) && $companyPermissionData['company_users_tickets']['manage_tickets'] == 'manage_tickets'){

                if ($company_admin->role == 'Admin'){
                    $tickets = Ticket::where('sub_company_id', $company_admin->sub_company_id )->latest()->get();
                    if ($tickets)
                        return view('company.company-user.ticket.manage',[
                            'tickets' => $tickets,
                        ],compact('company_admin'));
                    else{
                        return view('company.error.error');
                    }
                } else{

                    $tickets = Ticket::where(function ($query) use ($company_user_id, $company_admin) {
                        $query->whereHas('companyTicketAssigns', function ($subQuery) use ($company_user_id) {
                            $subQuery->where('assign_user_id', $company_user_id);
                        })->orWhere('company_user_id', $company_admin->id);
                    })->where('sub_company_id', $company_admin->sub_company_id)
                        ->latest()->get();

                    return view('company.company-user.ticket.manage', [
                        'tickets' => $tickets,
                        'company_admin' => $company_admin,
                    ]);
                }

            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    public function ticketList()
    {
        try {
            $company_user_id = session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);

            if ($companyPermissionData && isset($companyPermissionData['company_users_tickets']['manage_tickets']) && $companyPermissionData['company_users_tickets']['manage_tickets'] == 'manage_tickets') {
                if ($company_admin->role == 'Admin'){
                    // Fetch tickets connected to the logged-in company user
                    $tickets = Ticket::whereHas('companyTicketAssigns', function ($query) use ($company_user_id) {
                        $query->where('company_user_id', $company_user_id);
                    })->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();

                    return view('company.company-user.ticket.ticket-list', [
                        'tickets' => $tickets,
                        'company_admin' => $company_admin,
                    ]);
                } else{
                    // Fetch tickets connected to the logged-in company user
                    $tickets = Ticket::whereHas('companyTicketAssigns', function ($query) use ($company_user_id) {
                        $query->where('assign_user_id', $company_user_id);
                    })->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();

                    return view('company.company-user.ticket.ticket-list', [
                        'tickets' => $tickets,
                        'company_admin' => $company_admin,
                    ]);
                }

            } else {
                return view('company.error.error');
            }
        } catch (\Exception $e) {
            return view('company.error.error');
        }
    }
    public function userCreatedTicket()
    {
        try {
            $company_user_id = session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if ($companyPermissionData && isset($companyPermissionData['company_users_tickets']['manage_tickets']) && $companyPermissionData['company_users_tickets']['manage_tickets'] == 'manage_tickets') {
                // Fetch tickets connected to the logged-in company user
                $tickets = Ticket::where('company_user_id', $company_admin->id)->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();

                return view('company.company-user.ticket.created-ticket', [
                    'tickets' => $tickets,
                    'company_admin' => $company_admin,
                ]);
            } else {
                return view('company.error.error');
            }
        } catch (\Exception $e) {
            return view('company.error.error');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createCompany()
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['ticket_create']) && $companyPermissionData['company_users_tickets']['ticket_create'] == 'ticket_create'){
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $modules = Module::where('status', 'Published')->latest()->get();
                $sub_modules = SubModule::where('status', 'Published')->latest()->get();
                $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
                return view('company.company-user.ticket.index',[
                    'companies' => $companies,
                    'sub_companies' => $sub_companies,
                    'locations' => $locations,
                    'modules' => $modules,
                    'sub_modules' => $sub_modules,
                    'ticket_natures' => $ticket_natures,
                ],compact('company_admin'));
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCompany(Request $request)
    {
        try {

            $request->validate([
                'create_user_id' => 'nullable|integer',
                'update_user_id' => 'nullable|integer',
                'company_user_id' => 'nullable|integer',
                'company_id'     => 'nullable|integer',
                'subject'        => 'required|string',
                'description'    => 'nullable|string',
                'priority'       => 'nullable|string',
                'operation_end_time' => 'nullable|date',
                'end_time'       => 'nullable|date',
            ]);

            Ticket::createTicket($request);
            return redirect()->route('user.index.ticket')->with('message', 'Ticket create successfully.');
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function showCompany(string $id)
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode( $company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['ticket_detail']) && $companyPermissionData['company_users_tickets']['ticket_detail'] == 'ticket_detail'){
                $decryptID = Crypt::decryptString($id);
                $ticket = Ticket::find($decryptID);
                $message = Message::query();
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $modules = Module::where('status', 'Published')->latest()->get();
                $sub_modules = SubModule::where('status', 'Published')->latest()->get();
                $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
                $ticket_assigns = TicketAssign::where('ticket_id', $ticket->id)->where('status', 'On')->latest()->get();
                $company_ticket_assigns = CompanyTicketAssign::where('ticket_id', $ticket->id)->where('status', 'On')->latest()->get();
                $messages = $message->where('ticket_id', $ticket->id)->where('status', 'Published')->get();
                $users = User::all();
                $company_users = CompanyUser::where('sub_company_id', $company_admin->sub_company_id)->latest()->get();

//                if ($ticket->status == 'Published') {
                    return view('company.company-user.ticket.detail', [
                        'ticket' => $ticket,
                        'companies' => $companies,
                        'sub_companies' => $sub_companies,
                        'locations' => $locations,
                        'modules' => $modules,
                        'sub_modules' => $sub_modules,
                        'ticket_natures' => $ticket_natures,
                        'ticket_assigns' => $ticket_assigns,
                        'company_ticket_assigns' => $company_ticket_assigns,
                        'messages' => $messages,
                        'users' => $users,
                        'company_users' => $company_users,
                    ],compact('company_admin'));
//                } else {
//                    return view('company.error.error');
//                }
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    public function changeTicketCreatorStatus($id)
    {
        try {
            $ticket_status = Ticket::select('status')->where('id', $id)->first();

            // Determine the new assign_status and set the work_end_time if status is changing to 'Complete'
            if ($ticket_status->status == 'Open') {
                $status = 'Closed';
                $end_time = now(); // Current date and time
            } elseif ($ticket_status->status == 'Closed') {
                $status = 'Open';
                $end_time = null; // Optionally set to null or keep it unchanged if reverting status
            }

            // Update the record with the new status and work_end_time
           $ticket = Ticket::where('id', $id)->update([
                'status' => $status,
                'end_time' => $end_time
            ]);

            // Notify the user when the ticket is closed
            if ($ticket->status == 'Closed') {
                $ticket->user->notify(new TicketStatusNotification($ticket, 'Closed'));
            }

            return back()->with('message', 'Ticket closed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

}
