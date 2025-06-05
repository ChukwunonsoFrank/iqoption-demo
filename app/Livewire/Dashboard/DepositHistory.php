<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class DepositHistory extends Component
{
    public function mount()
    {
        if (session()->has('message')) {
            $message = session()->get('message');
            $this->dispatch('deposit-created', message: $message)->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.deposit-history');
    }
}
