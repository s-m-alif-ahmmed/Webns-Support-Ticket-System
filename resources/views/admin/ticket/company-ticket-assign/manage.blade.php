@extends('admin.master')

@section('title')
    Ticket Company User Assigns
@endsection

@section('content')

    <section class="py-5" style="margin-bottom: 100px;">
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Ticket Company User Assigns</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

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
                            <th class="fw-bold" style="color: white;"> SL </th>
                            <th class="fw-bold" style="color: white;"> Created At </th>
                            <th class="fw-bold" style="color: white;"> Ticket ID </th>
                            <th class="fw-bold" style="color: white;"> Ticket Subject </th>
                            <th class="fw-bold" style="color: white;"> Assign Employee </th>
                            <th class="fw-bold" style="color: white;"> Assign Role </th>
{{--                            <th class="fw-bold" style="color: white;"> Status </th>--}}
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($company_ticket_assigns->sortByDesc('created_at') as $ticket_assign)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ $ticket_assign->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>
                                    @if($ticket_assign->ticket_id)
                                        {{$ticket_assign->ticket->ticket_code}}
                                    @endif
                                </td>
                                <td>
                                    @if($ticket_assign->ticket_id)
                                        {{$ticket_assign->ticket->subject}}
                                    @endif
                                </td>
                                <td>
                                    @if($ticket_assign->assign_user_id)
                                        {{$ticket_assign->assignCompanyUser->name}} ( {{$ticket_assign->assignCompanyUser->employee_id}} )
                                    @endif
                                </td>
                                <td>
                                    @if($ticket_assign->work_role)
                                        {{$ticket_assign->work_role}}
                                    @endif
                                </td>
{{--                                <td>--}}
{{--                                    @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_work_status']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_work_status'] == 'company_user_assign_work_status')--}}
{{--                                        @if($ticket_assign->assign_status == 'Complete')--}}
{{--                                            <a href="{{ route('change.ticket.assign.work.status', $ticket_assign->id) }}">--}}
{{--                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                    <div class="toggle toggle-warning toggle-sm on">--}}
{{--                                                        <span></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        @elseif($ticket_assign->assign_status == 'Pending')--}}
{{--                                            <a href="{{ route('change.ticket.assign.work.status', $ticket_assign->id) }}">--}}
{{--                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                    <div class="toggle toggle-warning toggle-sm off">--}}
{{--                                                        <span></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                    {{$ticket_assign->assign_status}}--}}
{{--                                </td>--}}
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_detail']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_detail'] == 'company_user_assign_detail')
                                            <a href="{{route('ticket-company-assigns.show', Crypt::encryptString($ticket_assign->id))}}" class="btn all-btn-same">
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
