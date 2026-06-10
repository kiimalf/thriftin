<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $unreadCount = 0;

    public function getListeners()
    {
        if (Auth::check()) {
            return [
                "echo-private:user." . Auth::id() . ",NotificationCreated" => 'incrementCount',
            ];
        }
        return [];
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->unreadCount = Notification::where('user_id', Auth::id())
                ->whereNull('read_at')
                ->count();
        }
    }

    public function incrementCount($event)
    {
        $this->unreadCount++;
    }

    public function render()
    {
        return view('livewire.notification.notification-bell');
    }
}
