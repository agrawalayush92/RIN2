@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                </div>
                        <div class="content-wrapper">
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title">Users List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>
                                            Notification Name
                                        </th>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Notification Type
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Expire At
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($notifications as $notif)
                                            <tr>
                                                <td> {{ $notif->name }} </td>
                                                <td> {{ $notif->user->name }} </td>
                                                <td> {{ $notif->notifications_type }} </td>
                                                <td> {{ ($notif->status == 1) ? "read" : "unread" }} </td>
                                                <td> {{ $notif->expired_at }} </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- partial -->
            </div>
        </div>
    </div>
</div>
@endsection