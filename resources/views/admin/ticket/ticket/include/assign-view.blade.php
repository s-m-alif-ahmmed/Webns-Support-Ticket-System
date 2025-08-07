<div class="container-fluid" id="assign-view">
    <!--ROW OPENED-->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom justify-content-between">
                    <h2 class="fw-bolder" style="color: #f8c243;">Assign</h2>
                    @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_create']) && $permissionData['tickets_all']['assign_all']['assign_create'] == 'assign_create')
                        @if($ticket->status == 'Open')
                            <button class="btn all-btn-same mx-1" id="assign-create-btn">
                                Add
                            </button>
                        @else
                        @endif
                    @endif
                </div>

                <div class="card-body p-0">
                    <p class="text-success text-center pt-2 pb-0 mb-0" id="assign-message" style="display: none;"></p>
                    <div class="row p-5">
                        <div class="col-md-4 name-header">
                            <p class="ps-3">
                                Assign To
                            </p>
                        </div>
                        <div class="col-md-4 name-header">
                            <p>
                                Assign Role
                            </p>
                        </div>
                        <div class="col-md-4 name-header">
                            <p>
                                Approx. End Date & Time
                            </p>
                        </div>

                        <style>
                            .name-header {
                                @media screen and (max-width: 993px) {
                                    display: none;
                                }
                            }
                        </style>

                        <div class="col-xl-12 pt-0 mt-0">
                            <div class="product-description-list">
                                <div class="table-responsive product-description-each" style="overflow: hidden;">
                                    <div class="invoice-product-table">
                                        @foreach($ticket_assigns as $ticket_assign)
                                            <div class="row border-bottom pb-3 mb-3" id="viewRow{{ $ticket_assign->id }}" style="overflow: hidden;">

                                                <div class="col-md-4 col-12 my-1">
                                                    <input id="viewUser{{ $ticket_assign->id }}" class="form-control" type="text" value="{{ $ticket_assign->assignUser->name }} ({{ $ticket_assign->assignUser->employee_id }})" disabled />
                                                </div>
                                                <div class="col-md-4 col-12 my-1">
                                                    <input id="viewRole{{ $ticket_assign->id }}" class="form-control" type="text" value="{{ $ticket_assign->work_role }}" disabled />
                                                </div>
                                                @if($ticket_assign->updated_approx_end_time)
                                                    <div class="col-md-3 col-12 my-1">
                                                        <input id="viewEndTime{{ $ticket_assign->id }}" class="form-control" type="text" value="{{ $ticket_assign->updated_approx_end_time }}" disabled />
                                                    </div>
                                                @else
                                                    <div class="col-md-3 col-12 my-1">
                                                        <input id="viewEndTime{{ $ticket_assign->id }}" class="form-control" type="text" value="{{ $ticket_assign->approx_end_time }}" disabled />
                                                    </div>
                                                @endif

                                                <div class="col-md-1 col-12 my-1">
                                                    <div class="d-flex justify-content-between">
                                                        @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_delete']) && $permissionData['tickets_all']['assign_all']['assign_delete'] == 'assign_delete')
                                                            @if($ticket->status == 'Open')
                                                                <form action="{{ route('ticket-assigns.destroy', $ticket_assign->id )}}" method="post" id="deleteForm{{ $ticket_assign->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-danger border-0 p-0 m-0" type="button" onclick="return deleteAction('{{ $ticket_assign->id }}', 'Are you sure to delete this assign employee?', 'btn-danger')">
                                                                        <i class="fa fa-times fs-20 text-muted text-center delete-row-btn" style="margin: 7px 0 0 0;"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                            @endif
                                                        @endif
                                                        @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_edit']) && $permissionData['tickets_all']['assign_all']['assign_edit'] == 'assign_edit')
                                                            @if($ticket->status == 'Open')
                                                                <button class="btn all-btn-same" style="height: 32px;" onclick="toggleEdit('{{ $ticket_assign->id }}')">
                                                                    Edit
                                                                </button>
                                                            @else
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <form id="editForm{{ $ticket_assign->id }}" class="d-none" action="{{ route('ticket-assigns.update', $ticket_assign->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                                                <input type="hidden" name="create_user_id" value="{{ $ticket_assign->create_user_id }}" />
                                                <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                                <div class="row border-bottom pb-3 mb-3" style="overflow: hidden;">
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group px-1 py-1 my-0" style="overflow: hidden;">
                                                            <select class="form-control select2-show-search form-select" name="assign_user_id" data-placeholder="Choose one employee" required>
                                                                <option value="{{ $ticket_assign->assign_user_id }}" selected>{{ $ticket_assign->assignUser->name }} ({{ $ticket_assign->assignUser->employee_id }})</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $user->id == $ticket_assign->assign_user_id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->employee_id }})</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('assign_user_id')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group px-1 py-1 my-0" style="overflow: hidden;">
                                                            <select class="form-control select2-show-search form-select" name="work_role" data-placeholder="Choose one role" required>
                                                                <option value="{{ $ticket_assign->work_role }}" selected>{{ $ticket_assign->work_role }}</option>
                                                                <option value="Coordinator">Coordinator</option>
                                                                <option value="Supervisor">Supervisor</option>
                                                                <option value="Solver">Solver</option>
                                                            </select>
                                                            <x-input-error :messages="$errors->get('work_role')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input class="form-control" name="updated_approx_end_time" type="datetime-local" value="{{ $ticket_assign->updated_approx_end_time }}" placeholder="2024-08-01 12:00">
                                                        <x-input-error :messages="$errors->get('updated_approx_end_time')" class="mt-2" />
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="d-flex">
                                                            <button type="button" class="btn all-btn-same" style="height: 32px;" onclick="updateTicketAssign('{{ $ticket_assign->id }}')">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--ROW CLOSED-->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function toggleEdit(id) {
        var editForm = document.getElementById('editForm' + id);
        var viewRow = document.getElementById('viewRow' + id);
        if (editForm.classList.contains('d-none')) {
            editForm.classList.remove('d-none');
            viewRow.classList.add('d-none');
        } else {
            editForm.classList.add('d-none');
            viewRow.classList.remove('d-none');
        }
    }

    function updateTicketAssign(id) {
        var form = $('#editForm' + id);
        var formData = form.serialize(); // Serialize the form data

        $.ajax({
            url: form.attr('action'), // Form action URL
            method: 'POST', // Use POST method
            data: formData, // Serialized form data
            success: function(response) {
                // Update the view row with new data
                var updatedRow = `
                    <div class="col-md-4 col-12">
                        <input class="form-control" type="text" value="${response.assignUser} (${response.employeeId})" disabled />
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" value="${response.workRole}" disabled />
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" value="${response.endTime}" disabled />
                    </div>
                    <div class="col-md-1">
                        <div class="d-flex">
                            <form action="${response.deleteUrl}" method="post" id="deleteForm${id}">
                                @csrf
                @method('DELETE')
                <button class="text-danger border-0 p-0 m-0" type="button" onclick="return deleteAction('${id}', 'Are you sure to delete this assign employee?', 'btn-danger')">
                                    <i class="fa fa-times fs-20 text-muted text-center delete-row-btn" style="margin: 7px 0 0 0;"></i>
                                </button>
                            </form>
                            <button class="btn all-btn-same" style="height: 32px;" onclick="toggleEdit('${id}')">
                                Edit
                            </button>
                        </div>
                    </div>
                `;
                $('#viewRow' + id).html(updatedRow);

                // Display a success message
                $("#assign-message").html("Assign updated successfully.").show();
                setTimeout(function() {
                    $("#assign-message").fadeOut();
                }, 3000); // Hide after 3 seconds

                // Toggle visibility to show the updated view row
                toggleEdit(id);
            },
            error: function(xhr) {
                // Display an error message if the update fails
                $("#assign-message").html("Assign not updated!").show();
                setTimeout(function() {
                    $("#assign-message").fadeOut();
                }, 3000); // Hide after 3 seconds
            }
        });
    }

</script>
