<?php

namespace App\Console;

use App\Services\ReminderService;

class ReminderCommand
{
    public function run()
    {
        // Создаем экземпляр сервиса напоминаний
        $reminderService = new ReminderService();
        // Запускаем логику отправки напоминаний
        $reminderService->sendReminders();
    }
}
