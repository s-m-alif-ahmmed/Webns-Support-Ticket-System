@extends('company.master')

@section('title')
    Create Ticket
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('user.index.ticket') }}">Tickets</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr>
        <!-- Create Category Form-->

        <div class="row mb-5 pb-5">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent justify-content-center border-bottom">
                        <h2 class="fw-bolder" style="color: #f8c243;">Create Ticket </h2>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" action="{{ route('user.store.ticket') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="create_user_id" value="" />
                                <input type="hidden" name="update_user_id" value="" />
                                <input type="hidden" name="company_user_id" value="{{ $company_admin->id }}" />
                                <input type="hidden" name="update_company_user_id" value="" />
                                <input type="hidden" name="operation_end_time" value="" />
                                <input type="hidden" name="end_time" value="" />
                                <input type="hidden" name="company_id" value="{{ $company_admin->company_id }}" />
                                <input type="hidden" name="sub_company_id" value="{{ $company_admin->sub_company_id }}" />
                                <input type="hidden" name="location_id" value="{{ $company_admin->location_id }}" />

                                <div class="col-md-6 col-12 py-0 my-0">
                                    <label for="subject" class="form-label"> Subject <span class="text-danger">*</span> </label>
                                    <input class="form-control" type="text" name="subject" id="subject" placeholder="Enter subject" required />
                                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                </div>

                                <div class="col-md-6 col-12 form-group py-0 my-0">
                                    <label for="priority" class="form-label">Priority <span class="text-danger">*</span> </label>
                                    <select class="form-control select2-show-search form-select" name="priority" id="priority" data-placeholder="Choose one priority" required>
                                        <option value="" selected>Select priority</option>
                                        <option value="High" >High</option>
                                        <option value="Medium" >Medium</option>
                                        <option value="Normal" >Normal</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                                </div>

                                <div class="col-md-4 col-12 form-group py-0 my-0">
                                    <label for="module" class="form-label"> Module <span class="text-danger">*</span> </label>
                                    <select class="form-control select2-show-search form-select" name="module_id" id="module" data-placeholder="Choose one module" required>
                                        <option value="" selected>Choose one module</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}" {{$module->ticket_id == $module->id ? 'selected' : ''}} >{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                                </div>

                                <div class="col-md-4 col-12 form-group py-0 my-0">
                                    <label for="subModule" class="form-label">Sub Module</label>
                                    <select class="form-control select2-show-search form-select" name="sub_module_id" id="subModule" data-placeholder="Choose one sub module" >
                                        <option value="" selected>Select sub module</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('sub_module_id')" class="" />
                                </div>

                                <div class="col-md-4 col-12 form-group py-0 my-0">
                                    <label for="ticket_nature_id" class="form-label"> Ticket Nature </label>
                                    <select class="form-control select2-show-search form-select" name="ticket_nature_id" id="ticket_nature_id" data-placeholder="Choose one ticket nature" >
                                        <option value="" selected>Choose one ticket nature</option>
                                        @foreach($ticket_natures as $ticket_nature)
                                            <option value="{{ $ticket_nature->id }}" {{$ticket_nature->ticket_id == $ticket_nature->id ? 'selected' : ''}} >{{ $ticket_nature->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('ticket_nature_id')" class="mt-2" />
                                </div>

                                <div class="col-md-6 col-12 py-0 my-0">
                                    <label for="attachment" class="form-label"> Attachment </label>
                                    <input class="form-control dropify" type="file" name="attachment" id="attachment"  placeholder="Enter attachment" />
                                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                                </div>

                                <div class="col-md-6 col-12 py-0 my-0">
                                    <label for="description" class="form-label"> Details </label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Enter Details"></textarea>
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

    </section>

@endsection
