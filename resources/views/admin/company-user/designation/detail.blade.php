@extends('admin.master')

@section('title')
    Designation Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('designation.index') }}">Designation</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Designation Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_create']) && $permissionData['company_users_all']['designation_all']['designation_create'] == 'designation_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createDesignation" >Create Designation</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Designation Modal -->
        <div class="modal fade" id="createDesignation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createDesignationLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createDesignationLabel" style="color: #FFB400FF;">Create Designation</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('designation.store') }}" method="POST">
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
                                        <x-input-error :messages="$errors->get('location')" class="mt-1" />
                                    </div>

                                    <div class="col-12 form-group my-0">
                                        <label for="department" class="form-label"> Department </label>
                                        <select class="form-control select2-show-search form-select" name="department_id" id="department" data-placeholder="Choose one department" required>
                                            <option value="">Select Department</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="name" class="form-label"> Designation Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter designation name" required />
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Designation Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_edit']) && $permissionData['company_users_all']['designation_all']['designation_edit'] == 'designation_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editDesignation" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_delete']) && $permissionData['company_users_all']['designation_all']['designation_delete'] == 'designation_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('designation.destroy', $designation->id )}}" method="post" id="deleteForm{{ $designation->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $designation->id }}', 'Are you sure to delete this designation?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Department Modal -->
                            <div class="modal fade" id="editDesignation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDesignationLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editDesignationLabel" style="color: #FFB400FF;">Edit Designation</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('designation.update', Crypt::encryptString($designation->id) )}}" >
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $designation->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 form-group my-0">
                                                            <label for="subCompany" class="form-label"> Sub Company Name </label>
                                                            <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one industry" required>
                                                                <option value="">Choose one sub company</option>
                                                                @foreach($sub_companies as $company)
                                                                    <option value="{{ $company->id }}" {{ $company->id == $designation->sub_company_id ? 'selected' : '' }}>
                                                                        {{ $company->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('sub_company_id')" class="mt-1" />
                                                        </div>

                                                        <div class="col-12 form-group my-0">
                                                            <label for="location" class="form-label"> Location </label>
                                                            <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                                                @if ($designation->location_id)
                                                                    <option value="{{ $designation->location->id }}">{{ $designation->location->location }}</option>
                                                                @else
                                                                    <option value="">Select Company</option>
                                                                @endif
                                                            </select>
                                                            <x-input-error :messages="$errors->get('location')" class="mt-1" />
                                                        </div>

                                                        <div class="col-12 form-group my-0">
                                                            <label for="department" class="form-label"> Department </label>
                                                            <select class="form-control select2-show-search form-select" name="department_id" id="department" data-placeholder="Choose one department" required>
                                                                @if ($designation->department_id)
                                                                    <option value="{{ $designation->department->id }}">{{ $designation->department->name }}</option>
                                                                @else
                                                                    <option value="">Select Department</option>
                                                                @endif
                                                            </select>
                                                            <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Designation Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $designation->name }}" placeholder="Enter designation name" required />
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
                                @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_create_info']) && $permissionData['company_users_all']['designation_all']['designation_create_info'] == 'designation_create_info')
                                    <tr>
                                        <th> Designation Created At </th>
                                        <td>
                                            {{ $designation->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Designation Created By </th>
                                        <td>{{$designation->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_update_info']) && $permissionData['company_users_all']['designation_all']['designation_update_info'] == 'designation_update_info')
                                    @if($designation->update_user_id)
                                        <tr>
                                            <th> Designation Last Updated At </th>
                                            <td>
                                                {{ $designation->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Designation Last Update By </th>
                                            <td>{{$designation->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Sub Company Name </th>
                                    <td>{{$designation->subCompany->name}}</td>
                                </tr>
                                <tr>
                                    <th> Sub Company Location Code </th>
                                    <td>{{$designation->location->branch_code}}</td>
                                </tr>
                                <tr>
                                    <th> Sub Company Location </th>
                                    <td>{{$designation->location->location}}</td>
                                </tr>
                                <tr>
                                    <th> Department Name </th>
                                    <td>{{$designation->department->name}}</td>
                                </tr>
                                <tr>
                                    <th> Designation Name </th>
                                    <td>{{$designation->name}}</td>
                                </tr>
                                <tr>
                                    <th> Department Status</th>
                                    <td>
                                        {{$designation->status}}
                                        @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_status']) && $permissionData['company_users_all']['designation_all']['designation_status'] == 'designation_status')
                                            @if($designation->status == 'Published')
                                                <a href="{{ route('change.designation.status', $designation->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($designation->status == 'Draft')
                                                <a href="{{ route('change.designation.status', $designation->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
