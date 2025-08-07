@extends('admin.master')

@section('title')
    Tickets
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Tickets</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_create']) && $permissionData['tickets_all']['tickets']['ticket_create'] == 'ticket_create')
                <div class="">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createTicket" >Create Ticket</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Ticket Modal -->
        <div class="modal fade" id="createTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTicketLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createTicketLabel" style="color: #FFB400FF;">Create Ticket</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="create_user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="update_user_id" value="" />
                                    <input type="hidden" name="company_user_id" value="" />
                                    <input type="hidden" name="update_company_user_id" value="" />
                                    <input type="hidden" name="operation_end_time" value="" />
                                    <input type="hidden" name="end_time" value="" />

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
                                        <label for="company" class="form-label"> Company <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            <option value="" selected>Choose one company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{$company->ticket_id == $company->id ? 'selected' : ''}} >{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="subCompany" class="form-label">Sub Company <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                            <option value="" selected>Select sub company</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                            <option value="" selected>Select location</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('location_id')" class="" />
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
        </div>

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-muted">{{ session('message') }}</p>
        @endif
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr style="background-color: #FBA000FF;">
                            <th class="fw-bold" style="width: 2%; color: white;"> SL </th>
                            <th class="fw-bold" style="width: 5%; color: white;"> T. ID </th>
                            <th class="fw-bold" style="width: 5%; color: white;"> Priority </th>
                            <th class="fw-bold" style="width: 12%; color: white;"> Ticket Nature </th>
                            <th class="fw-bold" style="width: 10%; color: white;"> Sub Company </th>
                            <th class="fw-bold" style="width: 5%; color: white;"> Module</th>
                            <th class="fw-bold" style="width: 10%; color: white;"> Sub Module </th>
                            <th class="fw-bold" style="width: 33%; color: white;"> Subject </th>
                            <th class="fw-bold" style="width: 13%; color: white;"> Date </th>
                            <th class="fw-bold" style="width: 3%; color: white;"> Status </th>
                            <th class="fw-bold" style="width: 5%; color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($tickets->sortByDesc('created_at') as $ticket)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ticket->ticket_code}}</td>
                                <td>{{$ticket->priority}}</td>
                                <td>
                                    @if($ticket->ticket_nature_id)
                                        {{ strlen($ticket->ticket_nature->name) >= 15 ? substr($ticket->ticket_nature->name, 0, 10) . '...' : $ticket->ticket_nature->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->location_id)
                                        {{$ticket->location->subCompany->name}} ( {{$ticket->location->branch_code}} )
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->module_id)
                                        {{$ticket->module->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->sub_module_id)
                                        {{ strlen($ticket->subModule->name) >= 15 ? substr($ticket->subModule->name, 0, 15) . '...' : $ticket->subModule->name}}
                                    @endif
                                </td>
                                <td>
                                    {{ strlen($ticket->subject) >= 60 ? substr($ticket->subject, 0, 50) . '...' : $ticket->subject}}
                                </td>
                                <td>
                                    {{ $ticket->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>
                                    @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_status']) && $permissionData['tickets_all']['tickets']['ticket_status'] == 'ticket_status')
                                        @if($ticket->status == 'Open')
                                            <a href="{{ route('change.ticket.admin.status', $ticket->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm off">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @elseif($ticket->status == 'Closed')
                                            <a href="{{ route('change.ticket.admin.status', $ticket->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm on">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endif
                                    {{$ticket->status}}
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_detail']) && $permissionData['tickets_all']['tickets']['ticket_detail'] == 'ticket_detail')
                                            <a href="{{route('tickets.show', Crypt::encryptString($ticket->id))}}" class="btn all-btn-same">
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
