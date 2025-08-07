<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\Ticket\Message;
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
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_manage']) && $permissionData['tickets_all']['messages_all']['message_manage'] == 'message_manage'){
                return view('admin.ticket.message.manage',[
                    'messages' => Message::all(),
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
            $companies = Company::where('status', 'Published')->latest()->get();
            $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
            $locations = Location::where('status', 'Published')->latest()->get();
            $modules = Module::where('status', 'Published')->latest()->get();
            $sub_modules = SubModule::where('status', 'Published')->latest()->get();
            $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
            return view('admin.ticket.ticket.index',[
                'companies' => $companies,
                'sub_companies' => $sub_companies,
                'locations' => $locations,
                'modules' => $modules,
                'sub_modules' => $sub_modules,
                'ticket_natures' => $ticket_natures,
            ]);

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
            // Assuming createMessage method returns the newly created message
            $message = Message::createMessage($request);

            // Determine which photo to use based on the presence of company_user_id or create_user_id
            $photo = null;
            $attachment = null;

            if ($message->company_user_id) {
                $photo = asset($message->createdByCompany->photo);
                $designation = $message->createdByCompany->designation->name;
                $name = $message->createdByCompany->name;
            } elseif ($message->create_user_id) {
                $photo = asset($message->createdBy->photo);
                $designation = $message->createdBy->designation;
                $name = $message->createdBy->name;
            }
            if ($message->attachment) {
                $attachment = asset($message->attachment);
            }

            return response()->json([
                'success' => true,
                'message' => $message->message,
                'attachment' => $attachment,
                'created_at' => $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia'),
                'photo' => $photo,
                'designation' => $designation,
                'name' => $name,
                'is_company_user' => $message->company_user_id ? true : false, // Identify if the message is from a company user
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send message.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_detail']) && $permissionData['company_users_all']['company_all_user']['company_user_detail'] == 'company_user_detail'){
                $decryptID = Crypt::decryptString($id);
                $message = Message::find($decryptID);
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $modules = Module::where('status', 'Published')->latest()->get();
                $sub_modules = SubModule::where('status', 'Published')->latest()->get();
                $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
                $tickets = Ticket::where('status', 'Published')->latest()->get();
                $users = User::all();

                if ($message) {
                    return view('admin.ticket.message.detail', [
                        'message' => $message,
                        'companies' => $companies,
                        'sub_companies' => $sub_companies,
                        'locations' => $locations,
                        'modules' => $modules,
                        'sub_modules' => $sub_modules,
                        'ticket_natures' => $ticket_natures,
                        'tickets' => $tickets,
                        'users' => $users,
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
            Message::updateMessage($request, $decryptID);
            return back()->with('message','Message update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeTicketMessageStatus($id)
    {
        try {
            $message = Message::select('status')->where('id',$id)->first();
            if($message->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($message->status == 'Draft')
            {
                $status = 'Published';
            }
            Message::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected message status changed successfully.');
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
            Message::deleteMessage($id);
            return redirect('/admin/ticket-messages')->with('message','Message delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


//    Company User

    /**
     * Show the form for creating a new resource.
     */
    public function createCompany()
    {
        try {
            $companies = Company::where('status', 'Published')->latest()->get();
            $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
            $locations = Location::where('status', 'Published')->latest()->get();
            $modules = Module::where('status', 'Published')->latest()->get();
            $sub_modules = SubModule::where('status', 'Published')->latest()->get();
            $ticket_natures = TicketNature::where('status', 'Published')->latest()->get();
            return view('company.company-user.ticket.detail',[
                'companies' => $companies,
                'sub_companies' => $sub_companies,
                'locations' => $locations,
                'modules' => $modules,
                'sub_modules' => $sub_modules,
                'ticket_natures' => $ticket_natures,
            ]);

        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    public function storeCompany(Request $request)
    {
        try {
            // Assuming createMessage method returns the newly created message
            $message = Message::createMessage($request);

            // Determine which photo to use based on the presence of company_user_id or create_user_id
            $photo = null;
            $attachment = null;

            if ($message->company_user_id) {
                $photo = asset($message->createdByCompany->photo);
                $designation = $message->createdByCompany->designation->name;
                $name = $message->createdByCompany->name;
            } elseif ($message->create_user_id) {
                $photo = asset($message->createdBy->photo);
                $designation = $message->createdBy->designation;
                $name = $message->createdBy->name;
            }

            if ($message->attachment) {
                $attachment = asset($message->attachment);
            }

            return response()->json([
                'success' => true,
                'message' => $message->message,
                'attachment' => $attachment,
                'created_at' => $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia'),
                'photo' => $photo,
                'designation' => $designation,
                'name' => $name,
                'is_company_user' => $message->create_user_id ? true : false, // Identify if the message is from a company user
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send message.']);
        }
    }


}
