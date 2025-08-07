@extends('admin.master')

@section('title')
    Ticket Company User Assign Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('ticket-company-assigns.index') }}">Ticket Company User Assigns</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Company User Assign Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Ticket Company User Assign Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_delete']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_delete'] == 'company_user_assign_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('ticket-company-assigns.destroy', $company_ticket_assign->id )}}" method="post" id="deleteForm{{ $company_ticket_assign->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $company_ticket_assign->id }}', 'Are you sure to delete this ticket company user assign?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_create_info']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_create_info'] == 'company_user_assign_create_info')
                                    <tr>
                                        <th> Ticket Assign Created At </th>
                                        <td>
                                            {{ $company_ticket_assign->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Ticket Assign Created By </th>
                                        <td>
                                            @if($company_ticket_assign->create_user_id)
                                                {{$company_ticket_assign->createdBy->name}} ({{ $company_ticket_assign->createdBy->employee_id }})
                                            @elseif($company_ticket_assign->company_user_id)
                                                {{$company_ticket_assign->createdByCompany->name}} ({{ $company_ticket_assign->createdByCompany->employee_id }})
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_update_info']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_update_info'] == 'company_user_assign_update_info')
                                    @if($company_ticket_assign->updated_at)
                                        <tr>
                                            <th> Ticket Assign Last Updated At </th>
                                            <td>
                                                {{ $company_ticket_assign->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($company_ticket_assign->update_user_id)
                                        <tr>
                                            <th> Ticket Assign Last Update By </th>
                                            <td>
                                                {{$company_ticket_assign->updatedBy->name}} ({{ $company_ticket_assign->updatedBy->employee_id }})
                                            </td>
                                        </tr>
                                    @endif
                                    @if($company_ticket_assign->update_company_user_id)
                                        <tr>
                                            <th> Ticket Assign Last Update By </th>
                                            <td>
                                                {{$company_ticket_assign->updatedByCompany->name}} ({{ $company_ticket_assign->updatedByCompany->employee_id }})
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Sub Company </th>
                                    <td>{{$company_ticket_assign->ticket->company->name}} ({{$company_ticket_assign->ticket->location->branch_code}})</td>
                                </tr>
                                <tr>
                                    <th> Ticket ID </th>
                                    <td>{{$company_ticket_assign->ticket->ticket_code}}</td>
                                </tr>
                                <tr>
                                    <th> Ticket Subject </th>
                                    <td>{{$company_ticket_assign->ticket->subject}}</td>
                                </tr>
                                <tr>
                                    <th> Assigned Employee Name </th>
                                    <td>{{$company_ticket_assign->assignCompanyUser->name}} ({{$company_ticket_assign->assignCompanyUser->employee_id}})</td>
                                </tr>
                                <tr>
                                    <th> Assigned Employee Working Role </th>
                                    <td>{{$company_ticket_assign->work_role}}</td>
                                </tr>
                                <tr>
                                    <th> Assigned Status</th>
                                    <td>
                                        {{$company_ticket_assign->status}}
                                        @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_status']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_status'] == 'company_user_assign_status')
                                            @if($company_ticket_assign->status == 'On')
                                                <a href="{{ route('change.ticket.company.assign.status', $company_ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @elseif($company_ticket_assign->status == 'Off')
                                                <a href="{{ route('change.ticket.company.assign.status', $company_ticket_assign->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger btn-sm ms-2">Change</a>
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
