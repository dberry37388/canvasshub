<?php

namespace App\Notifications\Users;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActivateEmailNotification extends Notification
{
    use Queueable;
    
    /**
     * @var \App\User
     */
    protected $user;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = app('url')
            ->signedRoute('activate-email', ['user' => $this->user->id]);
        
        return (new MailMessage)
            ->subject('Activate your email address')
            ->line('You have successfully created your CanvassHub account. Please click the link below to verify your email address and complete your registration.')
            ->action('Verify your email', $url)
            ->line('Thank you for using our CanvassHub!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
