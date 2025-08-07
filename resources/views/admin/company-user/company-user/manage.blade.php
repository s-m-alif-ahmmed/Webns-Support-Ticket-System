@extends('admin.master')

@section('title')
    Company Users
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
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
            @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_create']) && $permissionData['company_users_all']['company_all_user']['company_user_create'] == 'company_user_create')
                <div class="mx-1">
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

                                        @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_detail']) && $permissionData['company_users_all']['company_all_user']['company_user_detail'] == 'company_user_detail')
                                            <a href="{{route('company-users.show', Crypt::encryptString($user->id))}}" class="btn all-btn-same">
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

@endsection
