@extends('admin.master')

@section('title')
    Company User Details
@endsection

@section('content')

    <section class="py-5" style="margin-bottom: 100px;">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('company-users.index') }}">Company Users</a></div>
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
            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_create']) && $permissionData['company_users_all']['company_all_user']['company_user_create'] == 'company_user_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createCompanyUser" >Create Company User</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Company User Modal -->
        <div class="modal fade" id="createCompanyUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCompanyUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createCompanyUserLabel" style="color: #FFB400FF;">Create Company User</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" id="company-user-form" action="{{ route('company-users.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-6 form-group my-0">
                                        <label for="company" class="form-label"> Company Name </label>
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            <option value="">Choose one company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{$company->company_user_id == $company->id ? 'selected' : ''}} >{{ $company->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('company_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="subCompany" class="form-label"> Sub Company Name </label>
                                        <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                            <option value="">Select Sub Company</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="location" class="form-label"> Location </label>
                                        <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                            <option value="">Select Company</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('location')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="department" class="form-label"> Department </label>
                                        <select class="form-control select2-show-search form-select" name="department_id" id="department" data-placeholder="Choose one department" required>
                                            <option value="">Select Department</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="designation" class="form-label"> Designation </label>
                                        <select class="form-control select2-show-search form-select" name="designation_id" id="designation" data-placeholder="Choose one designation" required>
                                            <option value="">Select Designation</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('designation_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="employee_id" class="form-label">Company User Employee ID </label>
                                        <input class="form-control" type="text" name="employee_id" id="employee_id" placeholder="Enter Employee ID" required />
                                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="name" class="form-label">Company User Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter designation name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="email" class="form-label">Company User Mail </label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Mail" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="number" class="form-label">Company User Contact Number </label>
                                        <input class="form-control" type="number" name="number" id="number" placeholder="Enter number" />
                                        <x-input-error :messages="$errors->get('number')" class="mt-1" />
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
                                        <label for="role" class="form-label"> Role </label>
                                        <select class="form-control select2-show-search form-select" name="role" id="role" data-placeholder="Choose one role" required>
                                            <option value="Admin">Admin</option>
                                            <option value="Employee">Employee</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="photo" class="form-label">Company User Photo (400*400px) </label>
                                        <input class="form-control" type="file" name="photo" id="photo" placeholder="Enter photo"  />
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                    <div class="col-6">
                                        <label for="password" class="form-label">Password </label>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" required />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="col-6">
                                        <label for="confirm_password" class="form-label">Confirm Password </label>
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter confirm password" required />
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
                                @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_edit']) && $permissionData['company_users_all']['company_all_user']['company_user_edit'] == 'company_user_edit')
                                    <span class="text-end mx-1">
                                        <button class="btn all-btn-same text-end" id="user-edit-btn">
                                            Edit
                                        </button>
                                    </span>
                                @endif
                                @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_permission']) && $permissionData['company_users_all']['company_all_user']['company_user_permission'] == 'company_user_permission')
                                    <span class="text-end mx-1">
                                        <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#permissionModal">
                                            Permission
                                        </button>
                                    </span>
                                @endif
                                @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_delete']) && $permissionData['company_users_all']['company_all_user']['company_user_delete'] == 'company_user_delete')
                                    <span class="text-end mx-1">
                                        <form action="{{ route('company-users.destroy', $company_user->id )}}" method="post" id="deleteForm{{ $company_user->id }}">
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
                                <label class="form-label">Name</label>
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
                            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_create_info']) && $permissionData['company_users_all']['company_all_user']['company_user_create_info'] == 'company_user_create_info')
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
                                            <p class="form-control m-0" >{{ $company_user->createdBy->name }}</p>
                                        </div>
                                    @elseif($company_user->company_user_id)
                                        <div class="col-md-6">
                                            <label class="form-label">Created By</label>
                                            <p class="form-control m-0" >{{ $company_user->createdByCompany->name }}</p>
                                        </div>
                                    @endif

                                @endif
                            @endif
                            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_update_info']) && $permissionData['company_users_all']['company_all_user']['company_user_update_info'] == 'company_user_update_info')
                                @if($company_user->updated_at)
                                    <div class="col-md-6">
                                        <label class="form-label">Updated At</label>
                                        <p class="form-control m-0" >
                                            {{ $company_user->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Updated By</label>
                                        <p class="form-control m-0" >
                                            @if($company_user->update_user_id)
                                                {{ $company_user->updatedBy->name }}
                                            @elseif($company_user->company_update_user_id)
                                                {{ $company_user->updatedByCompany->name }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                               @endif
                           @endif

                        </div>

                        <div class="row" id="user-edit-form">
                            <div class="form-horizontal">
                                <form class="row" method="post" action="{{route('company-users.update', Crypt::encryptString($company_user->id) )}}" enctype="multipart/form-data" >
                                    @csrf
                                    @method('patch')

                                    <input type="hidden" name="user_id" value="{{ $company_user->user_id }}" />
                                    <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="company_user_id" value="{{ $company_user->company_user_id }}" />
                                    <input type="hidden" name="update_company_user_id" value="{{ $company_user->update_company_user_id }}" />
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

                                    <div class="col-6 form-group my-0">
                                        <label for="company" class="form-label"> Company Name </label>
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            <option value="">Choose one company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ $company->id == $company_user->company_id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('company_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="subCompany" class="form-label"> Sub Company Name </label>
                                        <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                            @if ($company_user->sub_company_id)
                                                <option value="{{ $company_user->subCompany->id }}">{{ $company_user->subCompany->name }}</option>
                                            @else
                                                <option value="">Select Sub Company</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="location" class="form-label"> Location </label>
                                        <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                            @if ($company_user->location_id)
                                                <option value="{{ $company_user->location->id }}">{{ $company_user->location->location }}</option>
                                            @else
                                                <option value="">Select Company</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('location')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="department" class="form-label"> Department </label>
                                        <select class="form-control select2-show-search form-select" name="department_id" id="department" data-placeholder="Choose one department" required>
                                            @if ($company_user->department_id)
                                                <option value="{{ $company_user->department->id }}">{{ $company_user->department->name }}</option>
                                            @else
                                                <option value="">Select Department</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="designation" class="form-label"> Designation </label>
                                        <select class="form-control select2-show-search form-select" name="designation_id" id="designation" data-placeholder="Choose one designation" required>
                                            @if ($company_user->designation_id)
                                                <option value="{{ $company_user->designation->id }}">{{ $company_user->designation->name }}</option>
                                            @else
                                                <option value="">Select Designation</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('designation_id')" class="mt-1" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="employee_id" class="form-label">Company User Employee ID </label>
                                        <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $company_user->employee_id }}" placeholder="Enter Employee ID" required />
                                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="name" class="form-label">Company User Name </label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $company_user->name }}" placeholder="Enter designation name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="email" class="form-label">Company User Mail </label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $company_user->email }}" placeholder="Enter Mail" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-6 form-group my-0">
                                        <label for="number" class="form-label">Company User Contact Number </label>
                                        <input class="form-control" type="number" name="number" id="number" value="{{ $company_user->number }}" placeholder="Enter number" />
                                        <x-input-error :messages="$errors->get('number')" class="mt-1" />
                                    </div>

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
                                        <label for="role" class="form-label"> Role </label>
                                        <select class="form-control select2-show-search form-select" name="role" id="role" data-placeholder="Choose one role" required>
                                            <option value="{{ $company_user->role }}">{{ $company_user->role }}</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Employee">Employee</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="photo" class="form-label">Company User Photo </label>
                                        <input class="form-control dropify" type="file" name="photo" id="photo" value="{{ $company_user->photo }}" placeholder="Enter photo"  />
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="row">
                            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_show_password']) && $permissionData['company_users_all']['company_all_user']['company_user_show_password'] == 'company_user_show_password')
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
                            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_change_password']) && $permissionData['company_users_all']['company_all_user']['company_user_change_password'] == 'company_user_change_password')
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
                                            <form class="" action="{{route('company.users.password.update', Crypt::encryptString($company_user->id) )}}" method="POST">
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

                                                <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

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

                                        <form action="{{ route('company.user.permission.update', $company_user->id ) }}" method="post">
                                            @csrf
                                            @method('post')

                                            <div class="row mx-3">
                                                <label for="">
                                                    <input class="form-check-input" type="checkbox" data-checkem="all" />Select All
                                                </label>
                                            </div>

                                            <div class="row">
                                                <div class="accordion" id="accordionExample">
                                                    @include('admin.company-user.company-user.permission.user_profile')
                                                    @include('admin.company-user.company-user.permission.company_user')
                                                    @include('admin.company-user.company-user.permission.ticket')
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

@endsection
