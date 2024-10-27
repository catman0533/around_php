<?php

$config = include __DIR__ . '/../config/config.php';

try {
    $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to the database!";
    
    // Запуск миграций
    $migration = include __DIR__ . '/migrations/create_events_table.php';
    $pdo->exec($migration);
    echo "Table 'events' created successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
