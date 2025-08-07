<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\Module;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ModuleController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_manage']) && $permissionData['ticket_helpers_all']['module_all']['module_manage'] == 'module_manage'){
                return view('admin.ticket.module.manage',[
                    'modules' => Module::all(),
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
                'module_code' => 'required|max:255',
                'name' => 'required|max:255',
            ]);
            Module::createModule($request);
            return redirect('/admin/modules')->with('message', 'Module saved successfully.');
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
            if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_detail']) && $permissionData['ticket_helpers_all']['module_all']['module_detail'] == 'module_detail'){
                $decryptID = Crypt::decryptString($id);
                $module = Module::find($decryptID);

                if ($module) {
                    return view('admin.ticket.module.detail', [
                        'module' => $module,
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
                'module_code' => 'required|max:255',
                'name' => 'required|max:255',
            ]);
            Module::updateModule($request, $decryptID);
            return back()->with('message','Module update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeModuleStatus($id)
    {
        try {
            $module = Module::select('status')->where('id',$id)->first();
            if($module->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($module->status == 'Draft')
            {
                $status = 'Published';
            }
            Module::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected module status changed successfully.');
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
            Module::deleteModule($id);
            return redirect('/admin/modules')->with('message','Module delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
