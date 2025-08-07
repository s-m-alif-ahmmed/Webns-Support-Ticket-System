<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed fs-14 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#company_everything" aria-expanded="true" aria-controls="company_everything">
            <label class="form-check-label" for="company_everything">
                Companies
            </label>
        </button>
    </h2>
    <div id="company_everything" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="row ms-1">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" id="company_everything_all" value="company_everything_all" name="permission[company_everything_all]"/>
                    <label class="form-check-label" for="company_everything_all">Company All</label>
                </div>
            </div>

            <div class="row mx-1">
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="industry_all" value="industry_all" name="permission[company_everything_all][industry_all]" data-checkem-parent="permission[company_everything_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_everything_all'] ?? [] ? 'checked' : '') && in_array('industry_all', json_decode($user->permission, true)['company_everything_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="industry_all">Industries All</label>
                        </div>
                        <ul class="row d-flex col-12">

                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_manage" value="industry_manage" name="permission[company_everything_all][industry_all][industry_manage]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_manage', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_manage">Manage</label>
                                </div>
                            </li>

                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_detail" value="industry_detail" name="permission[company_everything_all][industry_all][industry_detail]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_detail', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_create" value="industry_create" name="permission[company_everything_all][industry_all][industry_create]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_create', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_edit" value="industry_edit" name="permission[company_everything_all][industry_all][industry_edit]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_edit', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_create_info" value="industry_create_info" name="permission[company_everything_all][industry_all][industry_create_info]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_create_info', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_update_info" value="industry_update_info" name="permission[company_everything_all][industry_all][industry_update_info]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_update_info', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_status" value="industry_status" name="permission[company_everything_all][industry_all][industry_status]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_status', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="industry_delete" value="industry_delete" name="permission[company_everything_all][industry_all][industry_delete]" data-checkem-parent="permission[company_everything_all][industry_all]"
                                        {{ (json_decode($user->permission) && in_array('industry_delete', json_decode($user->permission, true)['company_everything_all']['industry_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="industry_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="company_all" value="company_all" name="permission[company_everything_all][company_all]" data-checkem-parent="permission[company_everything_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_everything_all'] ?? [] ? 'checked' : '') && in_array('company_all', json_decode($user->permission, true)['company_everything_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="company_all">Companies All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_manage" value="company_manage" name="permission[company_everything_all][company_all][company_manage]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_manage', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_detail" value="company_detail" name="permission[company_everything_all][company_all][company_detail]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_detail', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_create" value="company_create" name="permission[company_everything_all][company_all][company_create]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_create', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_edit" value="company_edit" name="permission[company_everything_all][company_all][company_edit]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_edit', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_code" value="company_code" name="permission[company_everything_all][company_all][company_code]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_code', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_code">Company Code</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_create_info" value="company_create_info" name="permission[company_everything_all][company_all][company_create_info]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_create_info', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_update_info" value="company_update_info" name="permission[company_everything_all][company_all][company_update_info]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_update_info', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_status" value="company_status" name="permission[company_everything_all][company_all][company_status]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_status', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="company_delete" value="company_delete" name="permission[company_everything_all][company_all][company_delete]" data-checkem-parent="permission[company_everything_all][company_all]"
                                        {{ (json_decode($user->permission) && in_array('company_delete', json_decode($user->permission, true)['company_everything_all']['company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="company_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sub_company_all" value="sub_company_all" name="permission[company_everything_all][sub_company_all]" data-checkem-parent="permission[company_everything_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_everything_all'] ?? [] ? 'checked' : '') && in_array('sub_company_all', json_decode($user->permission, true)['company_everything_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="sub_company_all">Sub Companies All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_manage" value="sub_company_manage" name="permission[company_everything_all][sub_company_all][sub_company_manage]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_manage', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_detail" value="sub_company_detail" name="permission[company_everything_all][sub_company_all][sub_company_detail]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_detail', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_detail">Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_create" value="sub_company_create" name="permission[company_everything_all][sub_company_all][sub_company_create]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_create', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_create">Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_edit" value="sub_company_edit" name="permission[company_everything_all][sub_company_all][sub_company_edit]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_edit', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_code" value="sub_company_code" name="permission[company_everything_all][sub_company_all][sub_company_code]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_code', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_code">Sub Company Code</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_create_info" value="sub_company_create_info" name="permission[company_everything_all][sub_company_all][sub_company_create_info]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_create_info', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_create_info">Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_update_info" value="sub_company_update_info" name="permission[company_everything_all][sub_company_all][sub_company_update_info]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_update_info', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_update_info">Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_status" value="sub_company_status" name="permission[company_everything_all][sub_company_all][sub_company_status]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_status', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_status">Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sub_company_delete" value="sub_company_delete" name="permission[company_everything_all][sub_company_all][sub_company_delete]" data-checkem-parent="permission[company_everything_all][sub_company_all]"
                                        {{ (json_decode($user->permission) && in_array('sub_company_delete', json_decode($user->permission, true)['company_everything_all']['sub_company_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sub_company_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="location_all" value="location_all" name="permission[company_everything_all][location_all]" data-checkem-parent="permission[company_everything_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['company_everything_all'] ?? [] ? 'checked' : '') && in_array('location_all', json_decode($user->permission, true)['company_everything_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="location_all">Locations All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_manage" value="location_manage" name="permission[company_everything_all][location_all][location_manage]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_manage', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_manage">Manage </label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_detail" value="location_detail" name="permission[company_everything_all][location_all][location_detail]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_detail', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_detail"> Detail</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_create" value="location_create" name="permission[company_everything_all][location_all][location_create]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_create', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_create"> Create</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_edit" value="location_edit" name="permission[company_everything_all][location_all][location_edit]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_edit', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_edit"> edit</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_create_info" value="location_create_info" name="permission[company_everything_all][location_all][location_create_info]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_create_info', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_create_info"> Created By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_update_info" value="location_update_info" name="permission[company_everything_all][location_all][location_update_info]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_update_info', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_update_info"> Updated By</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_status" value="location_status" name="permission[company_everything_all][location_all][location_status]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_status', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_status"> Status</label>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="location_delete" value="location_delete" name="permission[company_everything_all][location_all][location_delete]" data-checkem-parent="permission[company_everything_all][location_all]"
                                        {{ (json_decode($user->permission) && in_array('location_delete', json_decode($user->permission, true)['company_everything_all']['location_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="location_delete"> Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>



