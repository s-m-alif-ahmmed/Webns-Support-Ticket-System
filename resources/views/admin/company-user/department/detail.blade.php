@extends('admin.master')

@section('title')
    Department Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('department.index') }}">Department</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Department Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_create']) && $permissionData['company_users_all']['department_all']['department_create'] == 'department_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createDepartment" >Create Department</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Department Modal -->
        <div class="modal fade" id="createDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createDepartmentLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createDepartmentLabel" style="color: #FFB400FF;">Create Department</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('department.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="create_user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="update_user_id" value="" />

                                    <div class="col-12 form-group my-0">
                                        <label for="subCompany" class="form-label"> Sub Company Name </label>
                                        <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one industry" required>
                                            <option value="">Choose one sub company</option>
                                            @foreach($sub_companies as $company)
                                                <option value="{{ $company->id }}" {{$company->department_id == $company->id ? 'selected' : ''}} >{{ $company->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="mt-1" />
                                    </div>

                                    <div class="col-12 form-group my-0">
                                        <label for="location" class="form-label"> Location </label>
                                        <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                            <option value="">Select Company</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('location_id')" class="mt-1" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="name" class="form-label"> Department Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter department name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
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

        <hr/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row pb-2">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="">
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Department Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_edit']) && $permissionData['company_users_all']['department_all']['department_edit'] == 'department_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editDepartment" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                            @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_delete']) && $permissionData['company_users_all']['department_all']['department_delete'] == 'department_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('department.destroy', $department->id )}}" method="post" id="deleteForm{{ $department->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $department->id }}', 'Are you sure to delete this department?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Department Modal -->
                            <div class="modal fade" id="editDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDepartmentLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editDepartmentLabel" style="color: #FFB400FF;">Edit Department</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('department.update', Crypt::encryptString($department->id) )}}" >
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="create_user_id" value="{{ $department->create_user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 form-group my-0">
                                                            <label for="subCompany" class="form-label"> Sub Company Name </label>
                                                            <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one industry" required>
                                                                <option value="">Choose one sub company</option>
                                                                @foreach($sub_companies as $company)
                                                                    <option value="{{ $company->id }}" {{ $company->id == $department->sub_company_id ? 'selected' : '' }}>
                                                                        {{ $company->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('sub_company_id')" class="mt-1" />
                                                        </div>

                                                        <div class="col-12 form-group my-0">
                                                            <label for="location" class="form-label"> Location </label>
                                                            <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                                                @if ($department->location_id)
                                                                    <option value="{{ $department->location->id }}">{{ $department->location->location }}</option>
                                                                @else
                                                                    <option value="">Select Company</option>
                                                                @endif
                                                            </select>
                                                            <x-input-error :messages="$errors->get('location_id')" class="mt-1" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Department Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $department->name }}" placeholder="Enter department name" required />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 text-center">
                                                            <button class="btn all-btn-same px-4" type="submit">Update</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_create_info']) && $permissionData['company_users_all']['department_all']['department_status'] == 'department_status')
                                    <tr>
                                        <th> Department Created At </th>
                                        <td>
                                            {{ $department->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Department Created By </th>
                                        <td>{{$department->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_update_info']) && $permissionData['company_users_all']['department_all']['department_status'] == 'department_status')
                                    @if($department->update_user_id)
                                        <tr>
                                            <th> Department Last Updated At </th>
                                            <td>
                                                {{ $department->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Department Last Update By </th>
                                            <td>{{$department->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                @if($department->sub_company_id)
                                    <tr>
                                        <th> Sub Company Name </th>
                                        <td>{{$department->subCompany->name}}</td>
                                    </tr>
                                @endif
                                @if($department->sub_company_id)
                                    <tr>
                                        <th> Sub Company Location Code </th>
                                        <td>{{$department->location->branch_code}}</td>
                                    </tr>
                                    <tr>
                                        <th> Sub Company Location </th>
                                        <td>{{$department->location->location}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Department Name </th>
                                    <td>{{$department->name}}</td>
                                </tr>
                                <tr>
                                    <th> Department Status</th>
                                    <td>
                                        {{$department->status}}
                                        @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_status']) && $permissionData['company_users_all']['department_all']['department_status'] == 'department_status')
                                            @if($department->status == 'Published')
                                                <a href="{{ route('change.department.status', $department->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($department->status == 'Draft')
                                                <a href="{{ route('change.department.status', $department->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
