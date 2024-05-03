<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Notifications\NotificationSender;

class NotificationController extends Controller
{
    public function changeStatus(Request $request)
    {
        Notifications::where("id", $request->id)->update(["status" => $request->status]);
        return response()->json(['message' => 'Notification status updated successfully'], 200);
    }

    public function getNotifications(Request $request)
    {
        $notifications = Notifications::with('user')->whereNull('deleted_at')->orderBy('user_id')->get();
        return view('notifications', compact('notifications'));
    }

    public function postNotifications(Request $request)
    {
        $users = User::_findAll();
        return view('post_notifications', compact('users'));
    }

    public function saveNotifications(Request $request)
    {
        if ($request->get('notifSentTo') == 'all') {
            $users = User::_findAll();
            foreach ($users as $user) {
                Notifications::saveNotification($request, $user->id);
            }
        } else {
            Notifications::saveNotification($request, $request->get('notifSentTo'));
        }
        return response('Notification Saved', 200);
    }
}
