// Sweet Alert Ban
function BanAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Status
function StatusAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Delete
function deleteAction(userId, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Trigger the form submission
            document.getElementById('deleteForm' + userId).submit();
        }
    });

    return false;
}

// jquery select checksm
$(function(){
    $('form').checkem();
});

// Industries & Companies & Sub Companies Dropdown
$(document).ready(function() {
    $('#industry').change(function() {
        var industryId = $(this).val();
        $.ajax({
            url: '/getCompaniesIdByIndustries',
            type: 'GET',
            dataType: 'json',
            data: {
                industry_id: industryId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#company').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#company').trigger('change');
            }
        });
    });

    $('#company').change(function() {
        var companyId = $(this).val();
        $.ajax({
            url: '/getSubCompaniesIdByCompanies',
            type: 'GET',
            dataType: 'json',
            data: {
                company_id: companyId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#subCompany').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#subCompany').trigger('change');
            }
        });
    });

    $('#subCompany').change(function() {
        var subCompanyId = $(this).val();
        $.ajax({
            url: '/getSubCompaniesIdByLocation',
            type: 'GET',
            dataType: 'json',
            data: {
                sub_company_id: subCompanyId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].location + '</option>';
                }
                $('#location').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#location').trigger('change');
            }
        });
    });

    $('#location').change(function() {
        var locationId = $(this).val();
        $.ajax({
            url: '/getLocationsIdByDepartment',
            type: 'GET',
            dataType: 'json',
            data: {
                location_id: locationId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#department').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#department').trigger('change');
            }
        });
    });

    $('#department').change(function() {
        var departmentId = $(this).val();
        $.ajax({
            url: '/getDepartmentsIdByDesignation',
            type: 'GET',
            dataType: 'json',
            data: {
                department_id: departmentId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#designation').html(options);
            }
        });
    });

});

$(document).ready(function() {
    $('#module').change(function() {
        var moduleId = $(this).val();

        $.ajax({
            url: '/getModulesIdBySubModule',
            type: 'GET',
            dataType: 'json',
            data: {
                module_id: moduleId,
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#subModule').html(options);
            }
        });
    });
});


// Company User
$(document).ready(function() {
    $('#departmentUser').change(function() {
        var departmentId = $(this).val();

        $.ajax({
            url: '/getDepartmentsIdByDesignationUser',
            type: 'GET',
            dataType: 'json',
            data: {
                department_id: departmentId,
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#designationUser').html(options);
            }
        });
    });
});

$(document).ready(function() {
    $('#module').change(function() {
        var moduleId = $(this).val();

        $.ajax({
            url: '/getSubModulesIdByModuleCompany',
            type: 'GET',
            dataType: 'json',
            data: {
                module_id: moduleId,
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#subModule').html(options);
            }
        });
    });
});

