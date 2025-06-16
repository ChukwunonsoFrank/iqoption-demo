<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Users extends Component
{
    public string $query = '';

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === 'active') {
            return 'bg-success-50 text-success-600';
        }

        if ($status === 'inactive') {
            return 'bg-error-50 text-error-600';
        }
    }

    public function deactivateUser(int $userId)
    {
        try {
            User::where('id', $userId)->update([
                'account_status' => 'inactive'
            ]);
            session()->flash('success-message', 'Deactivation successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function activateUser(int $userId)
    {
        try {
            User::where('id', $userId)->update([
                'account_status' => 'active'
            ]);
            session()->flash('success-message', 'Activation successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function search() {}

    public function render()
    {
        $users = empty($this->query) ? User::where('is_admin', 0)->latest()->paginate(20) : User::search($this->query)->paginate(20);
        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }
}
