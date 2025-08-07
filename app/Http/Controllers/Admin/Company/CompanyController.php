<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Industry;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_manage']) && $permissionData['company_everything_all']['company_all']['company_manage'] == 'company_manage'){
                $industries = Industry::where('status', 'Published')->latest()->get();
                return view('admin.company.company.manage',[
                    'companies' => Company::all(),
                    'industries' => $industries,
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
                'industry_id' => 'required',
                'name' => 'required|max:255',
                'image' => 'required',
            ]);

            Company::createCompany($request);
            return redirect('/admin/companies')->with('message', 'Company saved successfully.');
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
            if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_detail']) && $permissionData['company_everything_all']['company_all']['company_detail'] == 'company_detail'){
                $decryptID = Crypt::decryptString($id);
                $company = Company::find($decryptID);
                $industries = Industry::where('status', 'Published')->latest()->get();

                if ($company) {
                    return view('admin.company.company.detail', [
                        'company' => $company,
                        'industries' => $industries,
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
                'industry_id' => 'required',
                'name' => 'required|max:255',
            ]);
            Company::updateCompany($request, $decryptID);
            return back()->with('message','Company update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeCompanyStatus($id)
    {
        try {
            $company = Company::select('status')->where('id',$id)->first();
            if($company->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($company->status == 'Draft')
            {
                $status = 'Published';
            }
            Company::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected company status changed successfully.');
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
            Company::deleteCompany($id);
            return redirect('/admin/companies')->with('message','Company delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
