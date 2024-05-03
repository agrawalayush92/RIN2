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
                                <h4 class="card-title">Post New Notification</h4>
                                <form class="form">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <div class="form-group">
                                    <select name="notifType" id="notifType">
                                        <option value="marketing"> Marketing </option>
                                        <option value="invoices"> Invoices </option>
                                        <option value="system"> System </option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Notification Name</label>
                                        <input type="text" class="form-control" id="notifName" name="notifName" placeholder="Notification Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="notifSentTo"> Notification sent to</label>
                                        <select name="notifSentTo" id="notifSentTo">
                                            <option value="all"> All </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}"> {{$user->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary post-notif">Submit</button>
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
    document.addEventListener('DOMContentLoaded', (event) => {
        var form = document.querySelector('.form');
        if(form){
            var submitButton = form.querySelector('.btn.btn-primary.post-notif');
            if(submitButton){
                submitButton.addEventListener('click', function(event) {
                    // Prevent the button from submitting the traditional way
                    event.preventDefault();

                    // Create a FormData object from our form
                    var formData = new FormData(form);
                    // var userId = document.getElementById('userSelect').value;
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // Use fetch to send the form data
                    fetch('/notifications', {
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
                    window.location.reload();
                });
            } else {
                console.log('Submit button not found');
            }
        }
    });

</script>