@extends('admin.master')

@section('title')
    Industries
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Industries</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_create']) && $permissionData['company_everything_all']['industry_all']['industry_create'] == 'industry_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createIndustry" >Create Industry</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Industry Modal -->
        <div class="modal fade" id="createIndustry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createIndustryLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createIndustryLabel" style="color: #FFB400FF;">Create Industry</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('industries.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-12">
                                        <label for="name" class="form-label"> Industry Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter client category name" required />
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
                                <th class="fw-bold" style="color: white;"> Industry Name </th>
                                <th class="fw-bold" style="color: white;"> Industry Status </th>
                                <th class="fw-bold" style="color: white;"> View </th>
                            </tr>
                        </thead>
                        <tbody id="category-table">
                            @foreach($industries as $industry)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$industry->name}}</td>
                                    <td>
                                        <div class="d-flex mt-3 mb-0">
                                            @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_status']) && $permissionData['company_everything_all']['industry_all']['industry_status'] == 'industry_status')
                                                @if($industry->status == 'Published')
                                                    <a href="{{ route('change.industry.status', $industry->id) }}">
                                                        <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                            <div class="toggle toggle-warning toggle-sm on">
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @else($industry->status == 'Draft')
                                                    <a href="{{ route('change.industry.status', $industry->id) }}">
                                                        <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                            <div class="toggle toggle-warning toggle-sm off">
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endif
                                            @if($industry->status == 'Published')
                                                <p class="text-danger">Published</p>
                                            @elseif($industry->status == 'Draft')
                                                <p class="text-green">Draft</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                            @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_detail']) && $permissionData['company_everything_all']['industry_all']['industry_detail'] == 'industry_detail')
                                                <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                    <a href="{{route('industries.show', Crypt::encryptString($industry->id))}}" class="btn all-btn-same">
                                                        View
                                                    </a>
                                                </span>
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
