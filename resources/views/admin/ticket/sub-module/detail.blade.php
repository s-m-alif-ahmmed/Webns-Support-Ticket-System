@extends('admin.master')

@section('title')
    Sub Module Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('sub-modules.index') }}">Sub Modules</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sub Module Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create'] == 'sub_module_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createSubModule" >Create Sub Module</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Sub Module Modal -->
        <div class="modal fade" id="createSubModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createSubModuleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createSubModuleLabel" style="color: #FFB400FF;">Create Sub Module</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('sub-modules.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-12 form-group my-0">
                                        <label for="module_id" class="form-label"> Modules Name </label>
                                        <select class="form-control select2-show-search form-select" name="module_id" id="module_id" data-placeholder="Choose one module" required>
                                            <option value="" selected>Choose one module</option>
                                            @foreach($modules as $module)
                                                <option value="{{ $module->id }}" {{$module->sub_module_id == $module->id ? 'selected' : ''}} >{{ $module->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="sub_module_code" class="form-label"> Sub Module ID </label>
                                        <input class="form-control" type="text" name="sub_module_code" id="sub_module_code" placeholder="Enter sub module id" required />
                                        <x-input-error :messages="$errors->get('sub_module_code')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="name" class="form-label"> Sub Module Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter module name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-12 my-0">
                                        <label for="description" class="form-label"> Sub Module Description </label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter sub module description" cols="30" rows="4"></textarea>
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Sub Module Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_edit']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_edit'] == 'sub_module_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editSubModule" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                            @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_delete']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_delete'] == 'sub_module_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('sub-modules.destroy', $sub_module->id )}}" method="post" id="deleteForm{{ $sub_module->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $sub_module->id }}', 'Are you sure to delete this sub module?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Sub Module Modal -->
                            <div class="modal fade" id="editSubModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubModuleLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editSubModuleLabel" style="color: #FFB400FF;">Edit Sub Module</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('sub-modules.update', Crypt::encryptString($sub_module->id) )}}" >
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $sub_module->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 form-group my-0">
                                                            <label for="module_id" class="form-label"> Modules Name </label>
                                                            <select class="form-control select2-show-search form-select" name="module_id" id="module_id" data-placeholder="Choose one module" required>
                                                                <option value="" selected>Choose one module</option>
                                                                @foreach($modules as $module)
                                                                    <option value="{{ $module->id }}" {{$module->id == $sub_module->module_id ? 'selected' : ''}}>{{ $module->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="sub_module_code" class="form-label"> Sub Module ID </label>
                                                            <input class="form-control" type="text" name="sub_module_code" id="sub_module_code" value="{{ $sub_module->sub_module_code }}" placeholder="Enter sub module id" required />
                                                            <x-input-error :messages="$errors->get('sub_module_code')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Module Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $sub_module->name }}" placeholder="Enter sub module name" required />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 my-0">
                                                            <label for="description" class="form-label"> Module Description </label>
                                                            <textarea class="form-control" name="description" id="description" placeholder="Enter sub module description" cols="30" rows="4">{{ $sub_module->description }}</textarea>
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
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create_info']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create_info'] == 'sub_module_create_info')
                                    <tr>
                                        <th> Sub Module Created At </th>
                                        <td>
                                            {{ $sub_module->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Sub Module Created By </th>
                                        <td>{{$sub_module->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_update_info']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_update_info'] == 'sub_module_update_info')
                                    @if($sub_module->update_user_id)
                                        <tr>
                                            <th> Sub Module Last Updated At </th>
                                            <td>
                                                {{ $sub_module->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Sub Module Last Update By </th>
                                            <td>{{$sub_module->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Module </th>
                                    <td>
                                        {{$sub_module->module->name}} ({{$sub_module->module->module_code}})
                                    </td>
                                </tr>
                                <tr>
                                    <th> Sub Module ID </th>
                                    <td>{{$sub_module->sub_module_code}}</td>
                                </tr>
                                <tr>
                                    <th> Module Name </th>
                                    <td>{{$sub_module->name}}</td>
                                </tr>
                                <tr>
                                    <th> Sub Module Description </th>
                                    <td>{{ $sub_module->description }}</td>
                                </tr>
                                <tr>
                                    <th> Sub Module Status</th>
                                    <td>
                                        {{$sub_module->status}}
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_status']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_status'] == 'sub_module_status')
                                            @if($sub_module->status == 'Published')
                                                <a href="{{ route('change.sub.module.status', $sub_module->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($sub_module->status == 'Draft')
                                                <a href="{{ route('change.sub.module.status', $sub_module->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
