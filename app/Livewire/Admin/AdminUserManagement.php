<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminUserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all'; // all, active, suspended

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function toggleSuspend($userId)
    {
        $user = User::findOrFail($userId);
        
        // Prevent suspending self
        if ($user->id === auth()->id()) {
            return;
        }

        if ($user->is_suspended) {
            $user->is_suspended = false;
            $user->suspended_at = null;
        } else {
            $user->is_suspended = true;
            $user->suspended_at = now();
        }
        
        $user->save();
        $this->dispatch('user-updated');
    }

    public function render()
    {
        $query = User::query()
            ->withCount(['products', 'orders'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status !== 'all', function ($query) {
                if ($this->status === 'suspended') {
                    $query->where('is_suspended', true);
                } elseif ($this->status === 'active') {
                    $query->where('is_suspended', false);
                }
            })
            ->latest();

        return view('livewire.admin.admin-user-management', [
            'users' => $query->paginate(15)
        ]);
    }
}
