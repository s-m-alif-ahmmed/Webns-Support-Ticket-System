<?php

namespace App\Http\Controllers\CompanyUser\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyAuthController extends Controller
{
    public function loginCheck(Request $request)
    {
        $this->company_user = CompanyUser::where('email', $request->login)->first();
        if ($this->company_user)
        {
            if ($request->password === $this->company_user->password)
            {
                Session::put('company_user_id', $this->company_user->id);
                Session::put('company_user_name', $this->company_user->name);
                return redirect('/company/dashboard');
            }
            return back()->with('message', 'Sorry ... Your password is not valid.');
        }

        $this->company_user = CompanyUser::where('employee_id', $request->login)->first();
        if ($this->company_user)
        {
            if ($request->password === $this->company_user->password)
            {
                Session::put('company_user_id', $this->company_user->id);
                Session::put('company_user_name', $this->company_user->name);
                return redirect('/company/dashboard');
            }
            return back()->with('message', 'Sorry ... Your password is not valid.');
        }

        return back()->with('message', 'Sorry ... Your email or employee id is not valid.');
    }

    public function logout()
    {
        Session::forget('company_user_id');
        Session::forget('company_user_name');

        return redirect('/');
    }

}
