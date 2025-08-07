<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Message extends Model
{
    use HasFactory;

    private static $message, $messages;
    private static $image, $directory, $imageName, $imageUrl;

    protected $fillable = [
        'attachment',
        'ticket_id ',
        'create_user_id ',
        'update_user_id ',
        'update_company_user_id ',
        'message ',
    ];

    public static function uploadImage($request)
    {
        try {
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {

                self::$image = $request->file('attachment');
                self::$imageName = rand(100, 900000).self::$image->getClientOriginalName();
                self::$directory = "admin/images/ticket-messages/attachments/";
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

    public static function createMessage($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$message       = new Message();
            self::saveBasicInfo(self::$message, $request, self::$imageUrl);
            self::$message->save();
            return self::$message;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateMessage($request, $id)
    {
        try {
            self::$message = Message::find($id);
            if($request->file('attachment'))
            {
                if(file_exists(self::$message->attachment)){
                    unlink(self::$message->attachment);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$message->attachment;
            }
            self::saveBasicInfo(self::$message, $request, self::$imageUrl);
            self::$message->save();
            return self::$message;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteMessage($id)
    {
        try {
            self::$message = Message::find($id);
            if (file_exists(self::$message->attachment))
            {
                unlink(self::$message->attachment);
            }
            self::$message->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($message, $request, $imageUrl)
    {
        self::$message->attachment              = $imageUrl;
        self::$message->ticket_id               = $request->has('ticket_id') ? $request->ticket_id : null;
        self::$message->create_user_id          = $request->has('create_user_id') ? $request->create_user_id : null;
        self::$message->update_user_id          = $request->has('update_user_id') ? $request->update_user_id : null;
        self::$message->company_user_id         = $request->has('company_user_id') ? $request->company_user_id : null;
        self::$message->message                 = $request->message;
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
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
}
