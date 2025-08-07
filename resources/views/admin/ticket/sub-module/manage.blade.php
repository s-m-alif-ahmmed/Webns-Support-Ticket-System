@extends('admin.master')

@section('title')
    Sub Modules
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Sub Modules</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_create'] == 'sub_module_create')
                <div class="mx-1">
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
                            <th class="fw-bold" style="color: white;"> Module ID </th>
                            <th class="fw-bold" style="color: white;"> Sub Module Name </th>
                            <th class="fw-bold" style="color: white;"> Sub Module Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($sub_modules as $sub_module)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$sub_module->module->module_code}}</td>
                                <td>{{$sub_module->name}}</td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_status']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_status'] == 'sub_module_status')
                                            @if($sub_module->status == 'Published')
                                                <a href="{{ route('change.sub.module.status', $sub_module->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else($sub_module->status == 'Draft')
                                                <a href="{{ route('change.sub.module.status', $sub_module->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            @if($module->status == 'Published')
                                                <p class="text-danger">Published</p>
                                            @elseif($module->status == 'Draft')
                                                <p class="text-green">Draft</p>
                                            @endif

                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_detail']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_detail'] == 'sub_module_detail')
                                            <a href="{{route('sub-modules.show', Crypt::encryptString($sub_module->id))}}" class="btn all-btn-same">
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
