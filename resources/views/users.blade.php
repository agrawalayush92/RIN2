@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                </div>
                <div class="container-scroller">
                    <!-- partial -->
                    <div class="container-fluid page-body-wrapper">
                    <div class="main-panel">
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
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Unread Notification Count
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td> {{ $user->name }} </td>
                                                <td> {{ $user->email }} </td>
                                                <td> {{ $user->unread_notifications_count }} </td>
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
                    <!-- main-panel ends -->
                    </div>
                    <!-- page-body-wrapper ends -->
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection
