<?php 

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;

class PostNotification extends Notification
{
    use Queueable;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        $channels = ['mail'];
        if ($notifiable->telegram_user_id) {
            $channels[] = 'telegram';
        }
        return $channels;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Новий пост на блозі')
                    ->line('Додано новий пост: ' . $this->post->title)
                    ->action('Переглянути пост', url('/posts/'.$this->post->id))
                    ->line('Дякуємо, що ви з нами!');
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegram_user_id)
            ->content("📢 Новий пост: *{$this->post->title}*\nПереглянути: " . url('/posts/'.$this->post->id))
            ->parseMode('Markdown');
    }
}