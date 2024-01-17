<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailProvider implements Provider
{
  private $user;
  private $mailable;

  public function __construct(User $user, Mailable $mailable) {
    $this->user = $user;
    $this->mailable = $mailable;
  }
  public function send()
  {
    // dd($this->mailable);
    // dd($this->user);
    return Mail::to($this->user)->cc('garsi.soltani@gmail.com')->send($this->mailable);
  }
}