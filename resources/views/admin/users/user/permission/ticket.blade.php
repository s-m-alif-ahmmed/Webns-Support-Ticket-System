<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#tickets" aria-expanded="true" aria-controls="tickets">
            <label class="form-check-label" for="tickets">
                Ticket Permission
            </label>
        </button>
    </h2>
    <div id="tickets" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="row ms-1">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" id="tickets_all" value="tickets_all" name="permission[tickets_all]" />
                    <label class="form-check-label" for="tickets_all">Ticket Full Permission</label>
                </div>
            </div>

            <div class="row mx-1">
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tickets" value="tickets" name="permission[tickets_all][tickets]" data-checkem-parent="permission[tickets_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['tickets_all'] ?? [] ? 'checked' : '') && in_array('tickets', json_decode($user->permission, true)['tickets_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="tickets">Tickets All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_manage" value="ticket_manage" name="permission[tickets_all][tickets][ticket_manage]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_manage', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_view" value="ticket_view" name="permission[tickets_all][tickets][ticket_view]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_view', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_view"> View</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_detail" value="ticket_detail" name="permission[tickets_all][tickets][ticket_detail]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_detail', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_create" value="ticket_create" name="permission[tickets_all][tickets][ticket_create]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_create', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_edit" value="ticket_edit" name="permission[tickets_all][tickets][ticket_edit]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_edit', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_create_info" value="ticket_create_info" name="permission[tickets_all][tickets][ticket_create_info]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_create_info', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_update_info" value="ticket_update_info" name="permission[tickets_all][tickets][ticket_update_info]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_update_info', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_status" value="ticket_status" name="permission[tickets_all][tickets][ticket_status]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_status', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_status"> Close Ticket</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_delete" value="ticket_delete" name="permission[tickets_all][tickets][ticket_delete]" data-checkem-parent="permission[tickets_all][tickets]"
                                        {{ (json_decode($user->permission) && in_array('ticket_delete', json_decode($user->permission, true)['tickets_all']['tickets'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="assign_all" value="assign_all" name="permission[tickets_all][assign_all]" data-checkem-parent="permission[tickets_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['tickets_all'] ?? [] ? 'checked' : '') && in_array('assign_all', json_decode($user->permission, true)['tickets_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="assign_all">Assign Permission</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_manage" value="assign_manage" name="permission[tickets_all][assign_all][assign_manage]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_manage', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_manage">Manage</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_view" value="assign_view" name="permission[tickets_all][assign_all][assign_view]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_view', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_view"> View</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_detail" value="assign_detail" name="permission[tickets_all][assign_all][assign_detail]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_detail', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_create" value="assign_create" name="permission[tickets_all][assign_all][assign_create]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_create', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_create"> Add</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_edit" value="assign_edit" name="permission[tickets_all][assign_all][assign_edit]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_edit', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_create_info" value="assign_create_info" name="permission[tickets_all][assign_all][assign_create_info]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_create_info', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_create_info">Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_update_info" value="assign_update_info" name="permission[tickets_all][assign_all][assign_update_info]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_update_info', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_work_status" value="assign_work_status" name="permission[tickets_all][assign_all][assign_work_status]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_work_status', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_work_status"> Work Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_status" value="assign_status" name="permission[tickets_all][assign_all][assign_status]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_status', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assign_delete" value="assign_delete" name="permission[tickets_all][assign_all][assign_delete]" data-checkem-parent="permission[tickets_all][assign_all]"
                                        {{ (json_decode($user->permission) && in_array('assign_delete', json_decode($user->permission, true)['tickets_all']['assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="assign_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="company_user_assign_all" value="company_user_assign_all" name="permission[tickets_all][company_user_assign_all]" data-checkem-parent="permission[tickets_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['tickets_all'] ?? [] ? 'checked' : '') && in_array('company_user_assign_all', json_decode($user->permission, true)['tickets_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="company_user_assign_all">Company User Assign Permission</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_manage" value="company_user_assign_manage" name="permission[tickets_all][company_user_assign_all][company_user_assign_manage]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_manage', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_view" value="company_user_assign_view" name="permission[tickets_all][company_user_assign_all][company_user_assign_view]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_view', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_view"> View</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_detail" value="company_user_assign_detail" name="permission[tickets_all][company_user_assign_all][company_user_assign_detail]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_detail', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_create" value="company_user_assign_create" name="permission[tickets_all][company_user_assign_all][company_user_assign_create]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_create', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_create"> Add</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_edit" value="company_user_assign_edit" name="permission[tickets_all][company_user_assign_all][company_user_assign_edit]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_edit', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_create_info" value="company_user_assign_create_info" name="permission[tickets_all][company_user_assign_all][company_user_assign_create_info]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_create_info', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_update_info" value="company_user_assign_update_info" name="permission[tickets_all][company_user_assign_all][company_user_assign_update_info]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_update_info', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_work_status" value="company_user_assign_work_status" name="permission[tickets_all][company_user_assign_all][company_user_assign_work_status]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_work_status', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_work_status"> Work Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_status" value="company_user_assign_status" name="permission[tickets_all][company_user_assign_all][company_user_assign_status]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_status', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_assign_delete" value="company_user_assign_delete" name="permission[tickets_all][company_user_assign_all][company_user_assign_delete]" data-checkem-parent="permission[tickets_all][company_user_assign_all]"
                                        {{ (json_decode($user->permission) && in_array('company_user_assign_delete', json_decode($user->permission, true)['tickets_all']['company_user_assign_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_assign_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="messages_all" value="messages_all" name="permission[tickets_all][messages_all]" data-checkem-parent="permission[tickets_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['tickets_all'] ?? [] ? 'checked' : '') && in_array('messages_all', json_decode($user->permission, true)['tickets_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="messages_all">Messages Permission</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_manage" value="message_manage" name="permission[tickets_all][messages_all][message_manage]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_manage', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_manage"> Message</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_view" value="message_view" name="permission[tickets_all][messages_all][message_view]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_view', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_view"> View</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_detail" value="message_detail" name="permission[tickets_all][messages_all][message_detail]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_detail', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_create" value="message_create" name="permission[tickets_all][messages_all][message_create]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_create', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_create"> Sent</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_edit" value="message_edit" name="permission[tickets_all][messages_all][message_edit]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_edit', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_create_info" value="message_create_info" name="permission[tickets_all][messages_all][message_create_info]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_create_info', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_update_info" value="message_update_info" name="permission[tickets_all][messages_all][message_update_info]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_update_info', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_status" value="message_status" name="permission[tickets_all][messages_all][message_status]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_status', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="message_delete" value="message_delete" name="permission[tickets_all][messages_all][message_delete]" data-checkem-parent="permission[tickets_all][messages_all]"
                                        {{ (json_decode($user->permission) && in_array('message_delete', json_decode($user->permission, true)['tickets_all']['messages_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="message_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>

