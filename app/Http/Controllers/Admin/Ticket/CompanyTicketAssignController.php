<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\CompanyTicketAssign;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAssign;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CompanyTicketAssignController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_manage']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_manage'] == 'company_user_assign_manage'){
                return view('admin.ticket.company-ticket-assign.manage',[
                    'company_ticket_assigns' => CompanyTicketAssign::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    public function store(Request $request)
    {
        try {
            $create_user_id = $request->create_user_id;
            $ticket_id = $request->ticket_id;
            $assign_user_ids = $request->assign_user_id;
            $work_roles = $request->work_role;

            foreach ($assign_user_ids as $index => $assign_user_id) {
                CompanyTicketAssign::create([
                    'create_user_id' => $create_user_id,
                    'ticket_id' => $ticket_id,
                    'assign_user_id' => $assign_user_id,
                    'work_role' => $work_roles[$index],
                ]);
            }

            return back()->with(['message' => 'Task Assigned.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating ticket assigning.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_detail']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_detail'] == 'company_user_assign_detail'){
                $decryptID = Crypt::decryptString($id);
                $company_ticket_assign = CompanyTicketAssign::find($decryptID);

                if ($company_ticket_assign) {
                    return view('admin.ticket.company-ticket-assign.detail', [
                        'company_ticket_assign' => $company_ticket_assign,
                    ]);
                } else {
                    return view('admin.error.error');
                }
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
            $company_ticket_assign = CompanyTicketAssign::findOrFail($id); // Retrieve the ticket assignment
            $company_ticket_assign->update($request->all()); // Update the ticket assignment
            // Return updated data
            return response()->json([
                'assignCompanyUser' => $company_ticket_assign->assignCompanyUser->name,
                'employeeId' => $company_ticket_assign->assignCompanyUser->employee_id,
                'workRole' => $company_ticket_assign->work_role,
                'deleteUrl' => route('ticket-company-assigns.destroy', $company_ticket_assign->id)
            ]);
        } catch (DecryptException $e) {
            return response()->json(['assign-message' => 'An error occurred.'], 500);
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeTicketCompanyAssignWorkStatus($id)
    {
        try {
            $company_ticket_assign_work = CompanyTicketAssign::select('assign_status')->where('id',$id)->first();
            if($company_ticket_assign_work->assign_status == 'Pending')
            {
                $assign_status = 'Complete';
            }
            elseif($company_ticket_assign_work->assign_status == 'Complete')
            {
                $assign_status = 'Pending';
            }
            CompanyTicketAssign::where('id',$id)->update(['assign_status' => $assign_status ]);
            return back()->with('message','Selected assigned work status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeTicketCompanyAssignStatus($id)
    {
        try {
            $company_ticket_assign = CompanyTicketAssign::select('status')->where('id',$id)->first();
            if($company_ticket_assign->status == 'On')
            {
                $status = 'Off';
            }
            elseif($company_ticket_assign->status == 'Off')
            {
                $status = 'On';
            }
            CompanyTicketAssign::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected assigned status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            CompanyTicketAssign::deleteCompanyTicketAssign($id);
            return back()->with('message','Assign Employee remove successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

//    Company User

    /**
     * Show the form for creating a new resource.
     */
    public function storeCompany(Request $request)
    {
        try {
            $company_user_id = $request->company_user_id;
            $ticket_id = $request->ticket_id;
            $assign_user_ids = $request->assign_user_id;
            $work_roles = $request->work_role;

            foreach ($assign_user_ids as $index => $assign_user_id) {
                CompanyTicketAssign::create([
                    'company_user_id' => $company_user_id,
                    'ticket_id' => $ticket_id,
                    'assign_user_id' => $assign_user_id,
                    'work_role' => $work_roles[$index],
                ]);
            }

            return back()->with(['message' => 'Task Assigned.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating ticket assigning.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCompany(Request $request, string $id)
    {
        try {
            $company_ticket_assign = CompanyTicketAssign::findOrFail($id); // Retrieve the ticket assignment
            $company_ticket_assign->update($request->all()); // Update the ticket assignment
            // Return updated data
            return response()->json([
                'assignCompanyUser' => $company_ticket_assign->assignCompanyUser->name,
                'employeeId' => $company_ticket_assign->assignCompanyUser->employee_id,
                'workRole' => $company_ticket_assign->work_role,
                'deleteUrl' => route('company.user.delete.assign', $company_ticket_assign->id)
            ]);
        } catch (DecryptException $e) {
            return response()->json(['assign-message' => 'An error occurred.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCompany(string $id)
    {
        try {
            CompanyTicketAssign::deleteCompanyTicketAssign($id);
            return back()->with('message','Assign Employee remove successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

}
