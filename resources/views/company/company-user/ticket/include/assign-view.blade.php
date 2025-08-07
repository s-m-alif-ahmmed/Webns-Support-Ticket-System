<div class="container-fluid" id="assign-view">
    <!--ROW OPENED-->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom justify-content-between">
                    <h2 class="fw-bolder" style="color: #f8c243;">Assigned </h2>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table border-bottom w-100" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Assign To
                                    </th>
                                    <th>
                                        Assign Role
                                    </th>
                                    <th>
                                        Approx. End Date & Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ticket_assigns as $ticket_assign)
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" value="{{ $ticket_assign->assignUser->name }} ({{ $ticket_assign->assignUser->employee_id }})" disabled />
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" value="{{ $ticket_assign->work_role }}" disabled />
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($ticket_assign->approx_end_time)->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}" disabled />
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--ROW CLOSED-->
</div>

