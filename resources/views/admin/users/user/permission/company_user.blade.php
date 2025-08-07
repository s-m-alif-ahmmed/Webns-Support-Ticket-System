<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#companyUsers" aria-expanded="true" aria-controls="companyUsers">
            <label class="form-check-label" for="companyUsers">
                Company Users
            </label>
        </button>
    </h2>
    <div id="companyUsers" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="row ms-1">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" id="company_users_all" value="company_users_all" name="permission[company_users_all]" />
                    <label class="form-check-label" for="company_users_all">Company Users</label>
                </div>
            </div>

            <div class="row mx-1">
                <ul>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="department_all" value="department_all" name="permission[company_users_all][department_all]" data-checkem-parent="permission[company_users_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_users_all'] ?? [] ? 'checked' : '') && in_array('department_all', json_decode($user->permission, true)['company_users_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="department_all"> Departments All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_manage" value="department_manage" name="permission[company_users_all][department_all][department_manage]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_manage', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_detail" value="department_detail" name="permission[company_users_all][department_all][department_detail]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_detail', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_create" value="department_create" name="permission[company_users_all][department_all][department_create]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_create', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_edit" value="department_edit" name="permission[company_users_all][department_all][department_edit]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_edit', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_create_info" value="department_create_info" name="permission[company_users_all][department_all][department_create_info]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_create_info', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_update_info" value="department_update_info" name="permission[company_users_all][department_all][department_update_info]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_update_info', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_update_info">Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_status" value="department_status" name="permission[company_users_all][department_all][department_status]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_status', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="department_delete" value="department_delete" name="permission[company_users_all][department_all][department_delete]" data-checkem-parent="permission[company_users_all][department_all]"
                                        {{ (json_decode($user->permission) && in_array('department_delete', json_decode($user->permission, true)['company_users_all']['department_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="department_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="designation_all" value="designation_all" name="permission[company_users_all][designation_all]" data-checkem-parent="permission[company_users_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_users_all'] ?? [] ? 'checked' : '') && in_array('designation_all', json_decode($user->permission, true)['company_users_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="designation_all">Designations All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_manage" value="designation_manage" name="permission[company_users_all][designation_all][designation_manage]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_manage', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_detail" value="designation_detail" name="permission[company_users_all][designation_all][designation_detail]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_detail', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_create" value="designation_create" name="permission[company_users_all][designation_all][designation_create]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_create', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_edit" value="designation_edit" name="permission[company_users_all][designation_all][designation_edit]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_edit', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_create_info" value="designation_create_info" name="permission[company_users_all][designation_all][designation_create_info]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_create_info', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_update_info" value="designation_update_info" name="permission[company_users_all][designation_all][designation_update_info]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_update_info', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_status" value="designation_status" name="permission[company_users_all][designation_all][designation_status]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_status', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="designation_delete" value="designation_delete" name="permission[company_users_all][designation_all][designation_delete]" data-checkem-parent="permission[company_users_all][designation_all]"
                                        {{ (json_decode($user->permission) && in_array('designation_delete', json_decode($user->permission, true)['company_users_all']['designation_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="designation_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="company_all_user" value="company_all_user" name="permission[company_users_all][company_all_user]" data-checkem-parent="permission[company_users_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_users_all'] ?? [] ? 'checked' : '') && in_array('designation_all', json_decode($user->permission, true)['company_users_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="company_all_user"> Users All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_manage" value="company_user_manage" name="permission[company_users_all][company_all_user][company_user_manage]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_manage', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_detail" value="company_user_detail" name="permission[company_users_all][company_all_user][company_user_detail]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_detail', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_create" value="company_user_create" name="permission[company_users_all][company_all_user][company_user_create]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_create', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_edit" value="company_user_edit" name="permission[company_users_all][company_all_user][company_user_edit]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_edit', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_create_info" value="company_user_create_info" name="permission[company_users_all][company_all_user][company_user_create_info]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_create_info', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_update_info" value="company_user_update_info" name="permission[company_users_all][company_all_user][company_user_update_info]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_update_info', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_update_info">Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_show_password" value="company_user_show_password" name="permission[company_users_all][company_all_user][company_user_show_password]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_show_password', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_show_password">Show Password</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_change_password" value="company_user_change_password" name="permission[company_users_all][company_all_user][company_user_change_password]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_change_password', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_change_password">Change Password</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_permission" value="company_user_permission" name="permission[company_users_all][company_all_user][company_user_permission]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_permission', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_permission"> Permission</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_user_delete" value="company_user_delete" name="permission[company_users_all][company_all_user][company_user_delete]" data-checkem-parent="permission[company_users_all][company_all_user]"
                                        {{ (json_decode($user->permission) && in_array('company_user_delete', json_decode($user->permission, true)['company_users_all']['company_all_user'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_user_delete">Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>



