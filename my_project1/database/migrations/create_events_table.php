<?php

// Создание таблицы для хранения событий
return "
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    time DATETIME NOT NULL
);
";
