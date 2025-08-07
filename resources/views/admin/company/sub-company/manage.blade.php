@extends('admin.master')

@section('title')
    Sub Companies
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Sub Companies</li>
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

        <!-- Create Industry Modal -->
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
                                        <label class="form-label"> Sub Company Logo (512*512px)</label>
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
                            <th class="fw-bold" style="color: white;"> Company Name </th>
                            <th class="fw-bold" style="color: white;"> Sub Company Name </th>
                            <th class="fw-bold" style="color: white;"> Sub Company Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($sub_companies as $company)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$company->company->name}}</td>
                                <td>{{$company->name}}</td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_status']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_status'] == 'sub_company_status')
                                            @if($company->status == 'Published')
                                                <a href="{{ route('change.sub.company.status', $company->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else($company->status == 'Draft')
                                                <a href="{{ route('change.sub.company.status', $company->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            @if($company->status == 'Published')
                                                <p class="text-danger">Published</p>
                                            @elseif($company->status == 'Draft')
                                                <p class="text-green">Draft</p>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_detail']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_detail'] == 'sub_company_detail')
                                            <a href="{{route('sub_companies.show', Crypt::encryptString($company->id))}}" class="btn all-btn-same">
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
