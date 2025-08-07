<div class="container-fluid" id="ticket-view">
    <div class="row mb-2">

        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom justify-content-between">
                    <h2 class="fw-bolder" style="color: #f8c243;">Ticket</h2>
                    @if($ticket->company_user_id == $company_admin->id)
                        @if($ticket->status == 'Open')
                            @if($ticket->operation_status == 'Closed')
                                <a href="{{ route('change.ticket.status.close', $ticket->id) }}" class="btn all-btn-same mx-1">
                                    Close Ticket
                                </a>
                            @endif
                        @else
                        @endif
                    @endif
                </div>
                <div class="card-body">
                    <div class="border p-3 ">

                        <form class="row g-3" action="">
                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="subject" class="form-label"> Subject <span class="text-danger">*</span> </label>
                                <input class="form-control" type="text" name="subject" id="subject" value="{{ $ticket->subject }}" placeholder="Enter subject" disabled />
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 form-group py-0 my-0">
                                <label for="priority" class="form-label">Priority</label>
                                <input class="form-control" type="text" name="priority" id="priority" value="{{ $ticket->priority }}" placeholder="Choose one priority" disabled />
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0">
                                <label for="module_id" class="form-label"> Module </label>
                                <input class="form-control" type="text" name="module_id" id="module_id" value="{{ $ticket->module->name }}" placeholder="Choose one module" disabled />
                                <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0">
                                <label for="sub_module_id" class="form-label">Sub Module</label>
                                <input class="form-control" type="text" name="sub_module_id" id="sub_module_id" value="{{ $ticket->subModule->name }}" placeholder="Choose one location" disabled />
                                <x-input-error :messages="$errors->get('sub_module_id')" class="" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0">
                                <label for="ticket_nature_id" class="form-label"> Ticket Nature </label>
                                <input class="form-control" type="text" name="ticket_nature_id" id="ticket_nature_id" value="{{ $ticket->ticket_nature->name }}" placeholder="Choose one location" disabled />
                                <x-input-error :messages="$errors->get('ticket_nature_id')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="attachment" class="form-label"> Attachment </label>
                                @if($ticket->attachment)
                                    <a href="{{ asset( $ticket->attachment ) }}" target="_blank">
                                        <img src="{{ asset( $ticket->attachment ) }}" alt="attachment" style="height: 300px; width: auto;" />
                                    </a>
                                @else
                                    <p class="text-danger">No Attachment Found!</p>
                                @endif
                                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="description" class="form-label"> Details </label>
                                @if($ticket->description)
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="15" placeholder="Enter Details" disabled>{{ $ticket->description }}</textarea>
                                @else
                                    <p class="text-danger">No Details Found!</p>
                                @endif
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
