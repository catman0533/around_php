<?php

use App\Console\ReminderCommand;

require_once __DIR__ . '/vendor/autoload.php';

$pid = pcntl_fork();

if ($pid == -1) {
    die('Не удалось создать процесс');
} elseif ($pid) {

    // Родительский процесс
    exit;
} else {
    // Дочерний процесс (демон)
    while (true) {
        $reminderCommand = new ReminderCommand();
        $reminderCommand->run();
        sleep(60); // Выполняем напоминания каждые 60 секунд
    }
}
