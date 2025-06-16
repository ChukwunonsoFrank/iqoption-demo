<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Notifications\BroadcastSent;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class EmailBroadcast extends Component
{
    public string $subject = '';

    public string $message = '';

    public function sendBroadcast()
    {
        try {
            User::chunk(200, function (Collection $users) {
                foreach ($users as $user) {
                    $user->notify(new BroadcastSent($user->name, $this->subject, $this->message));
                }
            });
            session()->flash('success-message', 'Email broadcast sent successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.email-broadcast');
    }
}
