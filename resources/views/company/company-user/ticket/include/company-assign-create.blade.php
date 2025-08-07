<div class="container-fluid" id="company-assign-create">
    <!--ROW OPENED-->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header justify-content-between border-bottom">
                    <h2 class="fw-bolder" style="color: #f8c243;">Company User Assign</h2>
                    <button class="btn all-btn-same" id="company-assign-view-btn">Back</button>
                </div>
                <div class="card-body p-0">
                    <!-- Hidden shipping address section, might be toggled later -->
                    <div class="row d-none">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="company-shipping-address" class="form-label text-muted mb-2">Shipping Address:</label>
                                        <textarea name="company-shipping-address" class="form-control w-60 d-none mb-2 text-dark" placeholder="Enter Address" id="company-shipping-address" cols="30" rows="5"></textarea>
                                        <a href="javascript:void(0)" role="button" class="text-primary text-center" id="addCompanyShippingAddress">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn text-primary" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                                <path d="M16,11.5h-3.5V8c0-0.276123-0.223877-0.5-0.5-0.5S11.5,7.723877,11.5,8v3.5H8c-0.276123,0-0.5,0.223877-0.5,0.5s0.223877,0.5,0.5,0.5h3.5v3.5005493C11.5001831,16.2765503,11.723999,16.5001831,12,16.5h0.0006104C12.2765503,16.4998169,12.5001831,16.276001,12.5,16v-3.5H16c0.276123,0,0.5-0.223877,0.5-0.5S16.276123,11.5,16,11.5z M12,2C6.4771729,2,2,6.4771729,2,12s4.4771729,10,10,10c5.5202026-0.0062866,9.9937134-4.4797974,10-10C22,6.4771729,17.5228271,2,12,2z M12,21c-4.9705811,0-9-4.0294189-9-9s4.0294189-9,9-9c4.9682617,0.0056152,8.9943848,4.0317383,9,9C21,16.9705811,16.9705811,21,12,21z"/>
                                            </svg>
                                            Add Address
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Assign Form -->

                    <div class="row">
                        <!-- Success Message Container -->
                        <div id="successMessage" class="alert alert-success" style="display: none;">
                            Tickets assigned successfully.
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-6 name-header">
                            <p class="ps-3">Assign To</p>
                        </div>
                        <div class="col-md-6 name-header">
                            <p>Assign Role</p>
                        </div>

                        <style>
                            .name-header{
                                @media screen and (max-width: 993px){
                                    display: none;
                                }
                            }
                        </style>


                        <form id="createCompanyForm" action="{{ route('company.user.store.assign') }}" method="POST">
                            @csrf

                            <div class="col-xl-12 pt-0 mt-0">

                                <div class="company-product-description-list">
                                    <div class="table-responsive company-product-description-each" style="overflow: hidden;">

                                        <input type="hidden" name="company_user_id" value="{{ $company_admin->id }}">
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                        <div class="company-invoice-product-table">

                                            <div class="row border-bottom pb-3 mb-3">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group px-1 py-1 my-0" style="overflow: hidden; height: 40px;">
                                                        <select class="form-control select2-show-search form-select" name="assign_user_id[]" id="assign_user_id" required>
                                                            <option value="" selected>Choose one employee</option>
                                                            @foreach($company_users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->employee_id }})</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('assign_user_id')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group px-1 py-1 my-0" style="overflow: hidden; height: 40px;">
                                                        <select class="form-control select2-show-search form-select" name="work_role[]" id="work_role" required>
                                                            <option value="" selected>Choose one work role</option>
                                                            <option value="Viewer">Viewer</option>
                                                            <option value="Responder">Responder</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('work_role')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <i class="fa fa-times fs-20 text-muted text-center company-delete-row-btn ms-2"></i>

                                    </div>
                                </div>

                                <a href="javascript:void(0)" role="button" class="text-primary text-center add-company-invoice-item-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn text-primary" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                        <path d="M16,11.5h-3.5V8c0-0.276123-0.223877-0.5-0.5-0.5S11.5,7.723877,11.5,8v3.5H8c-0.276123,0-0.5,0.223877-0.5,0.5s0.223877,0.5,0.5,0.5h3.5v3.5005493C11.5001831,16.2765503,11.723999,16.5001831,12,16.5h0.0006104C12.2765503,16.4998169,12.5001831,16.276001,12.5,16v-3.5H16c0.276123,0,0.5-0.223877,0.5-0.5S16.276123,11.5,16,11.5z M12,2C6.4771729,2,2,6.4771729,2,12s4.4771729,10,10,10c5.5202026-0.0062866,9.9937134-4.4797974,10-10C22,6.4771729,17.5228271,2,12,2z M12,21c-4.9705811,0-9-4.0294189-9-9s4.0294189-9,9-9c4.9682617,0.0056152,8.9943848,4.0317383,9,9C21,16.9705811,16.9705811,21,12,21z"/>
                                    </svg>
                                    Add Member
                                </a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-2" id="submitForm" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