// Password Show
$(document).ready(function() {
    $('#togglePassword').click(function() {
        var x = document.getElementById("old_password");

        if (x.type === "password") {
            x.type = "text";
            $('#togglePassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#togglePassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleShowPassword').click(function() {
        var x = document.getElementById("show-password");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleShowPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleShowPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleNewPassword').click(function() {
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleNewPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleNewPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#togglePasswordNew').click(function() {
        var x = document.getElementById("passwordNew");

        if (x.type === "password") {
            x.type = "text";
            $('#togglePasswordNew').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#togglePasswordNew').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleConfirmPassword').click(function() {
        var x = document.getElementById("password_confirmation");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleConfirmPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleConfirmPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});

// confirm password validation
$(document).ready(function () {

    // Function to update the password match message
    function updatePasswordMatchMessage(isMatch) {
        if (isMatch) {
            $('#match-message').removeClass('text-danger').addClass('deep-green').text('Passwords match.');
        } else {
            $('#match-message').removeClass('text-success').addClass('text-danger').text('Passwords do not match.');
        }
    }

    // Function to check if the input fields are not empty
    function isNotEmpty(value) {
        return value.trim() !== '';
    }

    // Event handler for password confirmation input
    $('#password_confirmation').on('input', function () {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        console.log(confirmPassword);
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Event handler for password input
    $('#password').on('input', function () {
        var password = $(this).val();
        var validationResults = validatePasswordFormat(password);
        updatePasswordValidationMessages(validationResults);

        // Also check for password match when the password changes
        var confirmPassword = $('#password_confirmation').val();
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Initialize the match message only if both fields are not empty
    var initialPassword = $('#password').val();
    var initialConfirmPassword = $('#password_confirmation').val();
    if (isNotEmpty(initialPassword) && isNotEmpty(initialConfirmPassword)) {
        updatePasswordMatchMessage(initialPassword === initialConfirmPassword);
    }

});

// Function to validate password match
function validatePasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
}


// message

// Auto Refresh Div and scroll bottom

// var objDov = document.getElementById("auto-refresh-div");
// objDov.scrollTop = objDov.scrollHeight;
$(document).ready(function () {
    // var objDov = document.getElementById("auto-refresh-div");
    setInterval( function() {
        $("#auto-refresh-div").load(location.href + " #auto-refresh-div");
        // objDov.scrollTop = objDov.scrollHeight;
    }, 500 );
});


// Ticket Hide and show
$(document).ready(function (){

    // Edit Ticket
    $('#ticket-edit').hide();
    // Add an event listener to the English tab
    $('#ticket-edit-btn').click(function () {
        // Show form-one and hide form-two
        $('#ticket-edit').show();
        $('#ticket-view').hide();
    });
    // Add an event listener to the English tab
    $('#ticket-back-btn').click(function () {
        // Show form-one and hide form-two
        $('#ticket-view').show();
        $('#ticket-edit').hide();
    });

    // Ticket Assign
    $('#assign-create').hide();
    // Add an event listener to the English tab
    $('#assign-create-btn').click(function () {
        // Show form-one and hide form-two
        $('#assign-create').show();
        $('#assign-view').hide();
    });

    // Add an event listener to the English tab
    $('#assign-view-btn').click(function () {
        // Show form-one and hide form-two
        $('#assign-view').show();
        $('#assign-create').hide();
    });
});

// Company Ticket Hide and show
$(document).ready(function (){

    // Edit Ticket
    $('#company-ticket-edit').hide();
    // Add an event listener to the English tab
    $('#company-ticket-edit-btn').click(function () {
        // Show form-one and hide form-two
        $('#company-ticket-edit').show();
        $('#company-ticket-view').hide();
    });
    // Add an event listener to the English tab
    $('#company-ticket-back-btn').click(function () {
        // Show form-one and hide form-two
        $('#company-ticket-view').show();
        $('#company-ticket-edit').hide();
    });

    // Ticket Assign
    $('#company-assign-create').hide();
    // Add an event listener to the English tab
    $('#company-assign-create-btn').click(function () {
        // Show form-one and hide form-two
        $('#company-assign-create').show();
        $('#company-assign-view').hide();
    });

    // Add an event listener to the English tab
    $('#company-assign-view-btn').click(function () {
        // Show form-one and hide form-two
        $('#company-assign-view').show();
        $('#company-assign-create').hide();
    });
});

// User Profile
$(document).ready(function (){

    // Edit Ticket
    $('#edit-profile').hide();
    // Add an event listener to the English tab
    $('#profile-edit-btn').click(function () {
        // Show form-one and hide form-two
        $('#edit-profile').show();
        $('#view-profile').hide();
    });
    // Add an event listener to the English tab
    $('#profile-edit-back').click(function () {
        // Show form-one and hide form-two
        $('#view-profile').show();
        $('#edit-profile').hide();
    });

});

// User Detail
$(document).ready(function (){

    // Edit Ticket
    $('#user-edit-form').hide();
    $('#user-permission-form').hide();
    // Add an event listener to the English tab
    $('#user-edit-btn').click(function () {
        // Show form-one and hide form-two
        $('#user-edit-form').show();
        $('#user-view-form').hide();
    });
    // Add an event listener to the English tab
    $('#user-edit-form-back').click(function () {
        // Show form-one and hide form-two
        $('#user-view-form').show();
        $('#user-edit-form').hide();
    });

});


