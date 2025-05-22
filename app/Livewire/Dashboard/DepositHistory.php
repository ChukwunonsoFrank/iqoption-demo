<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class DepositHistory extends Component
{
    public function render()
    {
        return view('livewire.dashboard.deposit-history');
    }
}
