<?php

namespace App;

spl_autoload_register(function ($class)
{
    // префикс пространства имен
    $prefix = 'App\\';
    // базовый каталог для префикса пространства имен
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
    // использует ли класс префикс пространства имен
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // нет, переходим к следующему зарегистрированному автоподгрузчику
        return;
    }
    // получаем относительное имя класса
    $relativeClass = substr($class, $len);
    // создаем имя файла
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
    // если файл существует, подключаем его
    if (file_exists($file)) {
        require $file;
    }
});

