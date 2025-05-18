<?php

use App\Livewire\About;
use App\Livewire\Dashboard\History;
use App\Livewire\Dashboard\Index;
use App\Livewire\Homepage;
use App\Livewire\Privacy;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/terms', Terms::class)->name('terms');
Route::get('/privacy', Privacy::class)->name('privacy');

Route::get('/dashboard', Index::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/history', History::class)->middleware(['auth', 'verified'])->name('dashboard.history');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
