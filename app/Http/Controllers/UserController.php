<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifications;
use Validator;
use Propaganistas\LaravelPhone\Rules\Phone;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('unread_notifications')->where('user_type', 'user')->get();
        return view('users', compact('users'));
    }

    public function impersonate(Request $request)
    {
        $user = User::_find($request->userId, ['unread_notifications']);
        return view('impersonate', compact('user'));
    }

    public function notifications(Request $request)
    {
        if ($request->get('destination') == 'all') {
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
        $users = User::where('user_type', 'user')->get();
        return view('settings', compact('users'));
    }

    public function saveSettings(Request $request)
    {
        try {
            if (!empty($request->get('phone'))) {
                $validator = Validator::make($request->all(), [
                    'phone' => 'sometimes|phone:mobile'
                ]);

                if ($validator->fails()) {
                    throw new \Exception('Validation failed: ' . $validator->errors());
                }
            }

            $user = User::_find($request->id);
            if ($request->get('email') != $user->email) {
                $user->email = $request->get('email');
            }

            if ($request->get('phone') != $user->phone) {
                $user->phone = $request->get('phone');
            }

            if ($request->get('notification') != $user->notifications_switch) {
                $user->notifications_switch = $request->get('notification');
            }
            $user->save();

            return response('Settings Saved', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
