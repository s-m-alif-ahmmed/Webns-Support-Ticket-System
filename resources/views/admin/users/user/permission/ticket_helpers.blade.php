<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#ticket_helpers" aria-expanded="true" aria-controls="ticket_helpers">
            <label class="form-check-label" for="ticket_helpers">
                Ticket Settings
            </label>
        </button>
    </h2>
    <div id="ticket_helpers" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="row ms-1">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" id="ticket_helpers_all" value="ticket_helpers_all" name="permission[ticket_helpers_all]" />
                    <label class="form-check-label" for="ticket_helpers_all"> Settings All</label>
                </div>
            </div>

            <div class="row mx-1">
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="module_all" value="module_all" name="permission[ticket_helpers_all][module_all]" data-checkem-parent="permission[ticket_helpers_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['ticket_helpers_all'] ?? [] ? 'checked' : '') && in_array('module_all', json_decode($user->permission, true)['ticket_helpers_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="module_all">Modules All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_manage" value="module_manage" name="permission[ticket_helpers_all][module_all][module_manage]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_manage', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_detail" value="module_detail" name="permission[ticket_helpers_all][module_all][module_detail]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_detail', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_create" value="module_create" name="permission[ticket_helpers_all][module_all][module_create]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_create', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_edit" value="module_edit" name="permission[ticket_helpers_all][module_all][module_edit]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_edit', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_create_info" value="module_create_info" name="permission[ticket_helpers_all][module_all][module_create_info]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_create_info', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_update_info" value="module_update_info" name="permission[ticket_helpers_all][module_all][module_update_info]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_update_info', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_status" value="module_status" name="permission[ticket_helpers_all][module_all][module_status]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_status', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="module_delete" value="module_delete" name="permission[ticket_helpers_all][module_all][module_delete]" data-checkem-parent="permission[ticket_helpers_all][module_all]"
                                        {{ (json_decode($user->permission) && in_array('module_delete', json_decode($user->permission, true)['ticket_helpers_all']['module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="module_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sub_module_all" value="sub_module_all" name="permission[ticket_helpers_all][sub_module_all]" data-checkem-parent="permission[ticket_helpers_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['ticket_helpers_all'] ?? [] ? 'checked' : '') && in_array('sub_module_all', json_decode($user->permission, true)['ticket_helpers_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="sub_module_all">Sub Modules All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_manage" value="sub_module_manage" name="permission[ticket_helpers_all][sub_module_all][sub_module_manage]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_manage', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_manage">Manage</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_detail" value="sub_module_detail" name="permission[ticket_helpers_all][sub_module_all][sub_module_detail]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_detail', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_create" value="sub_module_create" name="permission[ticket_helpers_all][sub_module_all][sub_module_create]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_create', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_edit" value="sub_module_edit" name="permission[ticket_helpers_all][sub_module_all][sub_module_edit]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_edit', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_edit">edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_create_info" value="sub_module_create_info" name="permission[ticket_helpers_all][sub_module_all][sub_module_create_info]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_create_info', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_create_info">Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_update_info" value="sub_module_update_info" name="permission[ticket_helpers_all][sub_module_all][sub_module_update_info]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_update_info', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_update_info">Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_status" value="sub_module_status" name="permission[ticket_helpers_all][sub_module_all][sub_module_status]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_status', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_status">Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_module_delete" value="sub_module_delete" name="permission[ticket_helpers_all][sub_module_all][sub_module_delete]" data-checkem-parent="permission[ticket_helpers_all][sub_module_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_module_delete', json_decode($user->permission, true)['ticket_helpers_all']['sub_module_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_module_delete">Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ticket_nature_all" value="ticket_nature_all" name="permission[ticket_helpers_all][ticket_nature_all]" data-checkem-parent="permission[ticket_helpers_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['ticket_helpers_all'] ?? [] ? 'checked' : '') && in_array('ticket_nature_all', json_decode($user->permission, true)['ticket_helpers_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="ticket_nature_all">Ticket Nature All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_manage" value="ticket_nature_manage" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_manage]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_manage', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_detail" value="ticket_nature_detail" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_detail]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_detail', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_create" value="ticket_nature_create" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_create]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_create', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_edit" value="ticket_nature_edit" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_edit]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_edit', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_create_info" value="ticket_nature_create_info" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_create_info]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_create_info', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_update_info" value="ticket_nature_update_info" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_update_info]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_update_info', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_status" value="ticket_nature_status" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_status]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_status', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_status">Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ticket_nature_delete" value="ticket_nature_delete" name="permission[ticket_helpers_all][ticket_nature_all][ticket_nature_delete]" data-checkem-parent="permission[ticket_helpers_all][ticket_nature_all]"
                                        {{ (json_decode($user->permission) && in_array('ticket_nature_delete', json_decode($user->permission, true)['ticket_helpers_all']['ticket_nature_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ticket_nature_delete">Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>

