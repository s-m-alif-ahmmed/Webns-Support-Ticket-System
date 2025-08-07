@extends('company.master')

@section('title')
    Tickets
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('company.dashboard') }}">Dashboard</a>
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
                            <th class="fw-bold" style="color: white; width: 2%;"> SL </th>
                            <th class="fw-bold" style="color: white; width: 2%;"> Ticket ID </th>
                            <th class="fw-bold" style="color: white; width: 5%;"> Priority </th>
                            <th class="fw-bold" style="color: white; width: 5%;"> Ticket Nature </th>
                            <th class="fw-bold" style="color: white; width: 15%;"> Sub Company </th>
                            <th class="fw-bold" style="color: white; width: 5%;"> Module</th>
                            <th class="fw-bold" style="color: white; width: 5%;"> Sub Module </th>
                            <th class="fw-bold" style="color: white; width: 45%;"> Subject </th>
                            <th class="fw-bold" style="color: white; width: 8%;"> Date </th>
                            <th class="fw-bold" style="color: white; width: 5%;"> Status </th>
                            <th class="fw-bold" style="color: white; width: 5%;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                            @if($company_admin->role == 'Admin')
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
                                            {{$ticket->status}}
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                @if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['ticket_detail']) && $companyPermissionData['company_users_tickets']['ticket_detail'] == 'ticket_detail')
                                                    <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                <a href="{{route('user.show.ticket', Crypt::encryptString($ticket->id))}}" class="btn all-btn-same mx-1">
                                                    View
                                                </a>
                                            </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
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
                                            {{$ticket->status}}
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                @if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['ticket_detail']) && $companyPermissionData['company_users_tickets']['ticket_detail'] == 'ticket_detail')
                                                    <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                <a href="{{route('user.show.ticket', Crypt::encryptString($ticket->id))}}" class="btn all-btn-same mx-1">
                                                    View
                                                </a>
                                            </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
