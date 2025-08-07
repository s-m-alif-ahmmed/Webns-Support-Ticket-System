@extends('admin.master')

@section('title')
    Sub Company Details
@endsection

@section('content')

    <section class="py-5" style="margin-bottom: 100px;">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('sub_companies.index') }}">Sub Company</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sub Company Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_create']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_create'] == 'sub_company_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createSubCompany" >Create Sub Company</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Sub Company Modal -->
        <div class="modal fade" id="createSubCompany" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createSubCompanyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createSubCompanyLabel" style="color: #FFB400FF;">Create Sub Company</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('sub_companies.store') }}" method="POST" enctype="multipart/form-data">
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

                                    <div class="col-6 my-0">
                                        <label for="name" class="form-label"> Sub Company Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter company name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="web_slug" class="form-label"> Sub Company Website Url </label>
                                        <input class="form-control" type="text" name="web_slug" id="web_slug" placeholder="Enter company website url"  />
                                        <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label class="form-label"> Sub Company Logo (512*512 px)</label>
                                        <input class="form-control" type="file" name="image" id="image" placeholder="Enter company logo" />
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="email" class="form-label"> Sub Company Contact Email </label>
                                        <input class="form-control" type="text" name="email" id="email" placeholder="Enter company contact email"  />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="number" class="form-label"> Sub Company Contact Number </label>
                                        <input class="form-control" type="text" name="number" id="number" placeholder="Enter company contact number"  />
                                        <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="sister_concern" class="form-label"> Is Sister Concern? </label>
                                        <div class="form-group">
                                            <select class="form-control select2 form-select" name="sister_concern" id="sister_concern" data-placeholder="Choose one" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('sister_concern')" class="mt-2" />
                                    </div>

                                    <div class="col-6 my-0">
                                        <label for="branch" class="form-label"> Is It Branch? </label>
                                        <div class="form-group">
                                            <select class="form-control select2 form-select" name="branch" id="branch" data-placeholder="Choose one" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('branch')" class="mt-2" />
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
                                        <p class="fs-30 fw-bold my-0 py-2" style="color: #FFB400FF;">Sub Company Detail</p>
                                    </div>
                                    <div class="d-flex py-3">
                                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_edit']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_edit'] == 'sub_company_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editSubCompany" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_delete']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_delete'] == 'sub_company_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('sub_companies.destroy', $sub_company->id )}}" method="post" id="deleteForm{{ $sub_company->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $sub_company->id }}', 'Are you sure to delete this sub company?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Company Modal -->
                            <div class="modal fade" id="editSubCompany" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubCompanyLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editSubCompanyLabel" style="color: #FFB400FF;">Edit Industry</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('sub_companies.update', Crypt::encryptString($sub_company->id) )}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $sub_company->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-6 form-group my-0">
                                                            <label for="industry" class="form-label"> Industries Name </label>
                                                            <select class="form-control select2-show-search form-select" name="industry_id" id="industry" data-placeholder="Choose one industry" required>
                                                                <option value="" selected>Choose one industry</option>
                                                                @foreach($industries as $industry)
                                                                    <option value="{{ $industry->id }}" {{ $industry->id ==  $sub_company->industry_id ? 'selected' : '' }}>{{ $industry->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('industry_id')" class="" />
                                                        </div>

                                                        <div class="col-md-6 my-0">
                                                            <label for="company" class="form-label">Company</label>
                                                            <div class="form-group">
                                                                <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                                                    @if ($sub_company->company_id)
                                                                        <option value="{{ $sub_company->company->id }}">{{ $sub_company->company->name }}</option>
                                                                    @else
                                                                        <option value="">Select Company</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('company_id')" class="" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="name" class="form-label"> Sub Company Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $sub_company->name }}" placeholder="Enter company name" required />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="web_slug" class="form-label"> Sub Company Website Url </label>
                                                            <input class="form-control" type="text" name="web_slug" id="web_slug" value="{{ $sub_company->web_slug }}" placeholder="Enter company website url"  />
                                                            <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label class="form-label"> Sub Company Logo (512*512 px)</label>
                                                            <input class="form-control" type="file" name="image" id="image" value="{{ $sub_company->image }}" placeholder="Enter company logo" />
                                                            @if($sub_company->image)
                                                                <img class="img-fluid mt-1" src="{{ asset( $sub_company->image ) }}" alt="" style="height: 80px; width: 80px;">
                                                            @endif
                                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="email" class="form-label"> Sub Company Contact Email </label>
                                                            <input class="form-control" type="text" name="email" id="email" value="{{ $sub_company->email }}" placeholder="Enter company contact email"  />
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="number" class="form-label"> Sub Company Contact Number </label>
                                                            <input class="form-control" type="text" name="number" id="number" value="{{ $sub_company->number }}" placeholder="Enter company contact number"  />
                                                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="sister_concern" class="form-label"> Is Sister Concern? </label>
                                                            <div class="form-group">
                                                                <select class="form-control select2 form-select" name="sister_concern" id="sister_concern" data-placeholder="Choose one" required>
                                                                    <option value="{{ $sub_company->sister_concern }}">{{ $sub_company->sister_concern }}</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('sister_concern')" class="mt-2" />
                                                        </div>

                                                        <div class="col-6 my-0">
                                                            <label for="branch" class="form-label"> Is It Branch? </label>
                                                            <div class="form-group">
                                                                <select class="form-control select2 form-select" name="branch" id="branch" data-placeholder="Choose one" required>
                                                                    <option value="{{ $sub_company->branch }}">{{ $sub_company->branch }}</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('branch')" class="mt-2" />
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
                                @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_create_info']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_create_info'] == 'sub_company_create_info')
                                    <tr>
                                        <th> Sub Company Created At </th>
                                        <td>
                                            {{ $sub_company->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Sub Company Created By </th>
                                        <td>{{$sub_company->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_update_info']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_update_info'] == 'sub_company_update_info')
                                    @if($sub_company->update_user_id)
                                        <tr>
                                            <th> Sub Company Last Updated At </th>
                                            <td>
                                                {{ $sub_company->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Sub Company Last Update By </th>
                                            <td>{{$sub_company->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                @if($sub_company->industry_id)
                                    <tr>
                                        <th> Industry Name </th>
                                        <td>{{$sub_company->industry->name}}</td>
                                    </tr>
                                @endif
                                @if($sub_company->company_id)
                                    <tr>
                                        <th> Company Name </th>
                                        <td>{{$sub_company->company->name}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Sub Company Name </th>
                                    <td>{{$sub_company->name}}</td>
                                </tr>
                                @if($sub_company->image)
                                    <tr>
                                        <th> Sub Company Logo </th>
                                        <td>
                                            <img class="img-fluid m-1" src="{{ asset($sub_company->image) }}" alt="" style="height: 80px; width: auto;">
                                        </td>
                                    </tr>
                                @endif
                                @if($sub_company->web_slug)
                                    <tr>
                                        <th> Sub Company Website Url </th>
                                        <td>{{$sub_company->web_slug}}</td>
                                    </tr>
                                @endif
                                @if($sub_company->email)
                                    <tr>
                                        <th> Sub Company Contact Email </th>
                                        <td>{{$sub_company->email}}</td>
                                    </tr>
                                @endif
                                @if($sub_company->number)
                                    <tr>
                                        <th> Sub Company Contact Number </th>
                                        <td>{{$sub_company->number}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_code']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_code'] == 'sub_company_code')
                                    @if($sub_company->sub_company_code)
                                        <tr>
                                            <th> Sub Company Code </th>
                                            <td>{{$sub_company->sub_company_code}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Sub Company Status</th>
                                    <td>
                                        {{$sub_company->status}}
                                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_status']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_status'] == 'sub_company_status')
                                            @if($sub_company->status == 'Published')
                                                <a href="{{ route('change.sub.company.status', $sub_company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($sub_company->status == 'Draft')
                                                <a href="{{ route('change.sub.company.status', $sub_company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
