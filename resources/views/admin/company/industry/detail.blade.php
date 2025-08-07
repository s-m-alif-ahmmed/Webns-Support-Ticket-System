@extends('admin.master')

@section('title')
    Industry Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('industries.index') }}">Industry</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Industry Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_create']) && $permissionData['company_everything_all']['industry_all']['industry_create'] == 'industry_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" id="industry-create" data-bs-toggle="modal" data-bs-target="#createIndustry" >Create Industry</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Industry Modal -->
        <div class="modal fade" id="createIndustry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-muted">{{session('message')}}</p>
        @endif

        <hr/>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="">
                                        <p class="fs-30 fw-bold my-0 py-2" style="color: #FFB400FF;">Industry Detail</p>
                                    </div>
                                    <div class="d-flex py-3">
                                        @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_edit']) && $permissionData['company_everything_all']['industry_all']['industry_edit'] == 'industry_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editIndustry" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_delete']) && $permissionData['company_everything_all']['industry_all']['industry_delete'] == 'industry_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('industries.destroy', $industry->id )}}" method="post" id="deleteForm{{ $industry->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $industry->id }}', 'Are you sure to delete this industry?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Industry Modal -->
                            <div class="modal fade" id="editIndustry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editIndustryLabel" style="color: #FFB400FF;">Edit Industry</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" action="{{route('industries.update', Crypt::encryptString($industry->id) )}}" method="POST">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $industry->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12">
                                                            <label for="name" class="form-label"> Industry Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $industry->name }}" placeholder="Enter client category name" required />
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
                                @php
                                    $permissionData = json_decode(Auth::user()->permission, true);
                                @endphp
                                @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_create_info']) && $permissionData['company_everything_all']['industry_all']['industry_create_info'] == 'industry_create_info')
                                    <tr>
                                        <th> Industry Created At </th>
                                        <td>
                                            {{ $industry->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    @if($industry->user_id)
                                        <tr>
                                            <th> Industry Created By </th>
                                            <td>{{$industry->createdBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_update_info']) && $permissionData['company_everything_all']['industry_all']['industry_update_info'] == 'industry_update_info')
                                    @if($industry->update_user_id)
                                        <tr>
                                            <th> Industry Last Updated At </th>
                                            <td>
                                                {{ $industry->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Industry Last Update By </th>
                                            <td>{{$industry->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Industry Name </th>
                                    <td>{{$industry->name}}</td>
                                </tr>
                                <tr>
                                    <th> Industry Status</th>
                                    <td>
                                        {{$industry->status}}
                                        @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_status']) && $permissionData['company_everything_all']['industry_all']['industry_status'] == 'industry_status')
                                            @if($industry->status == 'Published')
                                                <a href="{{ route('change.industry.status', $industry->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($industry->status == 'Draft')
                                                <a href="{{ route('change.industry.status', $industry->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
