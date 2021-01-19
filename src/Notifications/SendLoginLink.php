<?php

namespace MBober35\Starter\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use MBober35\Starter\Facades\LoginGenerator;
use MBober35\Starter\Models\LoginLink;

class SendLoginLink extends Notification implements ShouldQueue
{
    use Queueable;

    protected $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(LoginLink $link)
    {
        $this->link = $link;
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
        return (new MailMessage)
            ->subject('Одноразовый вход на сайт')
            ->greeting('Здравствуйте!')
            ->line('Вы получили это письмо потому что Мы получили запрос на одноразовый вход на сайт.')
            ->action('Войти', LoginGenerator::getUrl($this->link))
            ->line('Если Вы не отправляли запроса, игнорируйте это письмо.');
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
