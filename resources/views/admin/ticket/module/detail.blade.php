@extends('admin.master')

@section('title')
    Module Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('modules.index') }}">Modules</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Module Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_create']) && $permissionData['ticket_helpers_all']['module_all']['module_create'] == 'module_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createModule" >Create Module</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Department Modal -->
        <div class="modal fade" id="createModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModuleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createModuleLabel" style="color: #FFB400FF;">Create Module</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('modules.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-12 my-0">
                                        <label for="module_code" class="form-label"> Module ID </label>
                                        <input class="form-control" type="text" name="module_code" id="module_code" placeholder="Enter module id" required />
                                        <x-input-error :messages="$errors->get('module_code')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="name" class="form-label"> Module Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter module name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="description" class="form-label"> Module Description </label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="4"></textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Module Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_edit']) && $permissionData['ticket_helpers_all']['module_all']['module_edit'] == 'module_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editModule" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_delete']) && $permissionData['ticket_helpers_all']['module_all']['module_delete'] == 'module_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('modules.destroy', $module->id )}}" method="post" id="deleteForm{{ $module->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $module->id }}', 'Are you sure to delete this module?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- Edit Module Modal -->
                            <div class="modal fade" id="editModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModuleLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editModuleLabel" style="color: #FFB400FF;">Edit Module</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('modules.update', Crypt::encryptString($module->id) )}}" >
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $module->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 my-0">
                                                            <label for="module_code" class="form-label"> Module ID </label>
                                                            <input class="form-control" type="text" name="module_code" id="module_code" value="{{ $module->module_code }}" placeholder="Enter module id" required />
                                                            <x-input-error :messages="$errors->get('module_code')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Module Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $module->name }}" placeholder="Enter module name" required />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="description" class="form-label"> Module Description </label>
                                                            <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ $module->description }}</textarea>
                                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_create_info']) && $permissionData['ticket_helpers_all']['module_all']['module_create_info'] == 'module_create_info')
                                    <tr>
                                        <th> Module Created At </th>
                                        <td>
                                            {{ $module->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Module Created By </th>
                                        <td>{{$module->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_update_info']) && $permissionData['ticket_helpers_all']['module_all']['module_update_info'] == 'module_update_info')
                                    @if($module->update_user_id)
                                        <tr>
                                            <th> Module Last Updated At </th>
                                            <td>
                                                {{ $module->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Module Last Update By </th>
                                            <td>{{$module->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Module ID </th>
                                    <td>{{$module->module_code}}</td>
                                </tr>
                                <tr>
                                    <th> Module Name </th>
                                    <td>{{$module->name}}</td>
                                </tr>
                                <tr>
                                    <th> Module Description </th>
                                    <td>{{ $module->description }}</td>
                                </tr>
                                <tr>
                                    <th> Module Status</th>
                                    <td>
                                        {{$module->status}}
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_status']) && $permissionData['ticket_helpers_all']['module_all']['module_status'] == 'module_status')
                                            @if($module->status == 'Published')
                                                <a href="{{ route('change.module.status', $module->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($module->status == 'Draft')
                                                <a href="{{ route('change.module.status', $module->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
