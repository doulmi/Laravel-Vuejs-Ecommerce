<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

  /**
   * The password reset token.
   *
   * @var string
   */
  public $token;

  /**
   * Create a notification instance.
   *
   * @param  string  $token
   * @return void
   */
  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
   * Get the notification's channels.
   *
   * @param  mixed  $notifiable
   * @return array|string
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Build the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject('Alphabeille重置密码')
      ->line('您收到此邮件是因为您发送了重置密码的请求')
      ->action('重置密码', url('password/reset', $this->token) . '?email=' . $notifiable->email)
      ->line('如果并非您本身发送该请求，无需进行任何后续步骤');
  }
}
