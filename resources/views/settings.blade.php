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
                                <form class="forms-sample">
                                    <div class="form-group">
                                    <select name="userSelect" id="userSelect">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputName1">Change Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Change Phone Number</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="switch">
                                            <input id="notificationToggle" type="checkbox" onchange="toggleNotifications()">
                                            <span class="slider round"></span>
                                        </label>
                                        <label for="notificationToggle">Show Notifications</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
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