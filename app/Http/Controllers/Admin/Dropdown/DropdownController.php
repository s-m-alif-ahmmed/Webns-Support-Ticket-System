<?php

namespace App\Http\Controllers\Admin\Dropdown;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use App\Models\Admin\Ticket\Message;
use App\Models\Admin\Ticket\SubModule;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DropdownController extends Controller
{
    public function getCompaniesIdByIndustries(Request $request)
    {
        $industryId = $request->input('industry_id');
        $companies = Company::where('industry_id', $industryId)->get();

        return response()->json($companies);
    }
    public function getSubCompaniesIdByCompanies(Request $request)
    {
        $companyId = $request->input('company_id');
        $sub_companies = SubCompany::where('company_id', $companyId)->get();

        return response()->json($sub_companies);
    }

    public function getSubCompaniesIdByLocation(Request $request)
    {
        $subCompanyId = $request->input('sub_company_id');
        $locations = Location::where('sub_company_id', $subCompanyId)->get();

        return response()->json($locations);
    }

    public function getLocationsIdByDepartment(Request $request)
    {
        $locationId = $request->input('location_id');
        $departments = Department::where('location_id', $locationId)->get();

        return response()->json($departments);
    }

    public function getDepartmentsIdByDesignation(Request $request)
    {
        $departmentId = $request->input('department_id');
        $designations = Designation::where('department_id', $departmentId)->get();

        return response()->json($designations);
    }

    public function getSubModulesIdByModule(Request $request)
    {
        $moduleId = $request->input('module_id');
        $sub_modules = SubModule::where('module_id', $moduleId)->get();

        return response()->json($sub_modules);
    }

//    public function fetchData()
//    {
//        $ticketId = request()->query('ticket_id'); // Get ticket_id from query parameters
//        if ($ticketId) {
//            $messages = Message::where('ticket_id', $ticketId)->with('createdBy')->get(); // Fetch messages related to the ticket ID
//        } else {
//            $messages = collect(); // Return an empty collection if no ticket ID is provided
//        }
//        return response()->json($messages);
//    }


//    Company User

    public function getDepartmentsIdByDesignationUser(Request $request)
    {
        $departmentId = $request->input('department_id');
        $designations = Designation::where('department_id', $departmentId)->get();

        return response()->json($designations);
    }

    public function getSubModulesIdByModuleCompany(Request $request)
    {
        $moduleId = $request->input('module_id');
        $sub_modules = SubModule::where('module_id', $moduleId)->get();

        return response()->json($sub_modules);
    }

}
