<div class="container-fluid" id="ticket-view">
    <div class="row mb-5 pb-5">

{{--                        <div class="col-md-12">--}}
{{--                            <div id="data-container">--}}
{{--                                <!-- Data will be loaded here -->--}}
{{--                            </div>--}}

{{--                            <script>--}}
{{--                                function fetchData() {--}}
{{--                                    fetch('{{ route('fetch.data') }}')--}}
{{--                                        .then(response => response.json())--}}
{{--                                        .then(data => {--}}
{{--                                            let htmlContent = '';--}}
{{--                                            data.forEach(item => {--}}
{{--                                                htmlContent += `<p>${item.subject}</p>`; // Adjust to your data fields--}}
{{--                                            });--}}
{{--                                            document.getElementById('data-container').innerHTML = htmlContent;--}}
{{--                                        });--}}
{{--                                }--}}

{{--                                setInterval(fetchData, 1000); // Fetch data every second--}}
{{--                                window.onload = fetchData; // Load data on page load--}}
{{--                            </script>--}}

{{--                        </div>--}}

        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom justify-content-between">
                    <h2 class="fw-bolder" style="color: #f8c243;">Ticket</h2>
                    <div class="d-flex">
                        @php
                            $userAssignment = $ticket_assigns->firstWhere('assign_user_id', Auth::user()->id);
                            $solverAssignment = $ticket_assigns->firstWhere('work_role', 'Solver');
                            $supervisorAssignment = $ticket_assigns->firstWhere('work_role', 'Supervisor');
                            $coordinatorAssignment = $ticket_assigns->firstWhere('work_role', 'Coordinator');
                        @endphp
                        @if($userAssignment)
                            @if($userAssignment->work_role === 'Solver' && $userAssignment->assign_status === 'Pending')
                                <a href="{{ route('change.ticket.assign.work.status', $userAssignment->id) }}" class="btn all-btn-same mx-1">
                                    Close Ticket
                                </a>
                            @elseif($userAssignment->work_role === 'Supervisor' && $solverAssignment && $solverAssignment->assign_status === 'Complete' && $userAssignment->assign_status === 'Pending')
                                <a href="{{ route('change.ticket.assign.work.status', $userAssignment->id) }}" class="btn all-btn-same mx-1">
                                    Close Ticket
                                </a>
                            @elseif($userAssignment->work_role === 'Coordinator' && $supervisorAssignment && $supervisorAssignment->assign_status === 'Complete' && $userAssignment->assign_status === 'Pending')
                                <a href="{{ route('change.ticket.assign.work.status', $userAssignment->id) }}" class="btn all-btn-same mx-1">
                                    Close Ticket
                                </a>
                            @endif
                        @endif
                        @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_status']) && $permissionData['tickets_all']['tickets']['ticket_status'] == 'ticket_status')
                            @if($ticket->operation_status == 'Open')
                                <a href="{{ route('change.ticket.operation.status', $ticket->id) }}" class="btn all-btn-same mx-1">
                                    Operation Close Ticket
                                </a>
                            @else
                            @endif
                        @endif
                        @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_edit']) && $permissionData['tickets_all']['tickets']['ticket_edit'] == 'ticket_edit')
                            @if($ticket->status == 'Open')
                                <button class="btn all-btn-same mx-1" id="ticket-edit-btn">
                                    Edit
                                </button>
                            @else
                            @endif
                        @endif
                        @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_delete']) && $permissionData['tickets_all']['tickets']['ticket_delete'] == 'ticket_delete')
                            <form action="{{ route('tickets.destroy', $ticket->id )}}" method="post" id="deleteForm{{ $ticket->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn all-btn-same mx-1" type="button" onclick="return deleteAction('{{ $ticket->id }}', 'Are you sure to delete this ticket?', 'btn-danger')">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>

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
                                <label for="company_id" class="form-label"> Company </label>
                                <input class="form-control" type="text" name="company_id" id="company_id" value="{{ $ticket->company->name }}" placeholder="Choose one company" disabled />
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0">
                                <label for="sub_company_id" class="form-label">Sub Company</label>
                                <input class="form-control" type="text" name="sub_company_id" id="sub_company_id" value="{{ $ticket->subCompany->name }}" placeholder="Choose one sub company" disabled />
                                <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0">
                                <label for="location_id" class="form-label">Location</label>
                                <input class="form-control" type="text" name="location_id" id="location_id" value="{{ $ticket->location->branch_code }}" placeholder="Choose one location" disabled />
                                <x-input-error :messages="$errors->get('location_id')" class="" />
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
                                    <img src="{{ asset( $ticket->attachment ) }}" alt="attachment" style="height: 300px; width: auto;" />
                                    <br>
                                    <a class="btn btn-sm all-btn-same float-end" href="{{ asset( $ticket->attachment ) }}" download="">
                                        Download
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
