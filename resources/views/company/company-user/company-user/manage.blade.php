@extends('company.master')

@section('title')
    Company Users
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('company.dashboard') }}">Dashboard</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Company Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_create_user']) && $companyPermissionData['company_users_all_user']['company_user_create_user'] == 'company_user_create_user')
                <div class="mx-1">
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
                        <p class="fs-20 fw-bold" id="createCompanyUserLabel" style="color: #FFB400FF;">Create Company User</p>
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
                                        <label class="form-label">Phone Number </label>
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

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-muted">{{ session('message') }}</p>
        @endif
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr style="background-color: #FBA000FF;">
                            <th class="fw-bold" style="color: white;"> SL </th>
                            <th class="fw-bold" style="color: white;"> Sub Company Name </th>
                            <th class="fw-bold" style="color: white;"> Employee ID </th>
                            <th class="fw-bold" style="color: white;"> Name </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($company_users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{$user->subCompany->name}} ({{ $user->location->branch_code }})
                                </td>
                                <td>{{$user->employee_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">

                                        @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_detail_user']) && $companyPermissionData['company_users_all_user']['company_user_detail_user'] == 'company_user_detail_user')
                                            <a href="{{route('user.detail.company', Crypt::encryptString($user->id))}}" class="btn all-btn-same">
                                                View
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

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

@endsection
