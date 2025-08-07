@extends('company.master')

@section('title')
    Company User Details
@endsection

@section('content')

    <section class="py-5" style="margin-bottom: 100px;">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('user.index.company') }}">Company Users</a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Company User Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_create_user']) && $companyPermissionData['company_users_all_user']['company_user_create_user'] == 'company_user_create_user')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createCompanyUser" >Create User</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create CompanyUser Modal -->
        <div class="modal fade" id="createCompanyUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCompanyUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createCompanyUserLabel" style="color: #FFB400FF;">Create User</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" id="company-user-form" action="{{ route('user.store.company') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="company_user_id" value="{{ $company_admin->id }}" />
                                    <input type="hidden" name="company_id" value="{{ $company_admin->company_id }}" />
                                    <input type="hidden" name="sub_company_id" value="{{ $company_admin->sub_company_id }}" />
                                    <input type="hidden" name="location_id" value="{{ $company_admin->location_id }}" />

                                    <div class="col-6 form-group my-0">
                                        <label for="departmentUser" class="form-label">Department</label>
                                        <select class="form-control select2-show-search form-select" name="department_id" id="departmentUser" data-placeholder="Choose One Department" required>
                                            <option value="">Choose one department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ $department->company_user_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="designationUser" class="form-label">Designation</label>
                                        <select class="form-control select2-show-search form-select" name="designation_id" id="designationUser" data-placeholder="Choose One Designation" required>
                                            <option value="">Select Designation</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('designation_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="name" class="form-label">Full Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Full Name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="email" class="form-label"> Email </label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="employee_id" class="form-label">Employee ID </label>
                                        <input class="form-control" type="text" name="employee_id" id="employee_id" placeholder="Enter Employee ID" required />
                                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="gender" class="form-label"> Gender </label>
                                        <select class="form-control select2-show-search form-select" name="gender" id="gender" data-placeholder="Choose one gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="number" class="form-label">Phone Number </label>
                                        <input class="form-control" type="number" name="number" id="number" placeholder="Enter Phone Number" />
                                        <x-input-error :messages="$errors->get('number')" class="mt-1" />
                                    </div>


                                    <div class="col-6 form-group my-0">
                                        <label for="role" class="form-label"> Role </label>
                                        <select class="form-control select2-show-search form-select" name="role" id="role" data-placeholder="Choose one role" required>
                                            <option value="Admin">Admin</option>
                                            <option value="Employee">Employee</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label class="form-label">Profile Photo </label>
                                        <input class="form-control dropify" type="file" name="photo" id="photo" placeholder="Enter Photo"  />
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="password" class="form-label">Password </label>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password" required />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="confirm_password" class="form-label">Confirm Password </label>
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" required />
                                        <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
                                        <div id="confirm-password-error" class="text-danger mt-2"></div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="btn all-btn-same px-4" type="submit">Create</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-muted">{{session('message')}}</p>
        @endif
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger text-center" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger text-center" />

        <hr/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p class="mb-4 text-center fs-30 fw-bold" style="color: #FFB400FF;">User Profile Info</p>
                            </div>
                            <div class="row">

                                <div class="d-flex">

                                    <div class="col-md-12 pb-2 d-flex justify-content-center text-center">
                                        @if($company_user->photo)
                                            <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                <img class="rounded-circle" src="{{ asset($company_user->photo) }}" alt="Employee" style="height: 100px; width: 100px; border: 2px solid #FBA000FF;">
                                            </div>
                                        @else
                                            @if($company_user->gender == 'Male')
                                                <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                    <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="height: 100px; width: 100px; border: 2px solid #FBA000FF;" >
                                                </div>
                                            @elseif($company_user->gender == 'Female')
                                                <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                    <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 100px; width: 100px; border: 2px solid #FBA000FF;">
                                                </div>
                                            @elseif($company_user->gender == 'Others')
                                                <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                    <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 100px; width: 100px; border: 2px solid #FBA000FF;">
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="card card-body">

                        <div class="row" id="user-view-form">

                            <div class="col-md-12 justify-content-end d-flex">
                                @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_edit_user']) && $companyPermissionData['company_users_all_user']['company_user_edit_user'] == 'company_user_edit_user')
                                    <span class="text-end mx-1">
                                        <button class="btn all-btn-same text-end" id="user-edit-btn">
                                            Edit
                                        </button>
                                    </span>
                                @endif
                                @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_permission_user']) && $companyPermissionData['company_users_all_user']['company_user_permission_user'] == 'company_user_permission_user')
                                    <span class="text-end mx-1">
                                        <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#permissionModal">
                                            Permission
                                        </button>
                                    </span>
                                @endif
                                @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_delete_user']) && $companyPermissionData['company_users_all_user']['company_user_delete_user'] == 'company_user_delete_user')
                                    <span class="text-end mx-1">
                                        <form action="{{ route('user.delete.company', $company_user->id )}}" method="post" id="deleteForm{{ $company_user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $company_user->id }}', 'Are you sure to delete this user?', 'btn-danger')">
                                                Delete
                                            </button>
                                        </form>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <p class="form-control m-0" >{{ $company_user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <p class="form-control m-0" >{{ $company_user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Employee ID</label>
                                <p class="form-control m-0" >{{ $company_user->employee_id }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <p class="form-control m-0" >{{ $company_user->gender }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <p class="form-control m-0" >{{ $company_user->number }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <p class="form-control m-0" >{{ $company_user->role }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Department</label>
                                <p class="form-control m-0" >{{ $company_user->department->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Designation</label>
                                <p class="form-control m-0" >{{ $company_user->designation->name }}</p>
                            </div>
                            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_create_info_user']) && $companyPermissionData['company_users_all_user']['company_user_create_info_user'] == 'company_user_create_info_user')
                                @if($company_user->created_at)
                                    <div class="col-md-6">
                                        <label class="form-label">Created At</label>
                                        <p class="form-control m-0" >
                                            {{ $company_user->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </p>
                                    </div>
                                    @if($company_user->user_id)
                                        <div class="col-md-6">
                                            <label class="form-label">Created By</label>
                                            <p class="form-control m-0" >Webns Technology Ltd.</p>
                                        </div>
                                    @elseif($company_user->company_user_id)
                                        <div class="col-md-6">
                                            <label class="form-label">Created By</label>
                                            <p class="form-control m-0" >{{ $company_user->createdByCompany->name }} ({{ $company_user->createdByCompany->employee_id }})</p>
                                        </div>
                                   @endif
                                @endif
                            @endif
                            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_update_info_user']) && $companyPermissionData['company_users_all_user']['company_user_update_info_user'] == 'company_user_update_info_user')
                                @if($company_user->updated_at)
                                    <div class="col-md-6">
                                        <label class="form-label">Updated At</label>
                                        <p class="form-control m-0" >
                                            {{ $company_user->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </p>
                                    </div>
                                    @if($company_user->update_user_id)
                                        <div class="col-md-6">
                                            <label class="form-label">Updated By</label>
                                            <p class="form-control m-0" >
                                                @if($company_user->update_user_id)
                                                    Webns Technology Ltd.
                                                @else
                                                    N/A
                                                @endif
                                            </p>
                                        </div>
                                    @elseif($company_user->company_update_user_id)
                                        <div class="col-md-6">
                                            <label class="form-label">Updated By</label>
                                            <p class="form-control m-0" >
                                                @if($company_user->company_update_user_id)
                                                    {{ $company_user->updatedByCompany->name }} ({{ $company_user->updatedByCompany->employee_id }})
                                                @else
                                                    N/A
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                @endif
                            @endif

                        </div>

                        <div class="row" id="user-edit-form">
                            <div class="form-horizontal">
                                <form class="row g-3" method="post" action="{{route('user.update.company', Crypt::encryptString($company_user->id) )}}" enctype="multipart/form-data" >
                                    @csrf
                                    @method('post')

                                    <input type="hidden" name="user_id" value="{{ $company_user->user_id }}" />
                                    <input type="hidden" name="update_user_id" value="{{ $company_user->update_user_id }}" />
                                    <input type="hidden" name="company_user_id" value="{{ $company_user->company_user_id }}" />
                                    <input type="hidden" name="update_company_user_id" value="{{ $company_admin->id }}" />
                                    <input type="hidden" name="company_id" value="{{ $company_user->company_id }}" />
                                    <input type="hidden" name="sub_company_id" value="{{ $company_user->sub_company_id }}" />
                                    <input type="hidden" name="location_id" value="{{ $company_user->location_id }}" />
                                    <input type="hidden" name="password" value="{{ $company_user->password }}" />

                                    <div class="col-md-12 text-end">
                                        <span class="text-end">
                                            <input type="submit" class="btn all-btn-same" value="Update" />
                                        </span>
                                        <span>
                                            Or
                                        </span>
                                        <span class="text-end">
                                            <button type="button" class="btn btn-danger" id="user-edit-form-back">
                                               Cancel
                                            </button>
                                        </span>
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="name" class="form-label">Full Name </label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $company_user->name }}" placeholder="Enter designation name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_email_edit_user']) && $companyPermissionData['company_users_all_user']['company_user_email_edit_user'] == 'company_user_email_edit_user')
                                        <div class="col-6 my-0">
                                            <label for="email" class="form-label">Email </label>
                                            <input class="form-control" type="email" name="email" id="email" value="{{ $company_user->email }}" placeholder="Enter Mail" required />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    @else
                                        <div class="col-6 my-0">
                                            <label for="email" class="form-label">Email </label>
                                            <input class="form-control" type="email" name="email" id="email" value="{{ $company_user->email }}" placeholder="Enter Mail" required readonly />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    @endif

                                    @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_employee_id_edit_user']) && $companyPermissionData['company_users_all_user']['company_user_employee_id_edit_user'] == 'company_user_employee_id_edit_user')
                                        <div class="col-6 my-0">
                                            <label for="employee_id" class="form-label">Employee ID </label>
                                            <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $company_user->employee_id }}" placeholder="Enter Employee ID" required />
                                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                        </div>
                                    @else
                                        <div class="col-6 my-0">
                                            <label for="employee_id" class="form-label">Employee ID </label>
                                            <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $company_user->employee_id }}" placeholder="Enter Employee ID" required readonly />
                                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                        </div>
                                    @endif

                                    <div class="col-6 form-group my-0">
                                        <label for="gender" class="form-label"> Gender </label>
                                        <select class="form-control select2-show-search form-select" name="gender" id="gender" data-placeholder="Choose one gender">
                                            <option value="{{ $company_user->gender }}">{{ $company_user->gender }}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="number" class="form-label">Phone Number </label>
                                        <input class="form-control" type="number" name="number" id="number" value="{{ $company_user->number }}" placeholder="Enter number" />
                                        <x-input-error :messages="$errors->get('number')" class="mt-1" />
                                    </div>

                                    @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_role_edit_user']) && $companyPermissionData['company_users_all_user']['company_user_role_edit_user'] == 'company_user_role_edit_user')
                                        <div class="col-6 form-group my-0">
                                            <label for="role" class="form-label"> Role </label>
                                            <select class="form-control select2-show-search form-select" name="role" id="role" data-placeholder="Choose one role" required>
                                                <option value="{{ $company_user->role }}">{{ $company_user->role }}</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('role')" class="mt-1" />
                                        </div>
                                    @else
                                        <div class="col-6 my-0">
                                            <label for="role" class="form-label">Role </label>
                                            <input class="form-control" type="text" name="role" id="role" value="{{ $company_user->role }}" placeholder="Enter role" required readonly />
                                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                        </div>
                                    @endif

                                    @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_department_designation_user']) && $companyPermissionData['company_users_all_user']['company_user_department_designation_user'] == 'company_user_department_designation_user')
                                        <div class="col-6 form-group my-0">
                                            <label for="departmentUser" class="form-label"> Department </label>
                                            <select class="form-control select2-show-search form-select" name="department_id" id="departmentUser" data-placeholder="Choose one department" required>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}" {{ $department->id == $company_user->department_id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                        </div>

                                        <div class="col-6 form-group my-0">
                                            <label for="designationUser" class="form-label"> Designation </label>
                                            <select class="form-control select2-show-search form-select" name="designation_id" id="designationUser" data-placeholder="Choose one designation" required>
                                                @if ($company_user->designation_id)
                                                    <option value="{{ $company_user->designation->id }}">{{ $company_user->designation->name }}</option>
                                                @else
                                                    <option value="">Select Designation</option>
                                                @endif
                                            </select>
                                            <x-input-error :messages="$errors->get('designation_id')" class="mt-1" />
                                        </div>
                                    @else
                                        <div class="col-md-6 my-0">
                                            <label for="department_id" class="form-label">Department</label>
                                            <input type="text" class="form-control" name="department_id" id="department_id" value="{{ $company_user->department->name }}" placeholder="Department Name" required autofocus autocomplete="username" readonly/>
                                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                                        </div>

                                        <div class="col-md-6 my-0">
                                            <label for="designation_id" class="form-label">Designation</label>
                                            <input type="text" class="form-control" name="designation_id" id="designation_id" value="{{ $company_user->designation->name }}" placeholder="Designation Name" required autofocus autocomplete="username" readonly/>
                                            <x-input-error :messages="$errors->get('designation_id')" class="mt-2" />
                                        </div>
                                    @endif

                                    <div class="col-12 my-0">
                                        <label for="photo" class="form-label">Profile Photo </label>
                                        <input class="form-control dropify" type="file" name="photo" id="photo" value="{{ $company_user->photo }}" placeholder="Enter photo"  />
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="row">
                            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_show_password_user']) && $companyPermissionData['company_users_all_user']['company_user_show_password_user'] == 'company_user_show_password_user')
                                <div class="col-md-10">
                                    <label class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control bg-white" id="show-password" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon" disabled>
                                        <span class="input-group-text bg-white" id="basic-addon">
                                            <i class="fa fa-eye text-gray" id="toggleShowPassword"></i>
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-10">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control bg-white" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon2" disabled>
                                </div>
                            @endif
                            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_change_password_user']) && $companyPermissionData['company_users_all_user']['company_user_change_password_user'] == 'company_user_change_password_user')
                                <div class="col-md-2">
                                    <button type="button" class="btn all-btn-same w-100 change-password-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Change Password
                                    </button>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Change Password Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 m-0 pb-0 pt-5">
                                    <p class="fs-20 fw-bold" id="staticBackdropLabel" style="color: #FFB400FF;">Change Password</p>
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body m-0 pt-0">
                                    <div class="form-horizontal pt-0 mt-0">

                                        {{-- Password Changes--}}

                                        <div>
                                            <form class="" action="{{route('company.user.update.password', $company_user->id )}}" method="POST">
                                                @csrf
                                                @method('post')

                                                @if(session('status') === 'password-updated')
                                                    <p
                                                        x-data="{ show: true}"
                                                        x-show ="show"
                                                        x-transition
                                                        x-init="setTimeout(() => show = false, 2000)"
                                                        class="text-sm text-gray-600 text-center"
                                                    >
                                                        {{__('Password Update Successfully')}}
                                                    </p>
                                                @endif

                                                <input type="hidden" name="update_user_id" value="{{ $company_admin->id }}" />

                                                <div class="form-group">
                                                    <label for="password" class="form-label">Current Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" id="old_password" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon1" required disabled readonly >
                                                        <span class="input-group-text bg-white" id="basic-addon1">
                                                            <i class="fa fa-eye text-gray" id="togglePassword"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password" class="form-label">New Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" name="password" class="form-control" id="passwordNew" placeholder="new password" aria-describedby="basic-addon2" required>
                                                        <span class="input-group-text bg-white" id="basic-addon2">
                                                            <i class="fa fa-eye text-gray" id="togglePasswordNew"></i>
                                                        </span>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password" aria-describedby="basic-addon3" required>
                                                        <span class="input-group-text bg-white" id="basic-addon3">
                                                            <i class="fa fa-eye text-gray" id="toggleConfirmPassword"></i>
                                                        </span>
                                                    </div>
                                                    {{--                                                    <small style="font-size: 12px;" id="match-message" class="text-danger d-block"></small>--}}
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                                </div>

                                                <div class="text-center">
                                                    <button class="btn all-btn-same" id="submit-button" type="submit">save changes</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permission Modal -->
                    <div class="modal fade" id="permissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 m-0 pb-0 pt-5">
                                    <p class="fs-20 fw-bold" id="staticBackdropLabel" style="color: #FFB400FF;">Permission</p>
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body m-0 pt-0">
                                    <div class="form-horizontal pt-0 mt-0">

                                        <form action="{{ route('company.user.update.permission', $company_user->id) }}" method="post">
                                            @csrf
                                            @method('post')

                                            <div class="row mx-3">
                                                <label for="">
                                                    <input class="form-check-input" type="checkbox" data-checkem="all" />Select All
                                                </label>
                                            </div>

                                            <div class="row">
                                                <div class="accordion" id="accordionExample">
                                                    @include('company.company-user.company-user.permission.user_profile')
                                                    @include('company.company-user.company-user.permission.company_user')
                                                    @include('company.company-user.company-user.permission.ticket')
                                                </div>

                                            </div>
                                            <div class="col-md-12 py-3 text-end">
                                                <input type="submit" value="Submit" class="btn all-btn-same">
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <style>
        .change-password-button{
            margin-top: 37px;
        }
        @media screen and (min-width: 100px) and (max-width: 576px){
            .change-password-button{
                margin-top: 5px;
            }
        }

        /*Permission Accordion*/

        .accordion-header .accordion-button:focus {
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
            background-color: white;
            border-bottom: 1px solid #DFDFDF !important;
        }
        .accordion-button {
            background-color: white !important;
            border: none !important;
        }
        .accordion-button label {
            color:black;
        }

        .accordion-button::after {
            font-size: 12px !important; /* Adjust the size of the toggle icon */
        }

        input{
            box-shadow: none;
            outline: none;
        }

        .form-check-input:checked{
            background-color: #FFB400FF;
            color: white;
            border: none;
            box-shadow: none;
        }

        .permission-checkbox input:checked{
            outline: none;
            border: none;
            box-shadow: none;
        }

    </style>

    <script>
        document.getElementById('company-user-form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var confirmPasswordError = document.getElementById('confirm-password-error');

            confirmPasswordError.textContent = '';

            if (password !== confirmPassword) {
                event.preventDefault();
                confirmPasswordError.textContent = 'Password and Confirm Password do not match.';
            }
        });
    </script>

    <script>
        // Initialize the preview as hidden
        document.getElementById('previewImage').style.display = 'none';

        // Open the modal
        function openImageEditor() {
            document.getElementById('imageEditorModal').style.display = 'block';
        }

        // Close the modal
        function closeImageEditor() {

            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imageInput');

            // Reset the file input and hide the preview
            fileInput.value = null;
            preview.src = '';
            preview.style.display = 'none';

            document.getElementById('imageEditorModal').style.display = 'none';
        }

        // Preview the selected image
        function previewImage() {
            var preview = document.getElementById('previewImage');
            var view = document.getElementById('viewImage');
            var fileInput = document.getElementById('imageInput');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview when an image is selected
                    view.style.display = 'none'; // Show the preview when an image is selected
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Hide the preview when no image is selected
            }
        }

        // Trigger the preview when the file input changes
        document.getElementById('imageInput').addEventListener('change', previewImage);

    </script>

@endsection
