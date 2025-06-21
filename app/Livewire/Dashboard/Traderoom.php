<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Dashboard\Partials\AssetIndicator;
use App\Models\Bot;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]

class Traderoom extends Component
{
    public Bot $activeBot;

    public bool $isBotSearchingForSignal;

    public bool $isStopRobotConfirmationModalOpen = false;

    public $amount;

    public string $accountType = '';

    public string $strategy = '';

    public string $profitLimit = '';

    public string $timer = '';

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

        $this->amount = $this->normalizeAmount($this->activeBot['amount']);
        $this->accountType = $this->activeBot['account_type'] === 'demo' ? 'Demo account' : 'Live account';

        $strategy = Strategy::find($this->activeBot['strategy']);

        $this->strategy = $strategy['name'];
        $this->profitLimit = $strategy['max_roi'];
        $this->profit = $this->normalizeAmount($this->activeBot['profit']);
        $this->asset = $this->activeBot['asset'];
        $this->assetIcon = $this->activeBot['asset_image_url'];

        $timeLeft = $this->calculateTimeLeftTillNextCheckpoint($this->activeBot['timer_checkpoint']);
        $formatted = $this->formatTimeLeft($timeLeft['minutes'], $timeLeft['seconds']);
        $this->timer = $formatted;

        $this->sentiment = $this->activeBot['sentiment'];
    }

    public function toggleStopRobotConfirmationModal()
    {
        $this->isStopRobotConfirmationModalOpen = !$this->isStopRobotConfirmationModalOpen;
    }

    public function normalizeAmount(int $amount): int | float
    {
        return $amount / 100;
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function calculateTimeLeftTillNextCheckpoint(int $checkpoint): array
    {
        $difference = $checkpoint - now()->getTimestampMs();
        Log::info($difference);

        if (0 > $difference) {
            return [
                'minutes' => 0,
                'seconds' => 0
            ];
        }

        $minutes = floor(($difference / (1000 * 60)) % 60);
        $seconds = floor(($difference / 1000) % 60);

        return [
            'minutes' => $minutes,
            'seconds' => $seconds
        ];
    }

    public function formatTimeLeft(int $minutes, int $seconds): string
    {
        $minuteString = 0;
        $secondString = 0;

        if ($minutes < 10) {
            $minuteString = '0' . strval($minutes);
        } else {
            $minuteString = strval($minutes);
        }

        if ($seconds < 10) {
            $secondString = '0' . strval($seconds);
        } else {
            $secondString = strval($seconds);
        }

        return $minuteString . ':' . $secondString;
    }

    public function refreshAssetData(): void
    {
        $this->activeBot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->first();
        $this->profit = $this->normalizeAmount($this->activeBot['profit']);
        $this->asset = $this->activeBot['asset'];
        $this->assetIcon = $this->activeBot['asset_image_url'];
        $this->sentiment = $this->activeBot['sentiment'];
        $data = [
            'asset' => $this->asset,
            'assetImageUrl' => $this->assetIcon,
            'assetClass' => $this->activeBot['asset_class'],
            'isBotActive' => true
        ];
        $this->dispatch('asset-updated', data: $data)->to(AssetIndicator::class);
    }

    public function refreshTimer(): void
    {
        $this->refreshAssetData();
        $timeLeft = $this->calculateTimeLeftTillNextCheckpoint($this->activeBot['timer_checkpoint']);
        $formatted = $this->formatTimeLeft($timeLeft['minutes'], $timeLeft['seconds']);
        $this->timer = $formatted;
        $this->toggleSearchingForSignals($timeLeft['minutes'], $timeLeft['seconds']);
    }

    public function toggleSearchingForSignals(int $minutes, int $seconds): void
    {
        if ($minutes === 5 && $seconds > 0) {
            $this->isBotSearchingForSignal = true;
        }

        if ($minutes === 5 && $seconds === 0) {
            $this->isBotSearchingForSignal = false;
        }

        if ($minutes <= 4) {
            $this->isBotSearchingForSignal = false;
        }

        if ($minutes === 0 && $seconds === 0) {
            $this->isBotSearchingForSignal = true;
        }
    }

    public function stopRobot(): void
    {
        try {
            $accountType = $this->activeBot['account_type'];

            if ($accountType === "demo") {
                $amount = $this->normalizeAmount($this->activeBot['amount']);
                $currentBalance = $this->normalizeAmount(auth()->user()->demo_balance);
                $profit = $this->normalizeAmount($this->activeBot['profit']);
                $newBalance = $currentBalance + $amount + $profit;
                $serialized = $this->serializeAmount($newBalance);

                DB::transaction(function () use ($serialized) {
                    Bot::where('id', $this->activeBot['id'])->update(['status' => 'stopped']);
                    User::where('id', auth()->user()->id)->update(['demo_balance' => $serialized]);
                });
            }

            if ($accountType === "live") {
                $amount = $this->normalizeAmount($this->activeBot['amount']);
                $currentBalance = $this->normalizeAmount(auth()->user()->live_balance);
                $profit = $this->normalizeAmount($this->activeBot['profit']);
                $newBalance = $currentBalance + $amount + $profit;
                $serialized = $this->serializeAmount($newBalance);

                DB::transaction(function () use ($serialized) {
                    Bot::where('id', $this->activeBot['id'])->update(['status' => 'stopped']);
                    User::where('id', auth()->user()->id)->update(['live_balance' => $serialized]);
                });
            }

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
