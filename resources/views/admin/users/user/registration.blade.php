@extends('admin.master')

@section('title')
    Create User
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('users') }}">Users</a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Create New User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>
        <hr/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="justify-content-center border-bottom">
                            <div class="col-md-12 py-3">
                                <p class="mb-4 text-center fs-30 fw-bold" style="color: #FFB400FF;">Create New User</p>
                            </div>
                        </div>

                        <form method="POST" id="signup" action="{{ route('users.registration.store') }}">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="email" id="emailInput" placeholder="Email" aria-describedby="addon-wrapping" required autofocus autocomplete="username" />
                                            <span class="input-group-text" id="addon-wrapping">@webnstech.net</span>
                                        </div>
                                        <div id="emailError" class="text-danger"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="number">Phone Number</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping-number">+88 019</span>
                                            <input type="text" class="form-control" name="number" id="numberInput" placeholder="Phone Number" aria-label="number" aria-describedby="addon-wrapping-number" value="{{ old('number') }}" required autofocus autocomplete="number" />
                                        </div>
                                        <div id="numberError" class="text-danger"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="gender" class="form-label">Gender</label>
                                        <div class="form-group">
                                            <select class="form-control select2 form-select" name="gender" data-placeholder="Choose one" >
                                                <option label="Choose one"></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Employee ID</label>
                                        <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID" :value="old('employee_id')" required autofocus autocomplete="employee_id" />
                                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <div class="form-group">
                                            <select class="form-control select2 form-select" name="role" data-placeholder="Choose one" >
                                                <option label="Choose one"></option>
                                                <option value="Super Admin">Super Admin</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Editor">Editor</option>
                                                <option value="Viewer">Viewer</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" name="department" placeholder="Enter department" :value="old('department')" required autofocus autocomplete="department" />
                                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label for="designation" class="form-label">Designation</label>
                                        <input type="text" class="form-control" name="designation" placeholder="Enter designation" :value="old('designation')" required autofocus autocomplete="designation" />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required autocomplete="new-password" />
                                        <small id="lowercase-message" class="text-danger d-block"></small>
                                        <small id="uppercase-message" class="text-danger d-block"></small>
                                        <small id="digit-message" class="text-danger d-block"></small>
                                        <small id="special-char-message" class="text-danger d-block"></small>
                                        <small id="length-message" class="text-danger d-block"></small>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                        <small id="match-message" class="text-danger d-block"></small>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center text-center my-4">
                                <button class="btn all-btn-same" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>

        document.getElementById('signup').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var confirmPasswordError = document.getElementById('match-message');

            confirmPasswordError.textContent = '';

            if (password !== confirmPassword) {
                event.preventDefault();
                confirmPasswordError.textContent = 'Password and Confirm Password do not match.';
            }
        });


        // Assuming you have a form with the ID "signup"
        document.getElementById('signup').addEventListener('submit', function (event) {

            // Validate Email
            var emailInput = document.getElementById('emailInput');
            var emailInputValue = emailInput.value;

            if (emailInputValue.includes('@')) {
                document.getElementById('emailError').innerText = "Email cannot contain '@' symbol";
                event.preventDefault(); // Prevent form submission
            } else if (emailInputValue.length < 3 || emailInputValue.length > 30) {
                document.getElementById('emailError').innerText = "Email must be between 3 and 30 characters";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById('emailError').innerText = "";
            }

            // Concatenate the input value with the domain
            var finalEmail = emailInputValue + '@webnstech.net';

            // Set the concatenated value back to the input field
            emailInput.value = finalEmail;


            // Validate Number
            var numberInput = document.getElementById('numberInput');
            var numberInputValue = numberInput.value;

            if (!validatePhoneNumber(numberInputValue)) {
                document.getElementById('numberError').innerText = "Invalid phone number format";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById('numberError').innerText = "";
            }

            // Concatenate the input value with the domain
            var finalNumber = '+88019' + numberInputValue;

            // Set the concatenated value back to the input field
            numberInput.value = finalNumber;
        });

        document.getElementById('emailInput').addEventListener('input', function (event) {
            var emailInputValue = event.target.value;

            if (emailInputValue.includes('@')) {
                document.getElementById('emailError').innerText = "Email cannot contain '@' symbol";
            } else if (emailInputValue.length < 3 || emailInputValue.length > 30) {
                document.getElementById('emailError').innerText = "Email must be between 3 and 30 characters";
            } else {
                document.getElementById('emailError').innerText = "";
            }
        });

        document.getElementById('numberInput').addEventListener('input', function (event) {
            var numberInputValue = event.target.value;
            var isValid = validatePhoneNumber(numberInputValue);

            if (!isValid) {
                document.getElementById('numberError').innerText = "Invalid phone number format";
            } else {
                document.getElementById('numberError').innerText = "";
            }
        });


        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePhoneNumber(number) {
            var re = /^[0-9]{8}$/; // Assuming 8 digits for the phone number
            return re.test(number);
        }
    </script>

@endsection

