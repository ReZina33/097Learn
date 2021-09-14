<?php
session_start(); //запускаем сессию и после работаем с ней 
header('Content-Type: text/html; charset=utf-8'); //Прописываем кодировку для файла

$mysqli = mysqli_connect("localhost", "f0577303_0970", "123456", "f0577303_0970");//$mysqli = mysqli_connect("адрес сервера если на этом же хосте то localhost", "имя пользователя", "пароль", "имя базы данных");
if ($mysqli == false) {
  print("error" . mysqli_connect_error()) ;//"ошибка, невозможно подключиться" . mysqli_connect_error()- укажет на ошибку
  }
 else {
$email= trim(mb_strtolower($_POST['email'])); //03.09 переменная [принимаем]//06.09 меняем mb_strtolower - приводим к одному регистру в () строку пишем, пишем trim что бы исключить/обрезать пробелы, записываем данные в переменную
$pass = trim($_POST['pass']); //trim что бы исключить/обрезать пробелы

$result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'"); // and `$pass`='$pass'");// добавляем проверку пароля и емэйла, запрашиваем данные 
//var_dump($result->num_rows);
//var_dump($result["pass"]); // запрашиваем пароль
$result = $result->fetch_assoc(); //06.09 $mysqli - надо преобразовать в ассоциативный массив fetch_assoc(), в объект, ключ-значение

  if (password_verify($pass, $result["pass"])) { //password_verify - проверка пароля на соответствие , 2 параметра , если пароль и хеш совпали то ок, иначе нет
        echo "ok";
        $_SESSION['name'] = $result['name']; // записываем данные в сессию, ключи можно назвать так же как переменные, достаем  данные из массива   который выше
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['id'] = $result['id'];
    } else {
        echo "user_not_found";
    }

//if($result->num_rows != 0) {
//print("exist");
//}else{
 // $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email','$pass')");
 // print("ok");
}

/*echo "Здравствуйте, ваши: <br> 
Email $email<br>
Пароль:$pass"; //выводим на экран*/
?>


