@extends('admin.master')

@section('title')
    Ticket Nature Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('ticket-natures.index') }}">Ticket Natures</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Nature Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create'] == 'ticket_nature_create')
                <div class="">
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Ticket Nature Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_edit']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_edit'] == 'ticket_nature_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editTicketNature" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                            @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_delete']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_delete'] == 'ticket_nature_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('ticket-natures.destroy', $ticket_nature->id )}}" method="post" id="deleteForm{{ $ticket_nature->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $ticket_nature->id }}', 'Are you sure to delete this ticket nature?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Ticket Nature Modal -->
                            <div class="modal fade" id="editTicketNature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTicketNatureLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editTicketNatureLabel" style="color: #FFB400FF;">Edit Ticket Nature</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" method="post" action="{{route('ticket-natures.update', Crypt::encryptString($ticket_nature->id) )}}" >
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="user_id" value="{{ $ticket_nature->user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-12 my-0">
                                                            <label for="name" class="form-label"> Ticket Nature Name </label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{ $ticket_nature->name }}" placeholder="Enter ticket nature name" required />
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
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create_info']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_create_info'] == 'ticket_nature_create_info')
                                    <tr>
                                        <th> Ticket Nature Created At </th>
                                        <td>
                                            {{ $ticket_nature->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Ticket Nature Created By </th>
                                        <td>{{$ticket_nature->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_update_info']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_update_info'] == 'ticket_nature_update_info')
                                    @if($ticket_nature->update_user_id)
                                        <tr>
                                            <th> Ticket Nature Last Updated At </th>
                                            <td>
                                                {{ $ticket_nature->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Ticket Nature Last Update By </th>
                                            <td>{{$ticket_nature->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Ticket Nature Name </th>
                                    <td>{{$ticket_nature->name}}</td>
                                </tr>
                                <tr>
                                    <th> Ticket Nature Status</th>
                                    <td>
                                        {{$ticket_nature->status}}
                                        @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_status']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_status'] == 'ticket_nature_status')
                                            @if($ticket_nature->status == 'Published')
                                                <a href="{{ route('change.ticket.nature.status', $ticket_nature->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @else($ticket_nature->status == 'Draft')
                                                <a href="{{ route('change.ticket.nature.status', $ticket_nature->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
