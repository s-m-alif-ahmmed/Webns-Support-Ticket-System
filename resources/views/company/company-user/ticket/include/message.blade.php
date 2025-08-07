<div class="container-fluid">
    <!-- Row -->
    <div class="row row-deck justify-content-center">
        <div class="col-12">
            <p class="text-danger mx-auto pt-2 pb-2 mb-0" id="message-error" style="display: none;"></p>
            <p class="text-success mx-auto pt-2 pb-2 mb-0" id="message-success" style="display: none;"></p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat h-100">
                        <div class="main-chat-header pt-3 d-flex">
                            <div class="main-img-user online">
                                @if($ticket->subCompany->image)
                                    <img alt="avatar" src="{{ asset( $ticket->subCompany->image ) }}">
                                @else
                                    <img alt="avatar" src="{{ asset( $ticket->subCompany->image ) }}">
                                @endif
                            </div>
                            <div class="main-chat-msg-name mt-1">
                                <p class="mb-0">{{ $ticket->subject }}</p>
                                <small class="me-3">Ticket ID# {{ $ticket->ticket_code }}</small>
                            </div>
                        </div>
                        <!-- main-chat-header -->
                        <div class="main-chat-body flex-2" id="ChatBody">
                            <div class="content-inner" id="auto-refresh-div">
                                @foreach($messages as $message)
                                    @if($message->create_user_id)
                                        <div class="media chat-left">
                                            <div class="main-img-user online">
                                                @if($message->createdBy->photo)
                                                    <img alt="avatar" src="{{ asset($message->createdBy->photo) }}">
                                                @else
                                                    <img alt="avatar" src="{{ asset('/') }}admin/images/users/blank_image.jpg">
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                @if($message->message)
                                                    <div class="main-msg-wrapper">
                                                        <p class="p-0 m-0 text-start" style="font-size: 11px;">
                                                            {{$message->createdBy->name}}
                                                        </p>
                                                        <p class="p-0 m-0 text-start" style="font-size: 11px;">
                                                            {{$message->createdBy->designation}}
                                                        </p>
                                                        {{ $message->message }}
                                                    </div>
                                                @endif
                                                @if($message->attachment)
                                                    <div class="main-msg-wrapper">
                                                        <p class="p-0 m-0 text-start" style="font-size: 11px;">
                                                            {{$message->createdBy->name}}
                                                        </p>
                                                        <p class="p-0 m-0 text-start" style="font-size: 11px;">
                                                            {{$message->createdBy->designation}}
                                                        </p>
                                                        <a href="{{ asset($message->attachment) }}" target="_blank">
                                                            <img class="img-fluid mt-1" src="{{ asset($message->attachment) }}" alt="Attachment" style="width: auto; height: 300px;">
                                                        </a>
                                                    </div>
                                                @endif
                                                <div>
                                                    <span>{{ $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</span> <a href="javascript:void(0)"><i class="icon ion-android-more-vertical"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($message->company_user_id)
                                        <div class="media flex-row-reverse chat-right">
                                            <div class="main-img-user online">
                                                @if($message->createdByCompany->photo)
                                                    <img alt="avatar" src="{{ asset($message->createdByCompany->photo) }}">
                                                @else
                                                    <img alt="avatar" src="{{ asset('/') }}admin/images/users/blank_image.jpg">
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                @if($message->message)
                                                    <div class="main-msg-wrapper">
                                                        <p class="p-0 m-0" style="font-size: 11px;">
                                                            {{$message->createdByCompany->name}}
                                                        </p>
                                                        <p class="p-0 m-0" style="font-size: 11px;">
                                                            {{$message->createdByCompany->designation->name}}
                                                        </p>
                                                        {{ $message->message }}
                                                    </div>
                                                @endif
                                                @if($message->attachment)
                                                    <div class="main-msg-wrapper">
                                                        <p class="p-0 m-0" style="font-size: 11px;">
                                                            {{$message->createdByCompany->name}}
                                                        </p>
                                                        <p class="p-0 m-0" style="font-size: 11px;">
                                                            {{$message->createdByCompany->designation->name}}
                                                        </p>
                                                        <a href="{{ asset($message->attachment) }}" target="_blank">
                                                            <img class="img-fluid mt-1" src="{{ asset($message->attachment) }}" alt="Attachment" style="width: auto; height: 300px;">
                                                        </a>
                                                    </div>
                                                @endif
                                                <div>
                                                    <span>{{ $message->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</span> <a href="javascript:void(0)"><i class="icon ion-android-more-vertical"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @if($ticket->status == 'Open')
                            <div class="main-chat-footer py-3">
                                @php
                                    $userAssignment = $company_ticket_assigns->firstWhere('assign_user_id', $company_admin->id);
                                @endphp

                                @if($userAssignment)
                                    @if($userAssignment->work_role === 'Responder')
                                        <div class="message-form-container">
                                            <div class="file-preview" id="filePreview" style="display: none;">
                                                <!-- The preview image will be dynamically inserted here -->
                                            </div>
                                            <button type="button" id="removePreview" class="remove-preview">✖</button>
                                            <form class="d-flex border-0 p-0 m-0" id="messageForm" action="{{ route('user.store.message') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="create_user_id" value="">
                                                <input type="hidden" name="update_user_id" value="">
                                                <input type="hidden" name="company_user_id" value="{{ $company_admin->id }}">
                                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                                <input class="form-control" name="message" placeholder="Type your message here..." type="text">
                                                <div class="upload">
                                                    <label class="upload-area">
                                                        <input type="file" name="attachment" id="fileInput">
                                                        <span class="upload-button">
                                                <i class="fe fe-paperclip"></i>
                                            </span>
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-icon btn-primary brround my-1"><i class="fa fa-paper-plane-o"></i></button>
                                            </form>
                                        </div>
                                    @else
                                        <p class="mx-auto my-auto" style="color: #ff0000;font-size: 14px;">Need Permission to start conversation!</p>
                                    @endif
                                @else
                                    <p class="mx-auto my-auto" style="color: #ff0000;font-size: 14px;">Need Permission to start conversation!</p>
                                @endif

                            </div>
                        @else
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>



<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var preview = document.getElementById('filePreview');
        var removeButton = document.getElementById('removePreview');

        preview.innerHTML = ''; // Clear previous preview content

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                preview.appendChild(img);

                preview.style.display = 'flex';  // Show the preview container
                removeButton.style.display = 'block';  // Show the remove button
            };

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';  // Hide the preview container if no file is selected
            removeButton.style.display = 'none';  // Hide the remove button if no file is selected
        }
    });

    // Ensure the remove button visibility is toggled correctly when clicking it
    document.getElementById('removePreview').addEventListener('click', function() {
        var fileInput = document.getElementById('fileInput');
        var preview = document.getElementById('filePreview');
        var removeButton = document.getElementById('removePreview');

        fileInput.value = '';  // Clear the file input
        preview.innerHTML = '';  // Clear the preview content
        preview.style.display = 'none';  // Hide the preview container
        removeButton.style.display = 'none';  // Hide the remove button
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Instantly hide the preview when the form is submitted
            var preview = document.getElementById('filePreview');
            var removeButton = document.getElementById('removePreview');
            preview.innerHTML = '';  // Clear the preview
            preview.style.display = 'none';  // Hide the preview container
            removeButton.style.display = 'none';  // Hide the remove button

            var formData = new FormData(this); // Use FormData to include files in the AJAX request

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('message-success').textContent = data.message;
                        document.getElementById('message-success').style.display = 'block';
                        document.getElementById('message-error').style.display = 'none';
                        document.getElementById('messageForm').reset(); // Reset the form after submission
                    } else {
                        document.getElementById('message-error').textContent = data.error;
                        document.getElementById('message-error').style.display = 'block';
                        document.getElementById('message-success').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('messageForm').addEventListener('submit', function(event) {

            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Use FormData to include files in the AJAX request

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }

            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optionally, clear the form after successful submission
                        document.getElementById('messageForm').reset();

                        // Append the new message to the chat body
                        var chatBody = document.getElementById('ChatBody').querySelector('.content-inner');
                        var newMessage = document.createElement('div');
                        newMessage.classList.add('media');

                        if (data.is_company_user) {
                            newMessage.classList.add('chat-right', 'flex-row-reverse');
                        } else {
                            newMessage.classList.add('chat-left');
                        }

                        var messageHTML = `
                    <div class="main-img-user online">
                        <img alt="avatar" src="${data.photo}">
                    </div>
                    <div class="media-body">
                `;

                        if (data.message) {
                            messageHTML += `
                        <div class="main-msg-wrapper">
                            <p class="p-0 m-0" style="font-size: 11px;">
                                ${data.name}
                            </p>
                            <p class="p-0 m-0" style="font-size: 11px;">
                                ${data.designation}
                            </p>
                            ${data.message}
                        </div>
                    `;
                        }

                        if (data.attachment) {
                            messageHTML += `
                        <div class="main-msg-wrapper">
                            <p class="p-0 m-0" style="font-size: 11px;">
                                ${data.name}
                            </p>
                            <p class="p-0 m-0" style="font-size: 11px;">
                                ${data.designation}
                            </p>
                            <a href="${data.attachment}" target="_blank">
                                <img class="img-fluid" src="${data.attachment}" alt="Attachment" style="width: auto; height: 300px;">
                            </a>
                        </div>
                    `;
                        }

                        messageHTML += `
                    <div>
                        <span>${data.created_at}</span> <a href="javascript:void(0)"><i class="icon ion-android-more-vertical"></i></a>
                    </div>
                </div>`;

                        newMessage.innerHTML = messageHTML;
                        chatBody.appendChild(newMessage);

                        chatBody.scrollTop = chatBody.scrollHeight;

                    } else {
                        // Display error message
                        document.getElementById('message-error').innerHTML = data.message;
                        document.getElementById('message-error').style.display = 'block';
                        setTimeout(function() {
                            document.getElementById('message-error').style.display = 'none';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Display a generic error message
                    document.getElementById('message-error').innerHTML = "Message not sent!";
                    document.getElementById('message-error').style.display = 'block';
                    setTimeout(function() {
                        document.getElementById('message-error').style.display = 'none';
                    }, 3000);
                });
        });
    });

</script>


