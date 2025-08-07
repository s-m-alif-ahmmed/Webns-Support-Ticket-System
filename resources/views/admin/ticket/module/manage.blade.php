@extends('admin.master')

@section('title')
    Modules
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Modules</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_create']) && $permissionData['ticket_helpers_all']['module_all']['module_create'] == 'module_create')
                <div class="mx-1">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createModule" >Create Module</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Module Modal -->
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
                            <th class="fw-bold" style="color: white;"> Module Name </th>
                            <th class="fw-bold" style="color: white;"> Module Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($modules as $module)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$module->module_code}}</td>
                                <td>{{$module->name}}</td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_status']) && $permissionData['ticket_helpers_all']['module_all']['module_status'] == 'module_status')
                                            @if($module->status == 'Published')
                                                <a href="{{ route('change.module.status', $module->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else($module->status == 'Draft')
                                                <a href="{{ route('change.module.status', $module->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endif
                                        @if($module->status == 'Published')
                                            <p class="text-danger">Published</p>
                                        @elseif($module->status == 'Draft')
                                            <p class="text-green">Draft</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_detail']) && $permissionData['ticket_helpers_all']['module_all']['module_detail'] == 'module_detail')
                                            <a href="{{route('modules.show', Crypt::encryptString($module->id))}}" class="btn all-btn-same">
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
