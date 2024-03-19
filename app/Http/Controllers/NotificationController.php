<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('notifications.index')->with([
            'notifications' => auth()->user()->notifications()->paginate(2),
        ]);
    }


    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->back();
    }
    public function allRead(DatabaseNotification $notification)
    {
        // $notification->unreadNotifications()->markAsRead();

        return redirect()->back();
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
