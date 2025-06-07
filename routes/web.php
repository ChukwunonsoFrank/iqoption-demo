<?php

use App\Livewire\About;
use App\Livewire\Dashboard\Account;
use App\Livewire\Dashboard\ConfirmDeposit;
use App\Livewire\Dashboard\Deposit;
use App\Livewire\Dashboard\DepositHistory;
use App\Livewire\Dashboard\History;
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\Robot;
use App\Livewire\Dashboard\Traderoom;
use App\Livewire\Dashboard\VerifyOtp;
use App\Livewire\Dashboard\Withdraw;
use App\Livewire\Dashboard\WithdrawHistory;
use App\Livewire\Homepage;
use App\Livewire\Privacy;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    dd('optimize ran');
});

Route::get('/cache', function () {
    Artisan::call('optimize');
    dd('cached');
});

Route::get('/', Homepage::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/terms', Terms::class)->name('terms');
Route::get('/privacy', Privacy::class)->name('privacy');

Route::get('/dashboard', Index::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/history', History::class)->middleware(['auth', 'verified'])->name('dashboard.history');
Route::get('/dashboard/robot', Robot::class)->middleware(['auth', 'verified'])->name('dashboard.robot');
Route::get('/dashboard/deposit', Deposit::class)->middleware(['auth', 'verified'])->name('dashboard.deposit');
Route::get('/dashboard/deposit/confirm', ConfirmDeposit::class)->middleware(['auth', 'verified'])->name('dashboard.deposit.confirm');
Route::get('/dashboard/withdraw', Withdraw::class)->middleware(['auth', 'verified'])->name('dashboard.withdraw');
Route::get('/dashboard/withdraw/verifyotp', VerifyOtp::class)->middleware(['auth', 'verified'])->name('dashboard.withdraw.verifyotp');
Route::get('/dashboard/robot/traderoom', Traderoom::class)->middleware(['auth', 'verified'])->name('dashboard.robot.traderoom');
Route::get('/dashboard/account', Account::class)->middleware(['auth', 'verified'])->name('dashboard.account');
Route::get('/dashboard/deposithistory', DepositHistory::class)->middleware(['auth', 'verified'])->name('dashboard.deposithistory');
Route::get('/dashboard/withdrawhistory', WithdrawHistory::class)->middleware(['auth', 'verified'])->name('dashboard.withdrawhistory');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    //
});

require __DIR__.'/auth.php';
