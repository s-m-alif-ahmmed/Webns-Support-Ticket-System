<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users_profile_user" aria-expanded="true" aria-controls="users_profile_user">
            <label class="form-check-label" for="users_profile_user"> Profile</label>
        </button>
    </h2>
    <div id="users_profile_user" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="user_profile_user" value="user_profile_user" name="permission[user_profile_user]" />
                <label class="form-check-label" for="user_profile_user">User Profile</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_show_password_user" id="profile_show_password_user" name="permission[user_profile_user][profile_show_password_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_show_password_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_show_password_user">Show Password</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_change_password_user" id="profile_change_password_user" name="permission[user_profile_user][profile_change_password_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_change_password_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_change_password_user">Change Password</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_edit_user" id="profile_edit_user" name="permission[user_profile_user][profile_edit_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_edit_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_edit_user"> Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_email_user" id="profile_email_user" name="permission[user_profile_user][profile_email_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_email_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_email_user">Email</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_phone_user" id="profile_phone_user" name="permission[user_profile_user][profile_phone_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_phone_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_phone_user">Phone Number</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_number_user" id="profile_number_user" name="permission[user_profile_user][profile_number_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_number_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_number_user">Employee ID</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_role_user" id="profile_role_user" name="permission[user_profile_user][profile_role_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_role_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_role_user">Role</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_department_designation_user" id="profile_department_designation_user" name="permission[user_profile_user][profile_department_designation_user]" data-checkem-parent="permission[user_profile_user]"
                            {{ (json_decode($company_user->permission) && in_array('profile_department_designation_user', json_decode($company_user->permission, true)['user_profile_user'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_department_designation_user">Department & Designation</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
