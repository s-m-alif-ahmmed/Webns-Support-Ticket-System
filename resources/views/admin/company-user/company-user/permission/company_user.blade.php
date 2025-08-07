<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#companyUsers_user" aria-expanded="true" aria-controls="companyUsers_user">
            <label class="form-check-label" for="companyUsers_user">Company Users</label>
        </button>
    </h2>
    <div id="companyUsers_user" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="company_users_all_user" value="company_users_all_user" name="permission[company_users_all_user]" />
                <label class="form-check-label" for="company_users_all_user">Company Users</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_manage_user" value="company_user_manage_user" name="permission[company_users_all_user][company_user_manage_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_manage_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_manage_user">Manage User</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_detail_user" value="company_user_detail_user" name="permission[company_users_all_user][company_user_detail_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_detail_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_detail_user">User Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_create_user" value="company_user_create_user" name="permission[company_users_all_user][company_user_create_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_create_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_create_user">User Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_edit_user" value="company_user_edit_user" name="permission[company_users_all_user][company_user_edit_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_edit_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_edit_user">User edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_create_info_user" value="company_user_create_info_user" name="permission[company_users_all_user][company_user_create_info_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_create_info_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_create_info_user"> Created By</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_update_info_user" value="company_user_update_info_user" name="permission[company_users_all_user][company_user_update_info_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_update_info_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_update_info_user"> Updated By</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_show_password_user" value="company_user_show_password_user" name="permission[company_users_all_user][company_user_show_password_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_show_password_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_show_password_user"> show Password</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_change_password_user" value="company_user_change_password_user" name="permission[company_users_all_user][company_user_change_password_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_change_password_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_change_password_user"> Change Password</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_permission_user" value="company_user_permission_user" name="permission[company_users_all_user][company_user_permission_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_permission_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_permission_user"> Permission</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_department_designation_user" value="company_user_department_designation_user" name="permission[company_users_all_user][company_user_department_designation_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_department_designation_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_department_designation_user"> Department & Designation Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_email_edit_user" value="company_user_email_edit_user" name="permission[company_users_all_user][company_user_email_edit_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_email_edit_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_email_edit_user"> Email Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_employee_id_edit_user" value="company_user_employee_id_edit_user" name="permission[company_users_all_user][company_user_employee_id_edit_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_employee_id_edit_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_employee_id_edit_user"> Employee ID Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_role_edit_user" value="company_user_role_edit_user" name="permission[company_users_all_user][company_user_role_edit_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_role_edit_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_role_edit_user"> Role Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="company_user_delete_user" value="company_user_delete_user" name="permission[company_users_all_user][company_user_delete_user]" data-checkem-parent="permission[company_users_all_user]"
                            {{ (json_decode($company_user->permission) && in_array('company_user_delete_user', json_decode($company_user->permission, true)['company_users_all_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_user_delete_user"> Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>








