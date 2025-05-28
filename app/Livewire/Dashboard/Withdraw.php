<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class Withdraw extends Component
{
    public function render()
    {
        return view('livewire.dashboard.withdraw');
    }
}
