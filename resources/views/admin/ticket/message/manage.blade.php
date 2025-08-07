@extends('admin.master')

@section('title')
    Ticket Messages
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Ticket Messages</li>
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
                            <th class="fw-bold" style="color: white;"> Message </th>
                            <th class="fw-bold" style="color: white;"> Status </th>
                            <th class="fw-bold" style="color: white;"> View </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($messages->sortByDesc('created_at') as $message)
                            <tr>
                                <td>{{$loop->iteration}}</td>
{{--                                <td>{{$ticket->ticket->company->name}}</td>--}}
                                <td>
                                    {{ $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                </td>
                                <td>
                                    @if($message->ticket_id)
                                        {{$message->ticket->ticket_code}}
                                    @endif
                                </td>
                                <td>
                                    @if($message->ticket_id)
                                        {{$message->ticket->subject}}
                                    @endif
                                </td>
                                <td>
                                    @if($message->message)
                                        {{$message->message}}
                                    @endif
                                        <br>
                                    @if($message->attachment)
                                        <img class="img-fluid" src="{{ asset($message->attachment) }}" alt="message" style="height: 100px; width: auto;" />
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex mt-3 mb-0">
                                        @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_status']) && $permissionData['tickets_all']['messages_all']['message_status'] == 'message_status')
                                            @if($message->status == 'Published')
                                                <a href="{{ route('change.ticket.message.status', $message->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @elseif($message->status == 'Draft')
                                                <a href="{{ route('change.ticket.message.status', $message->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endif
                                        @if($message->status == 'Published')
                                            <p class="text-danger">Published</p>
                                        @elseif($message->status == 'Draft')
                                            <p class="text-green">Draft</p>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6 justify-content-center">
                                        @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_detail']) && $permissionData['tickets_all']['messages_all']['message_detail'] == 'message_detail')
                                            <a href="{{route('ticket-messages.show', Crypt::encryptString($message->id))}}" class="btn all-btn-same">
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
