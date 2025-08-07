<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tickets" aria-expanded="true" aria-controls="tickets">
            <label class="form-check-label" for="tickets">Tickets</label>
        </button>
    </h2>
    <div id="tickets" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="company_users_tickets" value="company_users_tickets" name="permission[company_users_tickets]" />
                <label class="form-check-label" for="company_users_tickets">Tickets All</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="manage_tickets" value="manage_tickets" name="permission[company_users_tickets][manage_tickets]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('manage_tickets', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="manage_tickets">Manage Tickets</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ticket_detail" value="ticket_detail" name="permission[company_users_tickets][ticket_detail]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('ticket_detail', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="ticket_detail">Ticket Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ticket_create" value="ticket_create" name="permission[company_users_tickets][ticket_create]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('ticket_create', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="ticket_create">Ticket Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assign_user_add" value="assign_user_add" name="permission[company_users_tickets][assign_user_add]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('assign_user_add', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="assign_user_add">Assign User</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assign_user_view" value="assign_user_view" name="permission[company_users_tickets][assign_user_view]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('assign_user_view', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="assign_user_view">Assign User View</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assign_user_edit" value="assign_user_edit" name="permission[company_users_tickets][assign_user_edit]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('assign_user_edit', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="assign_user_edit">Assign User Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assign_user_remove" value="assign_user_remove" name="permission[company_users_tickets][assign_user_remove]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('assign_user_remove', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="assign_user_remove">Assign User Remove</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="message_view" value="message_view" name="permission[company_users_tickets][message_view]" data-checkem-parent="permission[company_users_tickets]"
                            {{ (json_decode($company_user->permission) && in_array('message_view', json_decode($company_user->permission, true)['company_users_tickets'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="message_view">Message View</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>




