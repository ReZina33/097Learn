<?php
header('Content-Type: text/html; charset=utf-8'); //Прописываем кодировку для файла

$mysqli = mysqli_connect("localhost", "f0577303_0970", "123456", "f0577303_0970");//$mysqli = mysqli_connect("адрес сервера если на этом же хосте то localhost", "имя пользователя", "пароль", "имя базы данных");
if ($mysqli == false) {
  print("error" . mysqli_connect_error()) ;//"ошибка, невозможно подключиться" . mysqli_connect_error()- укажет на ошибку
  }
else {
//   print("Соединение установлено успешно");
// }
// echo "<hr>";

$name=$_POST['name']; //получаем данные
$lastname = $_POST['lastname'];
$email= trim(mb_strtolower($_POST['email'])); //06.09 меняем mb_strtolower - приводим к одному регистру в () строку пишем, пишем trim что бы исключить/обрезать пробелы, записываем данные в переменную
$pass = trim($_POST['pass']); //trim что бы исключить/обрезать пробелы
$pass = password_hash($pass, PASSWORD_DEFAULT);// функция шифрования password_hash, указываем алгоритм шифрования PASSWORD_DEFAULT, необратимо

$result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'");
//var_dump($result->num_rows);
if($result->num_rows != 0) {
print("exist");
}else{
  $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email','$pass')");
  print("ok");
}


/*$result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'"); //4 Чтобы исключить повтор регистраций , добавляем запрос, проверку по емэйлу , что б получить ответ и с ним  работать переносим  запрос в переменную 5 result, вставляем в начало
var_dump ($result->num_rows != 0){
  print ("Такой пользователь существует")
} else {
$mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email','$pass')");
print ("Пользователь зарегистрирован");
}*/
//не заработало!!!!!! 500 ошибка


/*echo " Имя:$name <br>
Фамилия $lastname <br>
Email $email<br>
Пароль:$pass";*/

}

