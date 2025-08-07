<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Industry;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class IndustryController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_manage']) && $permissionData['company_everything_all']['industry_all']['industry_manage'] == 'industry_manage'){
                return view('admin.company.industry.manage',[
                    'industries' => Industry::all(),
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
                'name' => 'required|unique:industries|max:255',
            ]);

            Industry::createIndustry($request);
            return redirect('/admin/industries')->with('message', 'Industry saved successfully.');
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
            if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_detail']) && $permissionData['company_everything_all']['industry_all']['industry_detail'] == 'industry_detail'){
                $decryptID = Crypt::decryptString($id);
                $industry = Industry::find($decryptID);

                if ($industry) {
                    return view('admin.company.industry.detail', [
                        'industry' => $industry,
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
                'name' => ['required',
                    Rule::unique('industries')->ignore($decryptID),
                ],
            ]);
            Industry::updateIndustry($request, $decryptID);
            return back()->with('message','Industry update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeIndustryStatus($id)
    {
        try {
            $industry = Industry::select('status')->where('id',$id)->first();
            if($industry->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($industry->status == 'Draft')
            {
                $status = 'Published';
            }
            Industry::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected industry status changed successfully.');
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
            Industry::deleteIndustry($id);
            return redirect('/admin/industries')->with('message','Industry delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
