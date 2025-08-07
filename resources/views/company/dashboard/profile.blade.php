@extends('company.master')

@section('title')
    Company User Profile
@endsection

@section('content')

    <section class="py-5">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- ROW-1 OPEN -->
            <div class="row justify-content-center" id="user-profile" style="margin-bottom: 100px;">
                <div class="col-lg-9">
                    <div class="tab-content">

                        <div class="card">
                            <div class="card-body border-0">
                                <div class="form-horizontal">

                                    <div class="row">
                                        <p class="mb-4 text-center fs-30 fw-bold" style="color: #FFB400FF;">Profile Info</p>
                                    </div>
                                    @if(session('message'))
                                        <div class="row">
                                            <p class="text-success text-center">{{session('message')}}</p>
                                        </div>
                                    @endif
                                    <div class="row">

                                        <div class="d-flex">

                                            <div class="col-md-12 pb-2 d-flex justify-content-center text-center">
                                                @if($company_user->photo)
                                                    <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                        <img class="rounded-circle" src="{{ asset($company_user->photo) }}" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                        <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                            <i class="fa fa-edit text-white"></i>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if($company_user->gender == 'Male')
                                                        <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                            <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                            <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                                <i class="fa fa-edit text-white"></i>
                                                            </div>
                                                        </div>
                                                    @elseif($company_user->gender == 'Female')
                                                        <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                            <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                            <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                                <i class="fa fa-edit text-white"></i>
                                                            </div>
                                                        </div>
                                                    @elseif($company_user->gender == 'Others')
                                                        <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                            <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                            <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                                <i class="fa fa-edit text-white"></i>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            <!-- The modal -->

                                            <div id="imageEditorModal" class="modal">
                                                <div class="modal-dialog modal-dialog-centered" style="height: 500px !important; width: 350px!important;">
                                                    <div class="modal-content" >

                                                        <form action="{{ route('company.user.photo.update', Crypt::encryptString($company_user->id) ) }}" id="imageForm" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('patch')

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                <span class="close text-end" style="" onclick="closeImageEditor()">
                                                                    <span class="btn float-end">
                                                                        <i class="fa fa-times"></i>
                                                                    </span>
                                                                </span>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <p class="mb-4 text-center fs-20 fw-bold" style="color: #FFB400FF;" >Change User Image</p>
                                                                </div>
                                                                <div class="col-md-12 px-2">

                                                                    <div id="imagePreviewContainer" class="text-center">
                                                                        @if($company_user->photo)
                                                                            <img id="viewImage" src="{{asset($company_user->photo)}}" alt="viewImage" class="rounded-circle m-2" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;">
                                                                        @else
                                                                            @if($company_user->gender == 'Male')
                                                                                <img id="viewImage" class="rounded-circle m-2" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                                            @elseif($company_user->gender == 'Female')
                                                                                <img id="viewImage" class="rounded-circle m-2" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                                            @elseif($company_user->gender == 'Others')
                                                                                <img id="viewImage" class="rounded-circle m-2" src="{{ asset('/') }}admin/images/users/default-avatar-photo-female-vector.jpg" alt="Employee" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;" id="profileImage" onclick="openImageEditor()">
                                                                            @endif
                                                                        @endif

                                                                        <img id="previewImage" class="rounded-circle mx-auto" alt="Preview" style="height: 150px; width: 150px; border: 2px solid #FBA000FF;">
                                                                        <br>
                                                                        <input type="file" class="w-75 form-control mx-auto" id="imageInput" name="photo" onchange="previewImage()">
                                                                        <p class="text-center fs-14 px-2 pt-1" style="color: #009f00;">Recommanded Size: 400*400 px</p>
                                                                    </div>
                                                                </div>
                                                                @if($company_user->photo == null)
                                                                    <div class="col-md-12 my-auto" style="margin: -10px 0 40px 0 !important;">
                                                                        <div class="text-center mt-2 pe-0">
                                                                            <input type="submit" class="btn w-75 all-btn-same" value="Update" />
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if($company_user->photo)
                                                                    <div class="col-md-12 my-auto">
                                                                        <div class="text-center mt-2 pe-0">
                                                                            <input type="submit" class="btn w-75 all-btn-same" value="Update" />
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </form>

                                                        @if($company_user->photo)
                                                            <div class="text-center" style="margin: 10px 0 40px 0;">
                                                                <form action="{{ route('photo.destroy', $company_user->id) }}" id="deleteForm{{ $company_user->id }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger w-75" onclick="return deleteAction('{{ $company_user->id }}', 'Are you sure to remove this picture?', 'btn-danger')">
                                                                        Remove
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-body">
                            <div class="form-horizontal">

                                <div class="row" id="view-profile">

                                    <div class="col-md-12 text-end pt-0 mt-0">
                                        @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_edit_user']) && $companyPermissionData['user_profile_user']['profile_edit_user'] == 'profile_edit_user')
                                            <span class="pt-0 mt-0">
                                                <button class="btn all-btn-same text-end" id="profile-edit-btn">
                                                    Edit
                                                </button>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <p class="form-control m-0" >{{ $company_user->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <p class="form-control m-0" >{{ $company_user->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Employee ID</label>
                                        <p class="form-control m-0" >{{ $company_user->employee_id }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <p class="form-control m-0" >{{ $company_user->gender }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <p class="form-control m-0" >{{ $company_user->number }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <p class="form-control m-0" >{{ $company_user->role }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Department</label>
                                        <p class="form-control m-0" >{{ $company_user->department->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Designation</label>
                                        <p class="form-control m-0" >{{ $company_user->designation->name }}</p>
                                    </div>
                                </div>

                                <div class="row" id="edit-profile">
                                    <form action="{{ route('company.user.photo.update', Crypt::encryptString($company_user->id) ) }}" method="POST">
                                        @csrf
                                        @method('patch')

                                        <div class="row">
                                            <div class="col-md-12 text-end pt-0 mt-0">
                                                <span class="pt-0 mt-0">
                                                    <input type="submit" class="btn all-btn-same" value="Update" />
                                                </span>
                                                <span>
                                                    Or
                                                </span>
                                                <span class="pt-0 mt-0">
                                                    <button type="button" class="btn btn-danger" id="profile-edit-back">
                                                        Cancel
                                                    </button>
                                                </span>
                                            </div>

                                            <div class="col-md-6 my-0">
                                                <label class="form-label">Name</label>
                                                <input class="form-control m-0" type="text" name="name" value="{{ $company_user->name }}" />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>

                                            @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_email_user']) && $companyPermissionData['user_profile_user']['profile_email_user'] == 'profile_email_user')
                                                <div class="col-6 my-0">
                                                    <label for="email" class="form-label">Email </label>
                                                    <input class="form-control" type="email" name="email" id="email" value="{{ $company_user->email }}" placeholder="Enter Mail" required />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                            @else
                                                <div class="col-6 my-0">
                                                    <label for="email" class="form-label">Email </label>
                                                    <input class="form-control" type="email" name="email" id="email" value="{{ $company_user->email }}" placeholder="Enter Mail" required readonly />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                            @endif

                                            @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_number_user']) && $companyPermissionData['user_profile_user']['profile_number_user'] == 'profile_number_user')
                                                <div class="col-6 my-0">
                                                    <label for="employee_id" class="form-label">Employee ID </label>
                                                    <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $company_user->employee_id }}" placeholder="Enter Employee ID" required />
                                                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                                </div>
                                            @else
                                                <div class="col-6 my-0">
                                                    <label for="employee_id" class="form-label">Employee ID </label>
                                                    <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $company_user->employee_id }}" placeholder="Enter Employee ID" required readonly />
                                                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                                </div>
                                            @endif

                                            <div class="col-md-6 form-group my-0">
                                                <label class="form-label">Gender</label>
                                                <select class="form-control select2 form-select" name="gender" id="">
                                                    <option value="{{ $company_user->gender }}">{{ $company_user->gender }}</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                            </div>

                                            @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_phone_user']) && $companyPermissionData['user_profile_user']['profile_phone_user'] == 'profile_phone_user')
                                                <div class="col-md-6 my-0">
                                                    <label class="form-label">Phone Number</label>
                                                    <input class="form-control m-0" type="text" name="number" value="{{ $company_user->number }}" />
                                                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                </div>
                                            @else
                                                <div class="col-md-6 my-0">
                                                    <label class="form-label">Phone Number</label>
                                                    <input class="form-control m-0" type="text" name="number" value="{{ $company_user->number }}" readonly />
                                                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                </div>
                                            @endif

                                            @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_role_user']) && $companyPermissionData['user_profile_user']['profile_role_user'] == 'profile_role_user')
                                                <div class="col-6 form-group my-0">
                                                    <label for="role" class="form-label"> Role </label>
                                                    <select class="form-control select2-show-search form-select" name="role" id="role" data-placeholder="Choose one role" required>
                                                        <option value="{{ $company_user->role }}">{{ $company_user->role }}</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                                                </div>
                                            @else
                                                <div class="col-6 my-0">
                                                    <label for="role" class="form-label">Role </label>
                                                    <input class="form-control" type="text" name="role" id="role" value="{{ $company_user->role }}" placeholder="Enter role" required readonly />
                                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                                </div>
                                            @endif

                                            @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_department_designation_user']) && $companyPermissionData['user_profile_user']['profile_department_designation_user'] == 'profile_department_designation_user')
                                                <div class="col-6 form-group my-0">
                                                    <label for="departmentUser" class="form-label"> Department </label>
                                                    <select class="form-control select2-show-search form-select" name="department_id" id="departmentUser" data-placeholder="Choose one department" required>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" {{ $department->id == $company_user->department_id ? 'selected' : '' }}>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('department_id')" class="mt-1" />
                                                </div>

                                                <div class="col-6 form-group my-0">
                                                    <label for="designationUser" class="form-label"> Designation </label>
                                                    <select class="form-control select2-show-search form-select" name="designation_id" id="designationUser" data-placeholder="Choose one designation" required>
                                                        @if ($company_user->designation_id)
                                                            <option value="{{ $company_user->designation->id }}">{{ $company_user->designation->name }}</option>
                                                        @else
                                                            <option value="">Select Designation</option>
                                                        @endif
                                                    </select>
                                                    <x-input-error :messages="$errors->get('designation_id')" class="mt-1" />
                                                </div>
                                            @else
                                                <div class="col-md-6 my-0">
                                                    <label for="department_id" class="form-label">Department</label>
                                                    <input type="text" class="form-control" name="department_id" id="department_id" value="{{ $company_user->department->name }}" placeholder="Department Name" required autofocus autocomplete="username" readonly/>
                                                    <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                                                </div>

                                                <div class="col-md-6 my-0">
                                                    <label for="designation_id" class="form-label">Designation</label>
                                                    <input type="text" class="form-control" name="designation_id" id="designation_id" value="{{ $company_user->designation->name }}" placeholder="Designation Name" required autofocus autocomplete="username" readonly/>
                                                    <x-input-error :messages="$errors->get('designation_id')" class="mt-2" />
                                                </div>
                                            @endif

                                        </div>

                                    </form>

                                </div>

                                <div class="row">
                                    @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_show_password_user']) && $companyPermissionData['user_profile_user']['profile_show_password_user'] == 'profile_show_password_user')
                                        <div class="col-md-10">
                                            <label class="form-label">Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control bg-white" id="show-password" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon2" disabled>
                                                <span class="input-group-text bg-white" id="basic-addon2">
                                                    <i class="fa fa-eye text-gray" id="toggleShowPassword"></i>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-10">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control bg-white" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon2" disabled>
                                        </div>
                                    @endif
                                    @if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_change_password_user']) && $companyPermissionData['user_profile_user']['profile_change_password_user'] == 'profile_change_password_user')
                                        <div class="col-md-2">
                                            <button type="button" class="btn all-btn-same w-100 change-password-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Change Password
                                            </button>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 m-0 pb-0 pt-5">
                                            <p class="fs-20 fw-bold" id="staticBackdropLabel" style="color: #FFB400FF;">Change Password</p>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body m-0 pt-0">
                                            <div class="form-horizontal pt-0 mt-0">

                                                {{-- Password Changes--}}

                                                <div>
                                                    <form class="" action="{{route('company.user.password.update', $company_user->id )}}" method="post">
                                                        @csrf
                                                        @method('patch')

                                                        @if(session('status') === 'password-updated')
                                                            <p
                                                                x-data="{ show: true}"
                                                                x-show ="show"
                                                                x-transition
                                                                x-init="setTimeout(() => show = false, 2000)"
                                                                class="text-sm text-gray-600 text-center"
                                                            >
                                                                {{__('Password Update Successfully')}}
                                                            </p>
                                                        @endif

                                                        <div class="form-group">
                                                            <label for="password" class="form-label">Current Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="password" class="form-control" id="old_password" value="{{ $company_user->password }}" placeholder="new password" aria-describedby="basic-addon1" required disabled readonly >
                                                                <span class="input-group-text bg-white" id="basic-addon2">
                                                            <i class="fa fa-eye text-gray" id="togglePassword"></i>
                                                        </span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password" class="form-label">New Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="password" class="form-control" id="password" placeholder="new password" aria-describedby="basic-addon2" required>
                                                                <span class="input-group-text bg-white" id="basic-addon2">
                                                            <i class="fa fa-eye text-gray" id="toggleNewPassword"></i>
                                                        </span>
                                                            </div>
                                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password" aria-describedby="basic-addon3" required>
                                                                <span class="input-group-text bg-white" id="basic-addon3">
                                                            <i class="fa fa-eye text-gray" id="toggleConfirmPassword"></i>
                                                        </span>
                                                            </div>
                                                            <small style="font-size: 12px;" id="match-message" class="text-danger d-block"></small>
                                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                                        </div>

                                                        <div class="text-center">
                                                            <button class="btn all-btn-same" id="submit-button" type="submit">save changes</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- COL-END -->
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!-- End CONTAINER -->

    </section>


    <style>
        .change-password-button{
            margin-top: 37px;
        }
        @media screen and (min-width: 100px) and (max-width: 576px){
            .change-password-button{
                margin-top: 5px;
            }
        }
    </style>

    <script>
        // Initialize the preview as hidden
        document.getElementById('previewImage').style.display = 'none';

        // Open the modal
        function openImageEditor() {
            document.getElementById('imageEditorModal').style.display = 'block';
        }

        // Close the modal
        function closeImageEditor() {

            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imageInput');

            // Reset the file input and hide the preview
            fileInput.value = null;
            preview.src = '';
            preview.style.display = 'none';

            document.getElementById('imageEditorModal').style.display = 'none';
        }

        // Preview the selected image
        function previewImage() {
            var preview = document.getElementById('previewImage');
            var view = document.getElementById('viewImage');
            var fileInput = document.getElementById('imageInput');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview when an image is selected
                    view.style.display = 'none'; // Show the preview when an image is selected
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Hide the preview when no image is selected
            }
        }

        // Trigger the preview when the file input changes
        document.getElementById('imageInput').addEventListener('change', previewImage);

    </script>

@endsection
