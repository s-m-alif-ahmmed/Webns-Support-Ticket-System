@extends('admin.master')

@section('title')
    Company Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('companies.index') }}">Company</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Company Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_create']) && $permissionData['company_everything_all']['company_all']['company_create'] == 'company_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" id="company-create" data-bs-toggle="modal" data-bs-target="#createCompany" >Create Company</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Company Modal -->
        <div class="modal fade" id="createCompany" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCompanyLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createCompanyLabel" style="color: #FFB400FF;">Create Company</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-12 form-group my-0">
                                        <label for="industry_id" class="form-label"> Industries Name </label>
                                        <select class="form-control select2-show-search form-select" name="industry_id" data-placeholder="Choose one industry" required>
                                            <option value="" selected>Choose one industry</option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry->id }}" {{$industry->company_id == $industry->id ? 'selected' : ''}} >{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('industry_id')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="name" class="form-label"> Company Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter company name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="image" class="form-label"> Company Logo (512*512 px) </label>
                                        <input class="form-control" type="file" name="image" id="image" placeholder="Enter company logo" required />
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>

                                    <div class="col-12">
                                        <label for="web_slug" class="form-label"> Company Website Url </label>
                                        <input class="form-control" type="text" name="web_slug" id="web_slug" placeholder="Enter company website url"  />
                                        <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
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

                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="">
                                        <p class="fs-30 fw-bold my-0 py-2" style="color: #FFB400FF;">Company Detail</p>
                                    </div>
                                    <div class="d-flex py-3">
                                        @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_edit']) && $permissionData['company_everything_all']['company_all']['company_edit'] == 'company_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editCompany" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_delete']) && $permissionData['company_everything_all']['company_all']['company_delete'] == 'company_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('companies.destroy', $company->id )}}" method="post" id="deleteForm{{ $company->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $company->id }}', 'Are you sure to delete this company?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Company Modal -->
                            <div class="modal fade" id="editCompany" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editCompanyLabel" style="color: #FFB400FF;">Edit Industry</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('companies.update', Crypt::encryptString($company->id) )}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $company->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 form-group my-0">
                                                            <label for="industry_id" class="form-label"> Industries Name </label>
                                                            <select class="form-control select2-show-search form-select" name="industry_id" data-placeholder="Choose one industry" required>
                                                                <option value="" selected>Choose one industry</option>
                                                                @foreach($industries as $industry)
                                                                    <option value="{{ $industry->id }}" {{$industry->id == $company->industry_id ? 'selected' : ''}}>{{ $industry->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('industry_id')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Company Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}" placeholder="Enter company name" required />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="image" class="form-label"> Company Logo (512*512 px) </label>
                                                            <input class="form-control" type="file" name="image" id="image" value="{{ $company->image }}" placeholder="Enter company logo" />
                                                            <img class="img-fluid mt-1" src="{{ asset( $company->image) }}" alt="" style="height: 80px; width: 80px;" />
                                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="web_slug" class="form-label"> Company Website Url </label>
                                                            <input class="form-control" type="text" name="web_slug" id="web_slug" value="{{ $company->web_slug }}" placeholder="Enter company website url"  />
                                                            <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
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
                                @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_create_info']) && $permissionData['company_everything_all']['company_all']['company_create_info'] == 'company_create_info')
                                    <tr>
                                        <th> Company Created At </th>
                                        <td>
                                            {{ $company->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Company Created By </th>
                                        <td>{{$company->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_update_info']) && $permissionData['company_everything_all']['company_all']['company_update_info'] == 'company_update_info')
                                    @if($company->update_user_id)
                                        <tr>
                                            <th> Company Last Updated At </th>
                                            <td>
                                                {{ $company->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Company Last Update By </th>
                                            <td>{{$company->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Industry Name </th>
                                    <td>{{$company->industry->name}}</td>
                                </tr>
                                <tr>
                                    <th> Company Name </th>
                                    <td>{{$company->name}}</td>
                                </tr>
                                <tr>
                                    <th> Company Logo (512*512 px) </th>
                                    <td>
                                        <img class="img-fluid m-1" src="{{ asset($company->image) }}" alt="" style="height: 80px; width: 80px;">
                                    </td>
                                </tr>
                                <tr>
                                    <th> Company Website Url </th>
                                    <td>{{$company->web_slug}}</td>
                                </tr>
                                @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_code']) && $permissionData['company_everything_all']['company_all']['company_code'] == 'company_code')
                                    <tr>
                                        <th> Company Code </th>
                                        <td>{{$company->company_code}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Company Status</th>
                                    <td>
                                        {{$company->status}}
                                        @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_status']) && $permissionData['company_everything_all']['company_all']['company_status'] == 'company_status')
                                            @if($company->status == 'Published')
                                                <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($company->status == 'Draft')
                                                <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
