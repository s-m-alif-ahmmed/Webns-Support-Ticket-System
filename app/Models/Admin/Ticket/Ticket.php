<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;
    use Notifiable;

    private static $ticket, $tickets;
    private static $image, $directory, $imageName, $imageUrl;

    protected $fillable = [
        'subject',
        'description',
        'attachment',
        'priority',
        'operation_end_time',
        'end_time',
        'ticket_code ',
        'sub_module_id ',
        'create_user_id ',
        'update_user_id ',
        'update_company_user_id ',
        'company_user_id ',
    ];

    public static function uploadImage($request)
    {
        try {
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                self::$image = $request->file('attachment');
                self::$imageName = rand(10000, 200000).self::$image->getClientOriginalName();
                self::$directory = "admin/images/tickets/attachments/";
                self::$image->move(self::$directory, self::$imageName);
                self::$imageUrl = self::$directory.self::$imageName;
                self::$imageUrl = self::$directory.self::$imageName;
                return self::$imageUrl;
            } else {
                self::$imageUrl = null;
                return self::$imageUrl;
            }
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createTicket($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$ticket       = new Ticket();
            self::saveBasicInfo(self::$ticket, $request, self::$imageUrl);
            self::$ticket->save();
            return self::$ticket;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateTicket($request, $id)
    {
        try {
            self::$ticket = Ticket::find($id);
            if($request->file('attachment'))
            {
                if(file_exists(self::$ticket->attachment)){
                    unlink(self::$ticket->attachment);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$ticket->attachment;
            }
            self::saveBasicInfo(self::$ticket, $request, self::$imageUrl);
            self::$ticket->save();
            return self::$ticket;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($ticket){
            $ticket->ticket_slug = Str::slug($ticket->subject . '-' . rand(10000, 200000));
            // Generate the ticket_code as the next sequential number
            // Find the last ticket code and increment it by 1
            $lastTicket = self::orderBy('ticket_code', 'desc')->first();
            $ticket->ticket_code = $lastTicket ? $lastTicket->ticket_code + 1 : 1;
        });
        self::updating(function($ticket){
            $ticket->ticket_slug = Str::slug($ticket->subject . '-' . rand(10000, 200000));
        });
    }

    public static function deleteTicket($id)
    {
        try {
            self::$ticket = Ticket::find($id);
            if (file_exists(self::$ticket->attachment))
            {
                unlink(self::$ticket->attachment);
            }
            self::$ticket->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($ticket, $request, $imageUrl)
    {
        self::$ticket->attachment              = $imageUrl ?: null; // Handle image upload
        self::$ticket->create_user_id          = $request->has('create_user_id') ? $request->create_user_id : null;
        self::$ticket->update_user_id          = $request->has('update_user_id') ? $request->update_user_id : null;
        self::$ticket->company_user_id         = $request->has('company_user_id') ? $request->company_user_id : null;
        self::$ticket->update_company_user_id  = $request->has('update_company_user_id') ? $request->update_company_user_id : null;
        self::$ticket->company_id              = $request->has('company_id') ? $request->company_id : null;
        self::$ticket->sub_company_id          = $request->has('sub_company_id') ? $request->sub_company_id : null;
        self::$ticket->location_id             = $request->has('location_id') ? $request->location_id : null;
        self::$ticket->module_id               = $request->has('module_id') ? $request->module_id : null;
        self::$ticket->sub_module_id           = $request->has('sub_module_id') ? $request->sub_module_id : null;
        self::$ticket->ticket_nature_id        = $request->has('ticket_nature_id') ? $request->ticket_nature_id : null;
        self::$ticket->subject                 = $request->has('subject') ? $request->subject : null;
        self::$ticket->description             = $request->has('description') ? $request->description : null;
        self::$ticket->priority                = $request->has('priority') ? $request->priority : null;
        self::$ticket->operation_end_time      = $request->has('operation_end_time') ? $request->operation_end_time : null;
        self::$ticket->end_time                = $request->has('end_time') ? $request->end_time : null;

    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function subCompany()
    {
        return $this->belongsTo(SubCompany::class, 'sub_company_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function subModule()
    {
        return $this->belongsTo(SubModule::class, 'sub_module_id');
    }

    public function ticket_nature()
    {
        return $this->belongsTo(TicketNature::class, 'ticket_nature_id');
    }

    public function companyTicketAssigns()
    {
        return $this->hasMany(CompanyTicketAssign::class, 'ticket_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

    public function createdByCompany()
    {
        return $this->belongsTo(CompanyUser::class, 'company_user_id');
    }

    public function updatedByCompany()
    {
        return $this->belongsTo(CompanyUser::class, 'company_update_user_id');
    }

}
