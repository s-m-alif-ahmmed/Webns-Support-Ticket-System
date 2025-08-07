<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\Module;
use App\Models\Admin\Ticket\SubModule;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubModuleController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_manage']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_manage'] == 'sub_module_manage'){
                $modules = Module::where('status', 'Published')->get();
                return view('admin.ticket.sub-module.manage',[
                    'sub_modules' => SubModule::all(),
                    'modules' => $modules,
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
                'module_id' => 'required|max:255',
                'name' => 'required|max:255',
                'sub_module_code' => 'required|max:255',
            ]);
            SubModule::createSubModule($request);
            return redirect('/admin/sub-modules')->with('message', 'Sub Module saved successfully.');
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
            if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_detail']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_detail'] == 'sub_module_detail'){
                $decryptID = Crypt::decryptString($id);
                $sub_module = SubModule::find($decryptID);
                $modules = Module::where('status', 'Published')->get();

                if ($sub_module) {
                    return view('admin.ticket.sub-module.detail', [
                        'sub_module' => $sub_module,
                        'modules' => $modules,
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
                'module_id' => 'required|max:255',
                'name' => 'required|max:255',
                'sub_module_code' => 'required|max:255',
            ]);
            SubModule::updateSubModule($request, $decryptID);
            return back()->with('message','Sub Module update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeSubModuleStatus($id)
    {
        try {
            $sub_module = SubModule::select('status')->where('id',$id)->first();
            if($sub_module->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($sub_module->status == 'Draft')
            {
                $status = 'Published';
            }
            SubModule::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected sub module status changed successfully.');
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
            SubModule::deleteSubModule($id);
            return redirect('/admin/sub-modules')->with('message','Sub Module delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
