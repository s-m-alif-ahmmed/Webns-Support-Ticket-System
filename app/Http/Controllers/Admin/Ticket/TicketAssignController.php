<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\Ticket\Module;
use App\Models\Admin\Ticket\SubModule;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAssign;
use App\Models\Admin\Ticket\TicketNature;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TicketAssignController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_manage']) && $permissionData['tickets_all']['assign_all']['assign_manage'] == 'assign_manage'){
                return view('admin.ticket.ticket-assign.manage',[
                    'ticket_assigns' => TicketAssign::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['assign_all']['company_user_create']) && $permissionData['tickets_all']['assign_all']['company_user_create'] == 'company_user_create'){
                $tickets = Ticket::where('status', 'Published')->latest()->get();
                return view('admin.ticket.ticket.index',[
                    'tickets' => $tickets,
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
            $approx_end_times = $request->approx_end_time;

            foreach ($assign_user_ids as $index => $assign_user_id) {
                TicketAssign::create([
                    'create_user_id' => $create_user_id,
                    'ticket_id' => $ticket_id,
                    'assign_user_id' => $assign_user_id,
                    'work_role' => $work_roles[$index],
                    'approx_end_time' => $approx_end_times[$index],
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
            if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_detail']) && $permissionData['tickets_all']['assign_all']['assign_detail'] == 'assign_detail'){
                $decryptID = Crypt::decryptString($id);
                $ticket_assign = TicketAssign::find($decryptID);

                if ($ticket_assign) {
                    return view('admin.ticket.ticket-assign.detail', [
                        'ticket_assign' => $ticket_assign,
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
            $ticket_assign = TicketAssign::findOrFail($id); // Retrieve the ticket assignment
            $ticket_assign->update($request->all()); // Update the ticket assignment
            // Return updated data
            return response()->json([
                'assignUser' => $ticket_assign->assignUser->name,
                'employeeId' => $ticket_assign->assignUser->employee_id,
                'workRole' => $ticket_assign->work_role,
                'endTime' => $ticket_assign->updated_approx_end_time,
                'deleteUrl' => route('ticket-assigns.destroy', $ticket_assign->id)
            ]);
        } catch (DecryptException $e) {
            return response()->json(['assign-message' => 'An error occurred.'], 500);
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeTicketAssignWorkStatus($id)
    {
        try {
            $ticket_assign_work = TicketAssign::select('assign_status')->where('id', $id)->first();

            // Determine the new assign_status and set the work_end_time if status is changing to 'Complete'
            if ($ticket_assign_work->assign_status == 'Pending') {
                $assign_status = 'Complete';
                $work_end_time = now(); // Current date and time
            } elseif ($ticket_assign_work->assign_status == 'Complete') {
                $assign_status = 'Pending';
                $work_end_time = null; // Optionally set to null or keep it unchanged if reverting status
            }

            // Update the record with the new status and work_end_time
            TicketAssign::where('id', $id)->update([
                'assign_status' => $assign_status,
                'work_end_time' => $work_end_time
            ]);

            return back()->with('message', 'Ticket closed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


    /**
     * Change Status the specified resource.
     */
    public function changeTicketAssignStatus($id)
    {
        try {
            $ticket_assign = TicketAssign::select('status')->where('id',$id)->first();
            if($ticket_assign->status == 'On')
            {
                $status = 'Off';
            }
            elseif($ticket_assign->status == 'Off')
            {
                $status = 'On';
            }
            TicketAssign::where('id',$id)->update(['status' => $status ]);
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
            TicketAssign::deleteTicketAssign($id);
            return back()->with('message','Assign Employee remove successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
