<div class="accordion-item permission-checkbox">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="true" aria-controls="users">
            <label class="form-check-label" for="users">
                Users
            </label>
        </button>
    </h2>
    <div id="users" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="users_all" value="users_all" name="permission[users_all]"/>
                <label class="form-check-label" for="users_all">Users All</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_manage" id="employ_manage" name="permission[users_all][employ_manage]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_manage', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_manage">Manage</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_detail" id="employ_detail" name="permission[users_all][employ_detail]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_detail', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_detail">Detail</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_create" id="employ_create" name="permission[users_all][employ_create]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_create', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_create">Create</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_edit" id="employ_edit" name="permission[users_all][employ_edit]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_edit', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_edit">Edit</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_permission" id="profile_phone" name="permission[users_all][employ_permission]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_permission', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_permission">Permissions</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_show_password" id="employ_show_password" name="permission[users_all][employ_show_password]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_show_password', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_show_password">Show Password</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_password" id="employ_password" name="permission[users_all][employ_password]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_password', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_password">Change Password</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_restriction" id="employ_restriction" name="permission[users_all][employ_restriction]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_restriction', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_restriction">Restriction</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employ_delete" id="employ_delete" name="permission[users_all][employ_delete]" data-checkem-parent="permission[users_all]"
                            {{ (json_decode($user->permission) && in_array('employ_delete', json_decode($user->permission, true)['users_all'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employ_delete">Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
