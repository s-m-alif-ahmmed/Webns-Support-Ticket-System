<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Industry;
use App\Models\Admin\Company\SubCompany;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubCompanyController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_manage']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_manage'] == 'sub_company_manage'){
                $industries = Industry::where('status', 'Published')->latest()->get();
                $companies = Company::where('status', 'Published')->latest()->get();
                return view('admin.company.sub-company.manage',[
                    'sub_companies' => SubCompany::all(),
                    'industries' => $industries,
                    'companies' => $companies,
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
                'company_id' => 'required',
                'name' => 'required|max:255',
                'sister_concern' => 'required',
                'branch' => 'required',
            ]);

            SubCompany::createSubCompany($request);
            return redirect('/admin/sub_companies')->with('message', 'Sub Company saved successfully.');
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
            if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_detail']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_detail'] == 'sub_company_detail'){
                $decryptID = Crypt::decryptString($id);
                $sub_company = SubCompany::find($decryptID);
                $industries = Industry::where('status', 'Published')->latest()->get();
                $companies = Company::where('status', 'Published')->latest()->get();

                if ($sub_company) {
                    return view('admin.company.sub-company.detail', [
                        'sub_company' => $sub_company,
                        'industries' => $industries,
                        'companies' => $companies,
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
                'company_id' => 'required',
                'name' => 'required|max:255',
                'sister_concern' => 'required',
                'branch' => 'required',
            ]);
            SubCompany::updateSubCompany($request, $decryptID);
            return back()->with('message','Sub Company update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeSubCompanyStatus($id)
    {
        try {
            $sub_company = SubCompany::select('status')->where('id',$id)->first();
            if($sub_company->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($sub_company->status == 'Draft')
            {
                $status = 'Published';
            }
            SubCompany::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected sub company status changed successfully.');
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
            SubCompany::deleteSubCompany($id);
            return redirect('/admin/sub_companies')->with('message','Sub Company delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

//    public function getCompaniesByIndustry(Request $request)
//    {
//        $industryId = $request->input('industry_id');
//        $companies = Company::where('status', 'Published')
//                            ->where('industry_id', $industryId)->latest()->get();
//
//        return response()->json($companies);
//    }

}
