<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user', [
            'notifications' => Auth::Utilisateur()->notifications()
                ->latest()
                ->take(5)
                ->get(),
            'unreadNotifications' => Auth::Utilisateur()->unreadNotifications()->count(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }

    // Marquer une notification comme lue
    public function markAsRead(Notification $notification)
    {
        $notification->update(['lue' => true]); // More Eloquent way

        return redirect()->back();
    }

    public function getNotifications()
    {
        $adminId = auth::user()->utilisateur_id;
        $notifications = Notification::where('utilisateur_id', $adminId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $unreadCount = Notification::where('utilisateur_id', $adminId)
            ->where('lue', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }
}
