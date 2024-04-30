@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="notifications" onclick="toggleNotificationList()" onmouseover="showHandCursor()" onmouseout="hideHandCursor()">
                        <i class="fa fa-bell"></i>
                        @if($user->unread_notifications->count() > 0) <span class="badge">{{ $user->unread_notifications->count() }}</span> @endif
                    </div>

                    <div id="notificationDropdown" class="dropdown-content">
                        @foreach($user->unread_notifications as $notification)
                            <div onclick="markAsRead({{ $notification->id }})">
                                {{ $notification->name }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <label> Name </label> - {{$user->name}} <br/>
                    <label> Email </label> - {{$user->email}} <br/>
                    <label> Phone </label> - {{$user->phone}} <br/>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
    .notifications {
        position: absolute;
        display: inline-block;
        right:20;
    }

    .notifications .fa-bell {
        font-size: 20px;
        color: #555;
    }

    .notifications .badge {
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        right: 20;
    }

    .dropdown-content div {
        padding: 12px 16px;
        cursor: pointer;
    }

    .dropdown-content div:hover {
        background-color: #ddd;
    }
</style>

<script>
    function toggleNotificationList() {
    var dropdown = document.getElementById("notificationDropdown");
    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
        }
    }

    function showHandCursor() {
        document.querySelector('.notifications').style.cursor = 'pointer';
    }

    function hideHandCursor() {
        document.querySelector('.notifications').style.cursor = 'auto';
    }

    function markAsRead(notificationId) {
        // Send a PATCH request to update the notification status
        fetch('/notification/' + notificationId, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if needed
            },
            body: JSON.stringify({ status: 1 })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Handle success response if needed
            window.location.reload();
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            // Handle error if needed
        });
    }
</script>
