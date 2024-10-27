<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Подключение к базе данных
$config = include __DIR__ . '/../config/config.php';

try {
    $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Обработка добавления нового события
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['time'])) {
    $name = $_POST['name'];
    $time = $_POST['time'];

    $stmt = $pdo->prepare("INSERT INTO events (name, time) VALUES (:name, :time)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':time', $time);

    if ($stmt->execute()) {
        echo "Событие успешно добавлено!";
    } else {
        echo "Ошибка добавления события.";
    }
}

// Получение всех событий
$events = $pdo->query("SELECT * FROM events ORDER BY time ASC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Напоминалка</title>
</head>
<body>
    <h1>События</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Время</th>
        </tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['id']); ?></td>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['time']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Добавить новое событие</h2>
    <form method="POST">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="time">Время (YYYY-MM-DD HH:MM:SS):</label>
        <input type="text" id="time" name="time" required>
        <br><br>
        <button type="submit">Добавить событие</button>
    </form>
</body>
</html>
