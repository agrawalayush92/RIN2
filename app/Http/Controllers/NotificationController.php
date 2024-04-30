<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Notifications\NotificationSender;

class NotificationController extends Controller
{
    public function changeStatus(Request $request)
    {
        Notifications::where("id", $request->id)->update(["status" => $request->status]);
        return response()->json(['message' => 'Notification status updated successfully'], 200);
    }
}
