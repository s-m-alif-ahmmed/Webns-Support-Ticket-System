@extends('admin.master')

@section('title')
    Ticket Assign Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('ticket-assigns.index') }}">Ticket Assigns</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Assign Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        {{-- message--}}
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Ticket Assign Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_delete']) && $permissionData['tickets_all']['assign_all']['assign_delete'] == 'assign_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('ticket-natures.destroy', $ticket_assign->id )}}" method="post" id="deleteForm{{ $ticket_assign->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $ticket_assign->id }}', 'Are you sure to delete this ticket assign?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_create_info']) && $permissionData['tickets_all']['assign_all']['assign_create_info'] == 'assign_create_info')
                                    <tr>
                                        <th> Ticket Assign Created At </th>
                                        <td>
                                            {{ $ticket_assign->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Ticket Assign Created By </th>
                                        <td>{{$ticket_assign->createdBy->name}}</td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_update_info']) && $permissionData['tickets_all']['assign_all']['assign_update_info'] == 'assign_update_info')
                                    @if($ticket_assign->update_user_id)
                                        <tr>
                                            <th> Ticket Assign Last Updated At </th>
                                            <td>
                                                {{ $ticket_assign->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Ticket Assign Last Update By </th>
                                            <td>{{$ticket_assign->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Sub Company </th>
                                    <td>{{$ticket_assign->ticket->company->name}} ({{$ticket_assign->ticket->location->branch_code}})</td>
                                </tr>
                                <tr>
                                    <th> Ticket ID </th>
                                    <td>{{$ticket_assign->ticket->ticket_code}}</td>
                                </tr>
                                <tr>
                                    <th> Ticket Subject </th>
                                    <td>{{$ticket_assign->ticket->subject}}</td>
                                </tr>
                                <tr>
                                    <th> Assigned Employee Name </th>
                                    <td>{{$ticket_assign->assignUser->name}} ({{$ticket_assign->assignUser->employee_id}})</td>
                                </tr>
                                <tr>
                                    <th> Assigned Employee Working Role </th>
                                    <td>{{$ticket_assign->work_role}}</td>
                                </tr>
                                <tr>
                                    <th> Approx. End Time </th>
                                    <td>{{ \Carbon\Carbon::parse($ticket_assign->approx_end_time)->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> Assigned Work Status</th>
                                    <td>
                                        {{$ticket_assign->assign_status}}
                                        @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_work_status']) && $permissionData['tickets_all']['assign_all']['assign_work_status'] == 'assign_work_status')
                                            @if($ticket_assign->assign_status == 'Complete')
                                                <a href="{{ route('change.ticket.assign.work.status', $ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @elseif($ticket_assign->assign_status == 'Pending')
                                                <a href="{{ route('change.ticket.assign.work.status', $ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Assigned Status</th>
                                    <td>
                                        {{$ticket_assign->status}}
                                        @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_status']) && $permissionData['tickets_all']['assign_all']['assign_status'] == 'assign_status')
                                            @if($ticket_assign->status == 'On')
                                                <a href="{{ route('change.ticket.assign.status', $ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @elseif($ticket_assign->status == 'Off')
                                                <a href="{{ route('change.ticket.assign.status', $ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
