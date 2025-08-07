@extends('admin.master')

@section('title')
    Ticket Natures
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Ticket Natures</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create'] == 'ticket_nature_create')
                <div class="mx-1">
                    <button class="btn all-btn-same rounded-3" data-bs-toggle="modal" data-bs-target="#createTicketNature" >Create Ticket Nature</button>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        <!-- Create Ticket Nature Modal -->
        <div class="modal fade" id="createTicketNature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTicketNatureLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 m-0 pb-0 pt-5">
                        <p class="fs-20 fw-bold" id="createTicketNatureLabel" style="color: #FFB400FF;">Create Ticket Nature</p>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body m-0 pt-0">
                        <div class="form-horizontal pt-0 mt-0">

                            <div>
                                <form class="row g-3" action="{{ route('ticket-natures.store') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="col-12">
                                        <label for="name" class="form-label"> Ticket Nature Name </label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter ticket nature name" required />
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
                            <th class="fw-bold" style="color: white;"> Ticket Nature Name </th>
                            <th class="fw-bold" style="color: white;"> Ticket Nature Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($ticket_natures as $ticket_nature)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ticket_nature->name}}</td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_status']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_status'] == 'ticket_nature_status')

                                            @if($ticket_nature->status == 'Published')
                                                <a href="{{ route('change.ticket.nature.status', $ticket_nature->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else($ticket_nature->status == 'Draft')
                                                <a href="{{ route('change.ticket.nature.status', $ticket_nature->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            @if($ticket_nature->status == 'Published')
                                                <p class="text-danger">Published</p>
                                            @elseif($ticket_nature->status == 'Draft')
                                                <p class="text-green">Draft</p>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_detail']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_detail'] == 'ticket_nature_detail')
                                            <a href="{{route('ticket-natures.show', Crypt::encryptString($ticket_nature->id))}}" class="btn all-btn-same">
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
