<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Dashboard\Partials\AssetIndicator;
use App\Models\Bot;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('components.layouts.app')]

class Traderoom extends Component
{
  #[Locked]
  public $isProcessing = false;

  public $activeBot;

  public $timerCheckpoint;

  public $amount;

  public string $accountType = '';

  public string $strategy = '';

  public string $profitLimit = '';

  public string $profit = '';

  public string $asset = '';

  public string $assetIcon = '';

  public string $sentiment = '';

  public function mount()
  {
    if (session()->has('message')) {
      $message = session()->get('message');
      $this->dispatch('robot-created', message: $message)->self();
    }

    $this->activeBot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->first();

    if (is_null($this->activeBot)) {
      $this->redirectRoute('dashboard.robot');
      return;
    }

    $this->amount = $this->normalizeAmount($this->activeBot['amount']);
    $this->accountType = $this->activeBot['account_type'] === 'demo' ? 'Demo account' : 'Live account';

    $strategy = Strategy::find($this->activeBot['strategy']);

    $this->strategy = $strategy['name'];
    $this->profitLimit = $strategy['max_roi'];
    $this->profit = $this->normalizeAmount($this->activeBot['profit']);
    $this->asset = $this->activeBot['asset'];
    $this->assetIcon = $this->activeBot['asset_image_url'];
    $this->sentiment = $this->activeBot['sentiment'];
    $this->timerCheckpoint = $this->activeBot['timer_checkpoint'];
  }

  public function normalizeAmount(int $amount): int | float
  {
    return $amount / 100;
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  public function refreshAssetData(): void
  {
    $activeBot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->first();

    if (!$activeBot) {
      return;
    }

    $this->profit = $this->normalizeAmount($activeBot['profit']);
    $this->asset = $activeBot['asset'];
    $this->assetIcon = $activeBot['asset_image_url'];
    $this->sentiment = $activeBot['sentiment'];
    $data = [
      'asset' => $activeBot['asset'],
      'assetImageUrl' => $activeBot['asset_image_url'],
      'assetClass' => $activeBot['asset_class'],
      'isBotActive' => true
    ];
    $this->dispatch('asset-updated', data: $data)->to(AssetIndicator::class);
    $this->timerCheckpoint = $activeBot['timer_checkpoint'];
  }

  public function stopRobot(): void
  {
    try {
      if ($this->isProcessing) {
        return;
      }

      $this->isProcessing = true;

      DB::transaction(function () {
        // Lock the bot record to prevent concurrent stop operations
        $bot = Bot::where('id', $this->activeBot['id'])->lockForUpdate()->first();

        if (!$bot) {
          throw new \Exception('Bot not found');
        }

        // Check if bot is still active
        if ($bot->status !== 'active') {
          throw new \Exception('Bot is not active');
        }

        // Lock the user record to prevent race conditions on balance updates
        $user = User::where('id', auth()->user()->id)->lockForUpdate()->first();

        if (!$user) {
          throw new \Exception('User not found');
        }

        $accountType = $bot->account_type;
        $amount = $bot->amount;
        $profit = $bot->profit;

        if ($accountType === "demo") {
          $currentBalance = $user->demo_balance;
          $newBalance = $currentBalance + $amount + $profit;

          $user->update(['demo_balance' => $newBalance]);
          $bot->update(['status' => 'stopped']);
        } elseif ($accountType === "live") {
          $currentBalance = $user->live_balance;
          $newBalance = $currentBalance + $amount + $profit;

          $user->update(['live_balance' => $newBalance]);
          $bot->update(['status' => 'stopped']);
        } else {
          throw new \Exception('Invalid account type');
        }
      });

      session()->flash('message', 'Robot has stopped trading');
      $this->redirectRoute('dashboard.robot');
    } catch (\Exception $e) {
      $this->dispatch('stop-robot-error', message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.traderoom');
  }
}
