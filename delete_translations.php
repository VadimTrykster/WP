<?php
// Пути к папкам с переводами
$paths = [
    __DIR__ . '/wp-content/languages',
    __DIR__ . '/wp-content/languages/plugins'
];

// Языки, которые нужно оставить
$allowed_languages = ['en_US', 'ru_RU', 'uk'];

foreach ($paths as $path) {
    if (!is_dir($path)) {
        echo "Папка $path не найдена. Пропускаем...\n";
        continue;
    }

    // Сканируем файлы в папке
    $files = glob($path . '/*.*');
    
    foreach ($files as $file) {
        // Проверяем, относится ли файл к разрешённым языкам
        $is_allowed = false;
        foreach ($allowed_languages as $lang) {
            if (strpos($file, $lang) !== false) {
                $is_allowed = true;
                break;
            }
        }
        // Если язык не разрешён, удаляем файл
        if (!$is_allowed) {
            unlink($file);
            echo "Удалён файл: $file\n";
        }
    }
}

echo "Ненужные файлы переводов в корне и плагинов удалены.";