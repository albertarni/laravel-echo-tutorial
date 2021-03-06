<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use App\Http\Requests;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification as Notification;

class UserController extends Controller
{

    //
    public function profile()
    {
        return view('profile', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request)
    {

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar   = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'.$filename));

            $user         = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('profile', array('user' => Auth::user()));
    }

    public function getOnlineUsers(Request $request)
    {
        return User::all();
    }

    public function getNotifications()
    {
        $user         = Auth::user();
        $notifictions = $user->notifications->map(function($item) {
            $item->is_readed         = boolval($item->read_at);
            return $item;
        });

        $data = [
            'notifications'              => $notifictions,
            'unread_notidications_count' => $user->unreadNotifications->count()
        ];
        return $data;
    }

    public function readNotification(Request $request, Notification $notification)
    {
        $user = Auth::user();
        $notification->markAsRead();

        return [
            'unread_notidications_count' => $user->unreadNotifications->count()
        ];
    }
}