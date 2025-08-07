<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#users_profile" aria-expanded="true" aria-controls="users_profile">
            <label class="form-check-label" for="users_profile">
                User Profile
            </label>
        </button>
    </h2>
    <div id="users_profile" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="user_profile" value="user_profile" name="permission[user_profile]"/>
                <label class="form-check-label" for="user_profile">User Profile</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="show_password" id="show_password" name="permission[user_profile][show_password]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('show_password', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="show_password">Show Password</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="change_password" id="change_password" name="permission[user_profile][change_password]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('change_password', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="change_password">Change Password</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_edit" id="profile_edit" name="permission[user_profile][profile_edit]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_edit', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_edit">Profile Edit</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_email" id="profile_email" name="permission[user_profile][profile_email]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_email', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_email">Email</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_phone" id="profile_phone" name="permission[user_profile][profile_phone]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_phone', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="user_phone">Phone Number</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_number" id="profile_number" name="permission[user_profile][profile_number]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_number', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_number">Employee ID</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_role" id="profile_role" name="permission[user_profile][profile_role]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_role', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_role">Role</label>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_department_designation" id="profile_department_designation" name="permission[user_profile][profile_department_designation]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_department_designation', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_department_designation">Department & Designation</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
