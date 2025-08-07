<div class="container-fluid" id="ticket-edit">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent justify-content-between border-bottom">
                    <h2 class="fw-bolder" style="color: #f8c243;"> Ticket </h2>
                    <div class="d-flex">
                        <button class="btn all-btn-same mx-1" id="ticket-back-btn">Back</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="border p-3 ">

                        <form class="row g-3" action="{{ route('tickets.update', Crypt::encryptString($ticket->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <input type="hidden" name="create_user_id" value="{{ $ticket->create_user_id }}" />
                            <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="subject" class="form-label"> Subject <span class="text-danger">*</span> </label>
                                <input class="form-control" type="text" name="subject" id="subject" value="{{ $ticket->subject }}" placeholder="Enter subject" />
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="priority" class="form-label">Priority <span class="text-danger">*</span> </label>
                                <select class="form-control select2-show-search form-select" name="priority" id="priority" data-placeholder="Choose one priority" required>
                                    <option value="{{ $ticket->priority }}" selected>{{ $ticket->priority }}</option>
                                    <option value="High" >High</option>
                                    <option value="Medium" >Medium</option>
                                    <option value="Normal" >Normal</option>
                                </select>
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="company" class="form-label"> Company <span class="text-danger">*</span> </label>
                                <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                    <option value="" selected>Choose one company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{$company->id == $ticket->company_id ? 'selected' : ''}} >{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="subCompany" class="form-label">Sub Company <span class="text-danger">*</span> </label>
                                <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                    @if ($ticket->sub_company_id)
                                        <option value="{{ $ticket->subCompany->id }}">{{ $ticket->subCompany->name }}</option>
                                    @else
                                        <option value="">Select sub company</option>
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="location" class="form-label">Location <span class="text-danger">*</span> </label>
                                <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                    @if ($ticket->location_id)
                                        <option value="{{ $ticket->location->id }}">{{ $ticket->location->location }} ({{ $ticket->location->branch_code }})</option>
                                    @else
                                        <option value="">Select location</option>
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('location_id')" class="" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="module" class="form-label"> Module <span class="text-danger">*</span> </label>
                                <select class="form-control select2-show-search form-select" name="module_id" id="module" data-placeholder="Choose one module" required>
                                    <option value="" selected>Choose one module</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}" {{$module->id == $ticket->module_id ? 'selected' : ''}} >{{ $module->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="subModule" class="form-label">Sub Module</label>
                                <select class="form-control select2-show-search form-select" name="sub_module_id" id="subModule" data-placeholder="Choose one sub module" >
                                    @if ($ticket->sub_module_id)
                                        <option value="{{ $ticket->subModule->id }}">{{ $ticket->subModule->name }}</option>
                                    @else
                                        <option value="">Select sub module</option>
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('sub_module_id')" class="" />
                            </div>

                            <div class="col-md-4 col-12 form-group py-0 my-0" style="overflow: hidden;">
                                <label for="ticket_nature_id" class="form-label"> Ticket Nature </label>
                                <select class="form-control select2-show-search form-select" name="ticket_nature_id" id="ticket_nature_id" data-placeholder="Choose one ticket nature" >
                                    <option value="" selected>Choose one ticket nature</option>
                                    @foreach($ticket_natures as $ticket_nature)
                                        <option value="{{ $ticket_nature->id }}" {{$ticket_nature->id == $ticket->ticket_nature_id ? 'selected' : ''}} >{{ $ticket_nature->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('ticket_nature_id')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="attachment" class="form-label"> Attachment </label>
                                @if($ticket->attachment)
                                    <a href="{{ asset( $ticket->attachment ) }}" target="_blank">
                                        <img class="img-fluid my-2" src="{{ asset( $ticket->attachment ) }}" alt="attachment" style="height: 200px; width: auto;" />
                                    </a>
                                @else
                                    <input class="form-control dropify" type="file" name="attachment" id="attachment" value="{{ $ticket->attachment }}" placeholder="Enter attachment" />
                                @endif
                                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                            </div>

                            <div class="col-md-6 col-12 py-0 my-0">
                                <label for="description" class="form-label"> Details </label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Enter Details" >{{ $ticket->description }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn all-btn-same px-4" type="submit">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
