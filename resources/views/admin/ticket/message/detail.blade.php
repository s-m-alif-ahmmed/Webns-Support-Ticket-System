@extends('admin.master')

@section('title')
    Ticket Message Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('ticket-assigns.index') }}">Ticket Messages</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Message Detail Page</li>
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
                                        <p class="fs-30 fw-bold my-0" style="color: #FFB400FF;">Ticket Message Detail</p>
                                    </div>
                                    <div class="d-flex">
                                        @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_edit']) && $permissionData['tickets_all']['messages_all']['message_edit'] == 'message_edit')
                                            <span class="text-end mx-1">
                                                <button class="btn all-btn-same text-end" data-bs-toggle="modal" data-bs-target="#editMessage" >
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_delete']) && $permissionData['tickets_all']['messages_all']['message_delete'] == 'message_delete')
                                            <span class="text-end mx-1">
                                                <form action="{{ route('ticket-messages.destroy', $message->id )}}" method="post" id="deleteForm{{ $message->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="button" onclick="return deleteAction('{{ $message->id }}', 'Are you sure to delete this message?', 'btn-danger')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Message Modal -->
                            <div class="modal fade" id="editMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMessageLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="editMessageLabel" style="color: #FFB400FF;">Edit Message</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                <div>
                                                    <form class="row g-3" action="{{ route('ticket-messages.update', Crypt::encryptString($message->id)) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="ticket_id" value="{{ $message->ticket_id }}" />
                                                        <input type="hidden" name="create_user_id" value="{{ $message->create_user_id }}" />
                                                        <input type="hidden" name="company_user_id" value="{{ $message->company_user_id }}" />
                                                        <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                        <div class="col-md-12 col-12 py-0 my-0">
                                                            <label for="message" class="form-label"> Message <span class="text-danger">*</span> </label>
                                                            <input class="form-control" type="text" name="message" id="message" value="{{ $message->message }}" placeholder="Enter subject" />
                                                            <x-input-error :messages="$errors->get('subjmessageect')" class="mt-2" />
                                                        </div>

                                                        <div class="col-md-12 col-12 py-0 my-0">
                                                            <label for="attachment" class="form-label"> Attachment <span class="text-danger">*</span> </label>
                                                            <input class="form-control dropify" type="file" name="attachment" id="attachment" value="{{ $message->attachment }}" placeholder="Enter subject" />
                                                            @if($message->attachment)
                                                                <img class="img-fluid my-2" src="{{ asset($message->attachment) }}" alt="attachment" style="height: 100px; width: auto;" />
                                                            @endif
                                                            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
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
                                @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_create_info']) && $permissionData['tickets_all']['assign_all']['assign_create_info'] == 'assign_create_info')
                                    <tr>
                                        <th> Ticket Message Created At </th>
                                        <td>
                                            {{ $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Ticket Message Created By </th>
                                        <td>
                                            @if($message->create_user_id)
                                                {{$message->createdBy->name}} ({{$message->createdBy->employee_id}})
                                            @elseif($message->company_user_id)
                                                {{$message->createdByCompany->name}} ({{$message->createdByCompany->employee_id}})
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_update_info']) && $permissionData['tickets_all']['assign_all']['assign_update_info'] == 'assign_update_info')
                                    @if($message->update_user_id)
                                        <tr>
                                            <th> Ticket Message Last Updated At </th>
                                            <td>
                                                {{ $message->updated_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Ticket Message Last Update By </th>
                                            <td>{{$message->updatedBy->name}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th> Sub Company </th>
                                    <td>{{$message->ticket->subCompany->name}} ({{$message->ticket->location->branch_code}})</td>
                                </tr>
                                <tr>
                                    <th> Ticket ID </th>
                                    <td>{{$message->ticket->ticket_code}}</td>
                                </tr>
                                <tr>
                                    <th> Ticket Subject </th>
                                    <td>{{$message->ticket->subject}}</td>
                                </tr>
                                <tr>
                                    <th> Message </th>
                                    <td>
                                        @if($message->message)
                                            {{$message->message}}
                                        @endif
                                            <br>
                                        @if($message->attachment)
                                            <img class="img-fluid" src="{{ asset( $message->attachment ) }}" alt="attachment" style="height: 100px; width: auto;" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Messaged Status</th>
                                    <td>
                                        {{$message->status}}
                                        @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_status']) && $permissionData['tickets_all']['messages_all']['message_status'] == 'message_status')
                                            @if($message->status == 'Published')
                                                <a href="{{ route('change.ticket.message.status', $message->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn all-btn-same btn-sm ms-2">Change</a>
                                            @elseif($message->status == 'Draft')
                                                <a href="{{ route('change.ticket.message.status', $message->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')"  class="btn btn-danger btn-sm ms-2">Change</a>
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
