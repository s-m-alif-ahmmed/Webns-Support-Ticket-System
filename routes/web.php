<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\ProfilePhotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\CompanyUserMiddleware;
use App\Http\Controllers\Admin\User\UsersController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\Company\IndustryController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\Company\SubCompanyController;
use App\Http\Controllers\Admin\Company\LocationController;
use App\Http\Controllers\Admin\CompanyUser\DepartmentController;
use App\Http\Controllers\Admin\Dropdown\DropdownController;
use App\Http\Controllers\Admin\CompanyUser\DesignationController;
use App\Http\Controllers\Admin\User\CompanyUserController;
use App\Http\Controllers\CompanyUser\Auth\CompanyAuthController;
use App\Http\Controllers\Admin\Ticket\ModuleController;
use App\Http\Controllers\Admin\Ticket\SubModuleController;
use App\Http\Controllers\Admin\Ticket\TicketNatureController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketAssignController;
use App\Http\Controllers\Admin\Ticket\MessageController;
use App\Http\Controllers\Admin\Ticket\CompanyTicketAssignController;
use App\Http\Controllers\Admin\Notification\NotificationController;

Route::get('/', function () {
    return view('company.auth.login');
})->name('home');

//Company Auth
Route::post('/company/login', [CompanyAuthController::class,'loginCheck'])->name('company.login');
Route::post('/company/logout', [CompanyAuthController::class,'logout'])->name('company.logout');


