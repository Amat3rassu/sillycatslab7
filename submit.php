<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $favorite_cat = htmlspecialchars($_POST['favorite_cat']);
    $favorite_place = htmlspecialchars($_POST['favorite_place']);
    $date_time = date("Y-m-d_H-i-s");
    $directory = "survey";

    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    $filename = "$directory/survey_response_$date_time.txt";
    $content = "Ім'я: $name\nEmail: $email\nУлюблений кіт: $favorite_cat\nУлюблене місце для відпочинку: $favorite_place\nДата та час заповнення: $date_time\n";

    if (file_put_contents($filename, $content) !== false) {
     
        echo json_encode([
            'status' => 'success',
            'message' => 'Дякуємо за участь у опитуванні!',
            'date_time' => $date_time
        ]);
    } else {
        
        echo json_encode([
            'status' => 'error',
            'message' => 'Не вдалося створити файл.'
        ]);
    }
}
?>