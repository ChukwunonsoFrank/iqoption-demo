<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class Index extends Component
{
    public string $activeBotTickerSymbol = '';

    public function mount()
    {
        $justLoggedIn = Session::pull('just_logged_in', false);

        $activeBot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->first();

        $this->activeBotTickerSymbol = $activeBot['asset_ticker'];

        if ($justLoggedIn && $activeBot) {
            $this->redirectRoute('dashboard.robot.traderoom');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
