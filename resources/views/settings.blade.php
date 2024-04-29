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
                                    <select name="user" id="user">
                                    @foreach($users as $user)
                                        <tr>
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                        </tr>
                                    @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputName1">Change Email</label>
                                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail3">Change Phone Number</label>
                                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
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