Route::middleware(['auth', 'verified', SuperAdminMiddleware::class ])->group(function (){

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Users
    Route::get('/users',[UsersController::class,'users'])->name('users');
    Route::get('/users/manual-registration',[UsersController::class,'usersRegistration'])->name('users.registration');
    Route::post('/users/manual-registration/store',[UsersController::class,'usersRegistrationStore'])->name('users.registration.store');
    Route::get('/users/profile/{id}',[UsersController::class,'profile'])->name('user.profile');
    Route::patch('/user/change-password/{id}',[UsersController::class,'passwordChange'])->name('users.password.update');
    Route::patch('/update-password/{id}',[UsersController::class,'passwordUpdate'])->name('user.password.update');
    Route::patch('/user/update/{id}',[UsersController::class,'update'])->name('users.update');
    Route::get('/user/detail/{id}',[UsersController::class,'usersDetail'])->name('users.detail');
    Route::delete('/delete/user/{id}', [UsersController::class, 'deleteUser'])->name('delete.user');
    Route::get('/change-role/{id}',[UsersController::class,'changeRole'])->name('change.role');
    Route::get('/change-ban-status/{id}',[UsersController::class,'changeBanStatus'])->name('change.ban.status');
    Route::get('/admin/404',[UsersController::class,'dashboardError'])->name('error');

    //  User Permission
    Route::resource('/user/permission',PermissionController::class);

//    Company User Permission
    Route::get('/company-user/permission/{id}/edit',[PermissionController::class,'companyUserEdit'])->name('company.user.permission.edit');
    Route::post('/company-user/permission/{id}/update',[PermissionController::class,'companyUserUpdate'])->name('company.user.permission.update');

//    Dropdowns
    Route::get('/getCompaniesIdByIndustries', [DropdownController::class, 'getCompaniesIdByIndustries']);
    Route::get('/getSubCompaniesIdByCompanies', [DropdownController::class, 'getSubCompaniesIdByCompanies']);
    Route::get('/getSubCompaniesIdByLocation', [DropdownController::class, 'getSubCompaniesIdByLocation']);
    Route::get('/getLocationsIdByDepartment', [DropdownController::class, 'getLocationsIdByDepartment']);
    Route::get('/getDepartmentsIdByDesignation', [DropdownController::class, 'getDepartmentsIdByDesignation']);
    Route::get('/getModulesIdBySubModule', [DropdownController::class, 'getSubModulesIdByModule']);

//    Route::get('/fetch-data', [DropdownController::class, 'fetchData'])->name('fetch.data');


    //  Industry
    Route::resource('/admin/industries',IndustryController::class);
    Route::get('/admin/change-industry-status/{id}',[IndustryController::class,'changeIndustryStatus'])->name('change.industry.status');

    //  Company
    Route::resource('/admin/companies',CompanyController::class);
    Route::get('/admin/change-company-status/{id}',[CompanyController::class,'changeCompanyStatus'])->name('change.company.status');

    //  Sub Company
    Route::resource('/admin/sub_companies',SubCompanyController::class);
    Route::get('/admin/change-sub-company-status/{id}',[SubCompanyController::class,'changeSubCompanyStatus'])->name('change.sub.company.status');

    //  Location
    Route::resource('/admin/locations',LocationController::class);
    Route::get('/admin/change-location-status/{id}',[LocationController::class,'changeLocationStatus'])->name('change.location.status');

    //  Department
    Route::resource('/admin/department',DepartmentController::class);
    Route::get('/admin/change-department-status/{id}',[DepartmentController::class,'changeDepartmentStatus'])->name('change.department.status');

    //  Designation
    Route::resource('/admin/designation',DesignationController::class);
    Route::get('/admin/change-designation-status/{id}',[DesignationController::class,'changeDesignationStatus'])->name('change.designation.status');

    //  Company User
    Route::resource('/company-users',CompanyUserController::class);
    Route::get('/change-company-user-status/{id}',[CompanyUserController::class,'changeCompanyUserStatus'])->name('change.company.user.status');
    Route::get('/company-users/change-password/{id}',[CompanyUserController::class,'CompanyUserPassword'])->name('company.users.password');
    Route::post('/company-users/password-update/{id}',[CompanyUserController::class,'CompanyUserPasswordUpdate'])->name('company.users.password.update');

    //  Ticket Module
    Route::resource('/admin/modules',ModuleController::class);
    Route::get('/change-module-status/{id}',[ModuleController::class,'changeModuleStatus'])->name('change.module.status');

    //  Ticket Sub Module
    Route::resource('/admin/sub-modules',SubModuleController::class);
    Route::get('/change-sub-module-status/{id}',[SubModuleController::class,'changeSubModuleStatus'])->name('change.sub.module.status');

    //  Ticket Nature
    Route::resource('/admin/ticket-natures',TicketNatureController::class);
    Route::get('/change-ticket-nature-status/{id}',[TicketNatureController::class,'changeTicketNatureStatus'])->name('change.ticket.nature.status');

    //  Ticket
    Route::resource('/admin/tickets',TicketController::class);
    Route::get('/change-ticket-operation-status/{id}',[TicketController::class,'changeTicketOperationStatus'])->name('change.ticket.operation.status');
    Route::get('/change-ticket-admin-status/{id}',[TicketController::class,'changeTicketAdminStatus'])->name('change.ticket.admin.status');

    //  Ticket Work Assign
    Route::resource('/admin/ticket-assigns',TicketAssignController::class);
    Route::get('/change-ticket-assign-work-status/{id}',[TicketAssignController::class,'changeTicketAssignWorkStatus'])->name('change.ticket.assign.work.status');
    Route::get('/change-ticket-assign-status/{id}',[TicketAssignController::class,'changeTicketAssignStatus'])->name('change.ticket.assign.status');

    //  Ticket Company Work Assign
    Route::resource('/admin/ticket-company-assigns',CompanyTicketAssignController::class);
    Route::get('/change-ticket-company-assign-work-status/{id}',[CompanyTicketAssignController::class,'changeTicketCompanyAssignWorkStatus'])->name('change.ticket.company.assign.work.status');
    Route::get('/change-ticket-company-assign-status/{id}',[CompanyTicketAssignController::class,'changeTicketCompanyAssignStatus'])->name('change.ticket.company.assign.status');

    //  Ticket Message
    Route::resource('/admin/ticket-messages',MessageController::class);
    Route::get('/change-ticket-message-status/{id}',[MessageController::class,'changeTicketMessageStatus'])->name('change.ticket.message.status');


});

