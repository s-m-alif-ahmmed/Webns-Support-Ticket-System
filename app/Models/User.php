<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Ticket\Message;
use App\Models\Admin\Ticket\TicketAssign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }


    private static $user, $users;

    public static function createUser($request)
    {
        try {
            self::$user = new User();
            self::saveBasicInfo(self::$user, $request);
            self::$user->save();
            return self::$user;
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    public static function updateUser($request, $id)
    {
        try {
            self::$user = User::find($id);
            self::saveBasicInfo(self::$user, $request);
            self::$user->save();
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    private static function saveBasicInfo($user, $request)
    {
        self::$user->user_id                = $request->user_id;
        self::$user->employee_id            = $request->employee_id;
        self::$user->department             = $request->department;
        self::$user->designation            = $request->designation;
        self::$user->name                   = $request->name;
        self::$user->email                  = $request->email;
        self::$user->number                 = $request->number;
        self::$user->role                   = $request->role;
        self::$user->gender                 = $request->gender;
//        self::$user->password               = $request->password;
        if ($request->filled('password')) {
            self::$user->password = $request->password;
        }
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
    public function ticket_assigns()
    {
        return $this->belongsToMany(TicketAssign::class);
    }

}
