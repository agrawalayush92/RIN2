<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primary_key = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function saveNotification($request, $sendTo)
    {
        $notification = new Notifications();
        $notification->name = $request->get('notifName');
        // $notification->expired_at = $request->get('expired_at');
        $notification->notifications_type = $request->get('notifType');
        $notification->user_id = $sendTo;
        $notification->save();
    }
}
