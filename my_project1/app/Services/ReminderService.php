<?php

namespace App\Services;

use PDO;

class ReminderService
{
    protected $db;

    public function __construct()
    {
        // Подключение к базе данных
        $this->db = new PDO('mysql:host=localhost;dbname=your_database', 'correct_username', 'correct_password');
   

    }

    public function sendReminders()
    {
        $now = new \DateTime();
        $query = $this->db->query("SELECT * FROM events WHERE time <= '{$now->format('Y-m-d H:i:s')}'");

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $event) {
            // Логика отправки уведомлений (например, через email или Telegram)
            $this->sendNotification($event['name'], $event['time']);
        }
    }

    protected function sendNotification($name, $time)
    {
        // Здесь может быть интеграция с любым сервисом для отправки уведомлений
        echo "Напоминание: {$name} в {$time}\n";
    }
}
