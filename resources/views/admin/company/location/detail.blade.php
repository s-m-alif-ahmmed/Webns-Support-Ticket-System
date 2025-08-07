@extends('admin.master')

@section('title')
    Location Details
@endsection

@section('content')

    <section class="py-5" style="margin-bottom: 100px;">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('locations.index') }}">Location</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Location Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_create']) && $permissionData['company_everything_all']['location_all']['location_create'] == 'location_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createLocation" >Create Location</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Location Modal -->
        <div class="modal fade" id="createLocation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createLocationLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createLocationLabel" style="color: #FFB400FF;">Create Location</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('locations.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-6 form-group my-0">
                                        <label for="industry" class="form-label"> Industries Name </label>
                                        <select class="form-control select2-show-search form-select" name="industry_id" id="industry" data-placeholder="Choose one industry" required>
                                            <option value="" selected>Choose one industry</option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry->id }}" {{$industry->company_id == $industry->id ? 'selected' : ''}} >{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('industry_id')" class="" />
                                    </div>

                                    <div class="col-md-6 my-0">
                                        <label for="company" class="form-label">Company</label>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                                <option value="">Select Company</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('company_id')" class="" />
                                    </div>

                                    <div class="col-md-6 my-0">
                                        <label for="subCompany" class="form-label">Sub Company</label>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                                <option value="">Select Sub Company</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="branch_code" class="form-label"> Sub Company Location Code </label>
                                        <input class="form-control" type="text" name="branch_code" id="branch_code" placeholder="Enter company name" required />
                                        <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="location_area" class="form-label"> Sub Company Location </label>
                                        <textarea class="form-control" name="location" id="location_area" cols="30" rows="3" required></textarea>
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Location Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_edit']) && $permissionData['company_everything_all']['location_all']['location_edit'] == 'location_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editLocation" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_delete']) && $permissionData['company_everything_all']['location_all']['location_delete'] == 'location_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('locations.destroy', $location->id )}}" method="post" id="deleteForm{{ $location->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $location->id }}', 'Are you sure to delete this location?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Location Modal -->
                            <div class="modal fade" id="editLocation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLocationLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editLocationLabel" style="color: #FFB400FF;">Edit Location</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('locations.update', Crypt::encryptString($location->id) )}}">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $location->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-6 form-group my-0">
                                                            <label for="industry" class="form-label"> Industries Name </label>
                                                            <select class="form-control select2-show-search form-select" name="industry_id" id="industry" data-placeholder="Choose one industry" required>
                                                                <option value="" selected>Choose one industry</option>
                                                                @foreach($industries as $industry)
                                                                    <option value="{{ $industry->id }}" {{ $industry->id ==  $location->industry_id ? 'selected' : '' }}>{{ $industry->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('industry_id')" class="" />
                                                        </div>

                                                        <div class="col-md-6 my-0">
                                                            <label for="company" class="form-label">Company</label>
                                                            <div class="form-group">
                                                                <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                                                    @if ($location->company_id)
                                                                        <option value="{{ $location->company->id }}">{{ $location->company->name }}</option>
                                                                    @else
                                                                        <option value="">Select Company</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('company_id')" class="" />
                                                        </div>

                                                        <div class="col-md-6 my-0">
                                                            <label for="subCompany" class="form-label">Sub Company</label>
                                                            <div class="form-group">
                                                                <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                                                    @if ($location->sub_company_id)
                                                                        <option value="{{ $location->subCompany->id }}">{{ $location->subCompany->name }}</option>
                                                                    @else
                                                                        <option value="">Select Sub Company</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="branch_code" class="form-label"> Sub Company Location Code </label>
                                                            <input class="form-control" type="text" name="branch_code" id="branch_code" value="{{ $location->branch_code }}" placeholder="Enter company name" required />
                                                            <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="location_area" class="form-label"> Sub Company Location </label>
                                                            <textarea class="form-control" name="location" id="location_area" cols="30" rows="3" required>{{ $location->location }}</textarea>
                                                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
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
                                @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_create_info']) && $permissionData['company_everything_all']['location_all']['location_create_info'] == 'location_create_info')
                                    <tr>
                                        <th> Sub Company Created At </th>
                                        <td>
                                            {{ $location->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Sub Company Created By </th>
                                        <td>{{$location->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_update_info']) && $permissionData['company_everything_all']['location_all']['location_update_info'] == 'location_update_info')
                                    @if($location->update_user_id)
                                        <tr>
                                            <th> Sub Company Last Updated At </th>
                                            <td>
                                                {{ $location->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Sub Company Last Update By </th>
                                            <td>{{$location->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                @if($location->industry_id)
                                    <tr>
                                        <th> Industry Name </th>
                                        <td>{{$location->industry->name}}</td>
                                    </tr>
                                @endif
                                @if($location->company_id)
                                    <tr>
                                        <th> Company Name </th>
                                        <td>{{$location->company->name}}</td>
                                    </tr>
                                @endif
                                @if($location->sub_company_id)
                                    <tr>
                                        <th> Sub Company Name </th>
                                        <td>{{$location->subCompany->name}}</td>
                                    </tr>
                                @endif
                                @if($location->sub_company_id)
                                    <tr>
                                        <th> Sub Company Contact Email </th>
                                        <td>{{$location->subCompany->email}}</td>
                                    </tr>
                                @endif
                                @if($location->sub_company_id)
                                    <tr>
                                        <th> Sub Company Contact Number </th>
                                        <td>{{$location->subCompany->number}}</td>
                                    </tr>
                                @endif
                                @if($location->location)
                                    <tr>
                                        <th> Sub Company Address </th>
                                        <td>{!! $location->location !!}</td>
                                    </tr>
                                @endif
                                @if($location->branch_code)
                                    <tr>
                                        <th> Location Code </th>
                                        <td>{{$location->branch_code}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Sub Company Status</th>
                                    <td>
                                        {{$location->status}}
                                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_status']) && $permissionData['company_everything_all']['location_all']['location_status'] == 'location_status')
                                            @if($location->status == 'Published')
                                                <a href="{{ route('change.location.status', $location->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($location->status == 'Draft')
                                                <a href="{{ route('change.location.status', $location->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
