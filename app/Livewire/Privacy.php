<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

#[Title('Privacy Policy')]

class Privacy extends Component
{
    public function render()
    {
        return view('livewire.privacy');
    }
}
