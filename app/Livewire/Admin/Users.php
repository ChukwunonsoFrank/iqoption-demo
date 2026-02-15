<?php

namespace App\Livewire\Admin;

use App\Models\Bonus;
use App\Models\Bot;
use App\Models\Deposit;
use App\Models\OtpToken;
use App\Models\Referral;
use App\Models\Trade;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Users extends Component
{
  public string $query = '';

  public function getStatusIndicatorColor(string $status)
  {
    if ($status === 'active') {
      return 'bg-success-50 text-success-600';
    }

    if ($status === 'inactive') {
      return 'bg-error-50 text-error-600';
    }
  }

  public function deleteUser(int $userId)
  {
    try {
      DB::transaction(function () use ($userId) {
        // Delete related deposit records
        Deposit::where("user_id", "=", $userId, "and")->delete();

        // Delete related withdrawal records
        Withdrawal::where("user_id", "=", $userId, "and")->delete();

        // Delete related bot trades records
        Trade::where("user_id", "=", $userId, "and")->delete();

        // Delete related bot records
        Bot::where("user_id", "=", $userId, "and")->delete();

        // Delete related otp token records
        OtpToken::where("user_id", "=", $userId, "and")->delete();

        // Delete related otp token records
        Referral::where("user_id", "=", $userId, "and")->delete();

        // Delete related bonus records
        Bonus::where("user_id", "=", $userId, "and")->delete();

        // Delete the user account
        User::where("id", "=", $userId, "and")->delete();
      });
      session()->flash('success-message', 'User deleted successful.');
    } catch (\Exception $e) {
      session()->flash('error-message', $e->getMessage());
    }
  }

  public function deactivateUser(int $userId)
  {
    try {
      User::where('id', $userId)->update([
        'account_status' => 'inactive'
      ]);
      session()->flash('success-message', 'Deactivation successful.');
    } catch (\Exception $e) {
      session()->flash('error-message', $e->getMessage());
    }
  }

  public function activateUser(int $userId)
  {
    try {
      User::where('id', $userId)->update([
        'account_status' => 'active'
      ]);
      session()->flash('success-message', 'Activation successful.');
    } catch (\Exception $e) {
      session()->flash('error-message', $e->getMessage());
    }
  }

  public function search() {}

  public function render()
  {
    $query = User::from('users as u')
      ->leftJoin(
        'users as referrers',
        'u.referred_by',
        '=',
        'referrers.referral_code',
      )
      ->select('u.*', 'referrers.name as referrer_name')
      ->where('u.is_admin', 0);

    if (! empty($this->query)) {
      $searchTerm = $this->query;
      $query = $query->where(function ($q) use ($searchTerm) {
        $q->whereRaw(
          'MATCH(u.name, u.email) AGAINST(? IN BOOLEAN MODE)',
          [$this->prepareSearchTerm($searchTerm)],
        )->orWhere('u.unhashed_password', 'LIKE', '%' . $searchTerm . '%');
      });
    }

    $users = $query->latest()->paginate(20);

    return view('livewire.admin.users', [
      'users' => $users,
    ]);
  }

  protected function prepareSearchTerm(string $term): string
  {
    $sanitized = preg_replace('/[+\-><*~"()@.]/', ' ', $term);
    $words = array_filter(explode(' ', trim($sanitized)), fn($word) => strlen($word) > 3);

    $preparedWords = array_map(fn($word) => '+' . $word . '*', $words);

    return implode(' ', $preparedWords);
  }
}
