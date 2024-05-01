@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                            <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title">Change User Notification Settings</h4>
                                <form class="form">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <div class="form-group">
                                    <select name="userSelect" id="userSelect">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputName1">Change Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Change Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                            <input id="notification" type="checkbox">
                                            <span class="slider round"></span>
                                        <label for="notificationToggle">Show Notifications</label>
                                    </div>
                                    <button type="button" class="btn btn-primary me-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

<script>
    // Function to populate form fields based on selected user
    function populateUserData(userId) {
        // Get the user data from the PHP variable
        var userData = {!! json_encode($users->keyBy('id')->toArray()) !!}[userId];

        // Populate form fields with user data
        document.getElementById("email").value = userData.email;
        document.getElementById("phone").value = userData.phone;
        document.getElementById("notification").checked = userData.notifications_switch;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        var selectElement = document.getElementById('userSelect');
        if (selectElement) {
            // Populate user data for the initially selected user
            populateUserData(selectElement.value);

            // Update user data when a different user is selected
            selectElement.addEventListener('change', function() {
                populateUserData(this.value);
            });
        } else {
            console.log('Select element not found');
        }
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        var form = document.querySelector('.form');
        if(form){
            var submitButton = form.querySelector('.btn.btn-primary.me-2');
            if(submitButton){
                submitButton.addEventListener('click', function(event) {
                    // Prevent the button from submitting the traditional way
                    event.preventDefault();

                    var checkbox = document.getElementById("notification");

                    // Create a FormData object from our form
                    var formData = new FormData(form);
                    formData.append("notification", checkbox.checked ? 1 : 0);
                    var userId = document.getElementById('userSelect').value;
                    console.log(userId);  // Log the userId

                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // Use fetch to send the form data
                    fetch('/settings/' + userId, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Show toast notification
                        var toast = document.createElement('div');
                        toast.style.position = 'fixed';
                        toast.style.bottom = '20px';
                        toast.style.right = '20px';
                        toast.style.padding = '10px';
                        toast.style.backgroundColor = '#4CAF50';
                        toast.style.color = 'white';
                        toast.textContent = 'Form submitted successfully!';
                        document.body.appendChild(toast);

                        // Remove toast notification after 3 seconds
                        setTimeout(function() {
                            document.body.removeChild(toast);
                        }, 3000);
                        console.log('Response data:', data);
                    })
                    .catch(error => console.log('Error:'));
                });
            } else {
                console.log('Submit button not found');
            }
        }
    });

</script>