Route::middleware([CompanyUserMiddleware::class])->group(function (){

    Route::get('/company/dashboard', [DashboardController::class, 'companyDashboard'])->name('company.dashboard');

//    Company User Profile
    Route::get('/company-user/profile/{id}',[UsersController::class,'profileCompany'])->name('company.user.profile');
    Route::get('/company-user/profile/edit/{id}',[UsersController::class,'profileEditCompany'])->name('profile.user.edit.company');
    Route::patch('/company-user/update/{id}',[UsersController::class,'updateCompany'])->name('company.user.update');
    Route::get('/company-user/profile/setting/{id}', [ProfileController::class, 'editCompany'])->name('profile.edit.company');
    Route::patch('/company-user/update-password/{id}',[UsersController::class,'passwordUpdateCompany'])->name('company.user.password.update');

//    Company User
    Route::get('/company/users/manage',[CompanyUserController::class,'indexCompany'])->name('user.index.company');
    Route::get('/company/user/create',[CompanyUserController::class,'createCompanyUser'])->name('user.create.company');
    Route::post('/company/user/store',[CompanyUserController::class,'storeCompanyUser'])->name('user.store.company');
    Route::get('/company/user/edit/{id}',[CompanyUserController::class,'editCompanyUser'])->name('user.edit.company');
    Route::post('/company/user/update/{id}',[CompanyUserController::class,'updateCompanyUser'])->name('user.update.company');
    Route::get('/company/user/detail/{id}',[CompanyUserController::class,'companyUserShow'])->name('user.detail.company');
    Route::delete('/company/user/delete/{id}',[CompanyUserController::class,'destroyCompanyUser'])->name('user.delete.company');
    Route::get('/company/user/change-password/{id}',[CompanyUserController::class,'CompanyUserPasswordUser'])->name('company.user.password.edit');
    Route::post('/company/user/password-update/{id}',[CompanyUserController::class,'CompanyUserPasswordUpdateUser'])->name('company.user.update.password');

//    Company User Permission
    Route::get('/company/user/permission/{id}/edit',[PermissionController::class,'companyUserPermissionEdit'])->name('company.user.edit.permission');
    Route::post('/company/user/permission/{id}/update',[PermissionController::class,'companyUserPermissionUpdate'])->name('company.user.update.permission');

//    Company User Profile Photo
    Route::post('/company/user/profile-photo/{id}', [ProfilePhotoController::class, 'storeCompany'])->name('company.user.photo.store');
    Route::patch('/company/user/profile-photo/{id}', [ProfilePhotoController::class, 'updateCompany'])->name('company.user.photo.update');
    Route::delete('/company/user/profile-photo/{id}', [ProfilePhotoController::class, 'destroyCompany'])->name('company.user.photo.delete');

//  Dropdowns
    Route::get('/getDepartmentsIdByDesignationUser', [DropdownController::class, 'getDepartmentsIdByDesignationUser']);
    Route::get('/getSubModulesIdByModuleCompany', [DropdownController::class, 'getSubModulesIdByModuleCompany']);

//   Company User Ticket
    Route::get('/company/ticket/manage',[TicketController::class,'indexCompany'])->name('user.index.ticket');
    Route::get('/company/ticket/list',[TicketController::class,'ticketList'])->name('user.ticket.list');
    Route::get('/company/created/ticket/list',[TicketController::class,'userCreatedTicket'])->name('user.created.ticket');
    Route::get('/company/ticket/create',[TicketController::class,'createCompany'])->name('user.create.ticket');
    Route::post('/company/ticket/store',[TicketController::class,'storeCompany'])->name('user.store.ticket');
    Route::get('/company/ticket/view/{id}',[TicketController::class,'showCompany'])->name('user.show.ticket');
    Route::get('/change-ticket-status/{id}',[TicketController::class,'changeTicketCreatorStatus'])->name('change.ticket.status.close');

//    Company User Ticket Message
    Route::get('/company/ticket/message/create',[MessageController::class,'createCompany'])->name('user.create.message');
    Route::post('/company/ticket/message/store',[MessageController::class,'storeCompany'])->name('user.store.message');

//    Company User Ticket Assign
    Route::post('/company-user/ticket/assign/store',[CompanyTicketAssignController::class,'storeCompany'])->name('company.user.store.assign');
    Route::put('/company-user/ticket/assign/update/{id}',[CompanyTicketAssignController::class,'updateCompany'])->name('company.user.update.assign');
    Route::delete('/company-user/ticket/assign/delete/{id}',[CompanyTicketAssignController::class,'deleteCompany'])->name('company.user.delete.assign');

});

Route::middleware('auth')->group(function () {
//    Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    Profile Photo manage
    Route::resource('/photo', ProfilePhotoController::class);
    Route::get('/photo/{id}', [ProfilePhotoController::class, 'show'])->name('profile.show');

});

require __DIR__.'/auth.php';
