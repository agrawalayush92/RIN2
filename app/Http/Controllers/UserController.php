<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('unread_notifications')->get();
        return view('users', compact('users'));
    }

    public function impersonate(Request $request)
    {
        $user = User::with('unread_notifications')->first();
        return view('home', compact('user'));
    }

    public function notifications(Request $request)
    {
        if($request->get('destination') == 'all') {
            $users = User::where('user_type', 'user')->whereNull('deleted_at')->get();
            foreach ($users as $user) {
                $notification = new Notifications();
                $notification->name = $request->get('name');
                $notification->expired_at = $request->get('expired_at');
                $notification->notifications_type = $request->get('notifications_type');
                $notification->user_id = $user->id;
                $notification->save();
            }
        }
    }

    public function settings(Request $request)
    {
        $user = User::where('user_type', 'user')->whereNull('deleted_at')->where('id', $request->id)->first();
        if($request->get('email') != $user->email)
        {
            $user->email = $request->get('email');
        }

        if($request->get('phone') != $user->phone)
        {
            $user->phone = $request->get('phone');
        }

        if($request->get('notifications_switch') != $user->notifications_switch)
        {
            $user->notifications_switch = $request->get('notifications_switch');
        }

        return view('settings', compact('user'));
    }
}
