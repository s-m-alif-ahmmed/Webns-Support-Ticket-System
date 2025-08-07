@extends('admin.master')

@section('title')
    Locations
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Locations</li>
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
                            <th class="fw-bold" style="color: white;"> Location Code </th>
                            <th class="fw-bold" style="color: white;"> Location </th>
                            <th class="fw-bold" style="color: white;"> Location Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($locations as $location)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$location->subCompany->name}}</td>
                                <td>{{$location->branch_code}}</td>
                                <td>{{$location->location}}</td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_status']) && $permissionData['company_everything_all']['location_all']['location_status'] == 'location_status')
                                            @if($location->status == 'Published')
                                                <a href="{{ route('change.location.status', $location->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else($location->status == 'Draft')
                                                <a href="{{ route('change.location.status', $location->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            @if($location->status == 'Published')
                                                <p class="text-danger">Published</p>
                                            @elseif($location->status == 'Draft')
                                                <p class="text-green">Draft</p>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_detail']) && $permissionData['company_everything_all']['location_all']['location_detail'] == 'location_detail')
                                            <a href="{{route('locations.show', Crypt::encryptString($location->id))}}" class="btn all-btn-same">
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
