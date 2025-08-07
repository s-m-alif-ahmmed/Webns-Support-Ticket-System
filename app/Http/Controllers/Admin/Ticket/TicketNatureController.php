<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\TicketNature;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TicketNatureController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_manage']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_manage'] == 'ticket_nature_manage'){
                return view('admin.ticket.ticket-nature.manage',[
                    'ticket_natures' => TicketNature::all(),
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
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
            TicketNature::createTicketNature($request);
            return redirect('/admin/ticket-natures')->with('message', 'Ticket Nature saved successfully.');
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
            if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_detail']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_detail'] == 'ticket_nature_detail'){
                $decryptID = Crypt::decryptString($id);
                $ticket_nature = TicketNature::find($decryptID);

                if ($ticket_nature) {
                    return view('admin.ticket.ticket-nature.detail', [
                        'ticket_nature' => $ticket_nature,
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
            $decryptID = Crypt::decryptString($id);
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
            TicketNature::updateTicketNature($request, $decryptID);
            return back()->with('message','Ticket Nature update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeTicketNatureStatus($id)
    {
        try {
            $ticket_nature = TicketNature::select('status')->where('id',$id)->first();
            if($ticket_nature->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($ticket_nature->status == 'Draft')
            {
                $status = 'Published';
            }
            TicketNature::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected ticket nature status changed successfully.');
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
            TicketNature::deleteTicketNature($id);
            return redirect('/admin/ticket-natures')->with('message','Ticket Nature delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
