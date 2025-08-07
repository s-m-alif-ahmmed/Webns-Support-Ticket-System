@extends('admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="main-container container-fluid">

        {{--        Page header--}}

        <div class="row pt-5 pb-0 px-5">
            <div class="py-2 px-5 card card-body border-0 rounded-1 bg-white-4 justify-content-center">
                @if(Auth::user()->name)
                <h2 class="fw-bold">Welcome, {{ Auth::user()->name}}</h2>
                @else
                    <h2>Welcome </h2>
                @endif
            </div>
        </div>

        @if(session('message'))
            <div id="success-message" class="alert text-right" style="background-color: #FBA000FF; position: fixed; top: 100px; right: 20px; z-index: 1000;">
                <p class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 16px; width: 16px; margin: 5px " viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/></svg>
                    {{ session('message') }}
                </p>
            </div>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Hide the message after 3 seconds (3000 milliseconds)
                setTimeout(function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }
                }, 5000);
            });
        </script>

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title fs-30 fw-bold" style="margin-left: 35px; color: #FFB400FF;">Dashboard</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="card-group border-0 bg-gray-100">
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-2 fw-bold">{{ $total_tickets }}</h3>
                                    <p class="text-muted fs-15 mb-0">Total Tickets</p>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-primary dash ms-auto box-shadow-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 576 512"><path d="M64 64C28.7 64 0 92.7 0 128l0 64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320l0 64c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6l0-64c0-35.3-28.7-64-64-64L64 64zm64 112l0 160c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-288 0c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32l320 0c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32l-320 0c-17.7 0-32-14.3-32-32l0-192z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-2 fw-bold">{{ $total_open_tickets }}</h3>
                                    <p class="text-muted fs-15 mb-0">Pending Tickets</p>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-danger dash ms-auto box-shadow-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 576 512"><path d="M64 64C28.7 64 0 92.7 0 128l0 64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320l0 64c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6l0-64c0-35.3-28.7-64-64-64L64 64zm64 112l0 160c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-288 0c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32l320 0c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32l-320 0c-17.7 0-32-14.3-32-32l0-192z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-2 fw-bold">{{ $total_closed_tickets }}</h3>
                                    <p class="text-muted fs-15 mb-0">Solved Tickets</p>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 576 512"><path d="M64 64C28.7 64 0 92.7 0 128l0 64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320l0 64c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6l0-64c0-35.3-28.7-64-64-64L64 64zm64 112l0 160c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-288 0c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32l320 0c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32l-320 0c-17.7 0-32-14.3-32-32l0-192z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-2 fw-bold">{{ $total_ticket_assigns }}</h3>
                                    <p class="text-muted fs-15 mb-0">Total Assign</p>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M9,10h2.5c0.276123,0,0.5-0.223877,0.5-0.5S11.776123,9,11.5,9H10V8c0-0.276123-0.223877-0.5-0.5-0.5S9,7.723877,9,8v1c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2h1c0.5523071,0,1,0.4476929,1,1s-0.4476929,1-1,1H7.5C7.223877,15,7,15.223877,7,15.5S7.223877,16,7.5,16H9v1.0005493C9.0001831,17.2765503,9.223999,17.5001831,9.5,17.5h0.0006104C9.7765503,17.4998169,10.0001831,17.276001,10,17v-1c1.1045532,0,2-0.8954468,2-2s-0.8954468-2-2-2H9c-0.5523071,0-1-0.4476929-1-1S8.4476929,10,9,10z M21.5,12H17V2.5c0.000061-0.0875244-0.0228882-0.1735229-0.0665283-0.2493896c-0.1375732-0.2393188-0.4431152-0.3217773-0.6824951-0.1842041l-3.2460327,1.8603516L9.7481079,2.0654297c-0.1536865-0.0878906-0.3424072-0.0878906-0.4960938,0l-3.256897,1.8613281L2.7490234,2.0664062C2.6731567,2.0227661,2.5871582,1.9998779,2.4996338,1.9998779C2.2235718,2.000061,1.9998779,2.223938,2,2.5v17c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5H19c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-6.5006104C21.9998169,12.2234497,21.776001,11.9998169,21.5,12z M4.5,21c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5V3.3623047l2.7412109,1.5712891c0.1575928,0.0872192,0.348877,0.0875854,0.5068359,0.0009766L9.5,3.0761719l3.2519531,1.8583984c0.157959,0.0866089,0.3492432,0.0862427,0.5068359-0.0009766L16,3.3623047V19c0.0008545,0.7719116,0.3010864,1.4684448,0.7803345,2H4.5z M21,19c0,1.1045532-0.8954468,2-2,2s-2-0.8954468-2-2v-6h4V19z"/></svg>--}}
                                        <i class="fa fa-th-list text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    if (Auth::check()) {
                                        $userId = Auth::user()->id;

                                        // Debugging: Retrieve the first match if it exists
                                        $matched_ticket = \App\Models\Admin\Ticket\TicketAssign::where('assign_user_id', $userId)->first();

                                        if ($matched_ticket) {
                                            $total_user_ticket_assigns = \App\Models\Admin\Ticket\TicketAssign::where('assign_user_id', $userId)->count();
                                        } else {
                                            // Debugging: Log or display a message to confirm no match
                                            Log::info("No tickets found for user with ID: $userId");
                                            $total_user_ticket_assigns = 0;
                                        }
                                    } else {
                                        $total_user_ticket_assigns = 0; // Handle non-authenticated users
                                    }

                                @endphp

                                <div class="col">
                                    <h3 class="mb-2 fw-bold">{{ $total_user_ticket_assigns }}</h3>
                                    <p class="text-muted fs-15 mb-0">Total Task</p>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M9,10h2.5c0.276123,0,0.5-0.223877,0.5-0.5S11.776123,9,11.5,9H10V8c0-0.276123-0.223877-0.5-0.5-0.5S9,7.723877,9,8v1c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2h1c0.5523071,0,1,0.4476929,1,1s-0.4476929,1-1,1H7.5C7.223877,15,7,15.223877,7,15.5S7.223877,16,7.5,16H9v1.0005493C9.0001831,17.2765503,9.223999,17.5001831,9.5,17.5h0.0006104C9.7765503,17.4998169,10.0001831,17.276001,10,17v-1c1.1045532,0,2-0.8954468,2-2s-0.8954468-2-2-2H9c-0.5523071,0-1-0.4476929-1-1S8.4476929,10,9,10z M21.5,12H17V2.5c0.000061-0.0875244-0.0228882-0.1735229-0.0665283-0.2493896c-0.1375732-0.2393188-0.4431152-0.3217773-0.6824951-0.1842041l-3.2460327,1.8603516L9.7481079,2.0654297c-0.1536865-0.0878906-0.3424072-0.0878906-0.4960938,0l-3.256897,1.8613281L2.7490234,2.0664062C2.6731567,2.0227661,2.5871582,1.9998779,2.4996338,1.9998779C2.2235718,2.000061,1.9998779,2.223938,2,2.5v17c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5H19c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-6.5006104C21.9998169,12.2234497,21.776001,11.9998169,21.5,12z M4.5,21c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5V3.3623047l2.7412109,1.5712891c0.1575928,0.0872192,0.348877,0.0875854,0.5068359,0.0009766L9.5,3.0761719l3.2519531,1.8583984c0.157959,0.0866089,0.3492432,0.0862427,0.5068359-0.0009766L16,3.3623047V19c0.0008545,0.7719116,0.3010864,1.4684448,0.7803345,2H4.5z M21,19c0,1.1045532-0.8954468,2-2,2s-2-0.8954468-2-2v-6h4V19z"/></svg>--}}
                                    <i class="fa fa-th-list text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END-->

        <div class="row my-2">
            <div class="text-end">
                <button class="btn all-btn-same fs-18 fw-bold" type="button" style="margin-right: 55px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa fa-ticket"></i>
                    Create Ticket
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bolder" style="color: #FBA000FF; margin-left: 5px;">Create Ticket </h2>
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="fa fa-times" style="font-size: 20px !important;"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" p-3 ">
                                <form class="row g-3" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="create_user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="update_user_id" value="" />
                                    <input type="hidden" name="company_user_id" value="" />
                                    <input type="hidden" name="update_company_user_id" value="" />
                                    <input type="hidden" name="operation_end_time" value="" />
                                    <input type="hidden" name="end_time" value="" />

                                    <div class="col-md-6 col-12 py-0 my-0">
                                        <label for="subject" class="form-label"> Subject <span class="text-danger">*</span> </label>
                                        <input class="form-control" type="text" name="subject" id="subject" placeholder="Enter subject" required />
                                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 col-12 form-group py-0 my-0">
                                        <label for="priority" class="form-label">Priority <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="priority" id="priority" data-placeholder="Choose one priority" required>
                                            <option value="" selected>Select priority</option>
                                            <option value="High" >High</option>
                                            <option value="Medium" >Medium</option>
                                            <option value="Normal" >Normal</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="company" class="form-label"> Company <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            <option value="" selected>Choose one company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{$company->ticket_id == $company->id ? 'selected' : ''}} >{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="subCompany" class="form-label">Sub Company <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="sub_company_id" id="subCompany" data-placeholder="Choose one sub company" required>
                                            <option value="" selected>Select sub company</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_company_id')" class="" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="location_id" id="location" data-placeholder="Choose one location" required>
                                            <option value="" selected>Select location</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('location_id')" class="" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="module" class="form-label"> Module <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="module_id" id="module" data-placeholder="Choose one module" required>
                                            <option value="" selected>Choose one module</option>
                                            @foreach($modules as $module)
                                                <option value="{{ $module->id }}" {{$module->ticket_id == $module->id ? 'selected' : ''}} >{{ $module->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="subModule" class="form-label">Sub Module</label>
                                        <select class="form-control select2-show-search form-select" name="sub_module_id" id="subModule" data-placeholder="Choose one sub module" >
                                            <option value="" selected>Select sub module</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_module_id')" class="" />
                                    </div>

                                    <div class="col-md-4 col-12 form-group py-0 my-0">
                                        <label for="ticket_nature_id" class="form-label"> Ticket Nature <span class="text-danger">*</span> </label>
                                        <select class="form-control select2-show-search form-select" name="ticket_nature_id" id="ticket_nature_id" data-placeholder="Choose one ticket nature" required >
                                            <option value="" selected>Choose one ticket nature</option>
                                            @foreach($ticket_natures as $ticket_nature)
                                                <option value="{{ $ticket_nature->id }}" {{$ticket_nature->ticket_id == $ticket_nature->id ? 'selected' : ''}} >{{ $ticket_nature->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('ticket_nature_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 col-12 py-0 my-0">
                                        <label for="attachment" class="form-label"> Attachment </label>
                                        <input class="form-control dropify" type="file" name="attachment" id="attachment" value="" placeholder="Enter attachment" />
                                        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 col-12 py-0 my-0">
                                        <label for="description" class="form-label"> Details <span class="text-danger">*</span> </label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Enter Details" required></textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="btn all-btn-same px-4" type="submit">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
{{--                            <div class="modal-footer">--}}
{{--                                --}}
{{--                            </div>--}}
                    </div>
                </div>
            </div>
        </div>


        <div class="row px-5" style="margin-bottom: 100px;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered border-bottom w-100" id="file-datatable" style="width:100%">
                            <thead>
                            <tr style="background-color: #FBA000FF;">
                                <th class="fw-bold" style="width: 2%; color: white;"> SL </th>
                                <th class="fw-bold" style="width: 5%; color: white;"> T. ID </th>
                                <th class="fw-bold" style="width: 5%; color: white;"> Priority </th>
                                <th class="fw-bold" style="width: 12%; color: white;"> Ticket Nature </th>
                                <th class="fw-bold" style="width: 10%; color: white;"> Sub Company </th>
{{--                                <th class="fw-bold" style="width: 5%; color: white;"> Module</th>--}}
                                <th class="fw-bold" style="width: 10%; color: white;"> Sub Module </th>
                                <th class="fw-bold" style="width: 33%; color: white;"> Subject </th>
                                <th class="fw-bold" style="width: 13%; color: white;"> Date </th>
                                <th class="fw-bold" style="width: 3%; color: white;"> Status </th>
                                <th class="fw-bold" style="width: 5%; color: white;"> View </th>
                            </tr>
                            </thead>
                            <tbody id="category-table">
                            @foreach($tickets->sortByDesc('created_at') as $ticket)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ticket->ticket_code}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>
                                        @if($ticket->ticket_nature_id)
                                            {{ strlen($ticket->ticket_nature->name) >= 15 ? substr($ticket->ticket_nature->name, 0, 10) . '...' : $ticket->ticket_nature->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->location_id)
                                            {{$ticket->location->subCompany->name}} ( {{$ticket->location->branch_code}} )
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        @if($ticket->module_id)--}}
{{--                                            {{$ticket->module->name}}--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td>
                                        @if($ticket->sub_module_id)
                                            {{ strlen($ticket->subModule->name) >= 15 ? substr($ticket->subModule->name, 0, 15) . '...' : $ticket->subModule->name}}
                                        @endif
                                    </td>
                                    <td>
                                        {{ strlen($ticket->subject) >= 60 ? substr($ticket->subject, 0, 50) . '...' : $ticket->subject}}
                                    </td>
                                    <td>
                                        {{ $ticket->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </td>
                                    <td>
                                        @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_status']) && $permissionData['tickets_all']['tickets']['ticket_status'] == 'ticket_status')
                                            @if($ticket->status == 'Open')
                                                <a href="{{ route('change.ticket.admin.status', $ticket->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm on">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @elseif($ticket->status == 'Closed')
                                                <a href="{{ route('change.ticket.admin.status', $ticket->id) }}">
                                                    <div class="main-toggle-group style1 d-flex flex-wrap me-3">
                                                        <div class="toggle toggle-warning toggle-sm off">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @else

                                        @endif
                                        @if($ticket->status == 'Open')
                                            <span style="margin-left: 10px; color: red ;">
                                                {{$ticket->status}}
                                            </span>
                                        @else
                                            <span style="margin-left: 10px; color: green;">
                                                {{$ticket->status}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                            @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_detail']) && $permissionData['tickets_all']['tickets']['ticket_detail'] == 'ticket_detail')
                                                <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                    <a href="{{route('tickets.show', Crypt::encryptString($ticket->id))}}" class="btn all-btn-same mx-1">
                                                        View
                                                    </a>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
