<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <title>Личный кабинет</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 1.5rem;
        }

        .edit-btn {
            color: red;
            cursor: pointer;
        }

        .edit-btn:hover {
            color: darkred;
        }

        .save-btn {
            color: green;
            cursor: pointer;
        }

        .save-btn:hover {
            color: greenyellow;
        }

        .cancel-btn {
            color: burlywood;
            cursor: pointer;
        }

        .cancel-btn:hover {
            color: chocolate;
        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <p> Имя: <span><?= $_SESSION['name'] ?></span>
            <span class="edit-btn">[Изменить]</span>
            <span class="save-btn" hidden >[Сохранить]</span>
            <span class="cancel-btn" hidden>[Отменить]</span>
        </p>

        <p> Фамилия: <span><?= $_SESSION['lastname'] ?></span>
            <span class="edit-btn">[Изменить]</span>
            <span class="save-btn" hidden >[Сохранить]</span>
            <span class="cancel-btn" hidden>[Отменить]</span>
        </p>


        <p> E-mail: <span><?= $_SESSION['email'] ?></span></p>

        <p> Id: <span><?= $_SESSION['id'] ?></span></p>
    </div>


    <script>
        let edit_buttons = document.querySelectorAll(".edit-btn");
        let save_buttons = document.querySelectorAll(".save-btn");
        let cancel_buttons = document.querySelectorAll(".cancel-btn");


        for (let i = 0; i < edit_buttons.length; i++) {
            let inputValue = edit_buttons[i].previousElementSibling.innerText;
            edit_buttons[i].addEventListener("click", (e) => {
                edit_buttons[i].previousElementSibling.innerHTML = `<input type="text" value="${inputValue}">`;
                save_buttons[i].hidden = false;
                cancel_buttons[i].hidden = false;
                edit_buttons[i].hidden = true;
            });

            cancel_buttons[i].addEventListener("click", (e) => {
                edit_buttons[i].hidden = false;
                save_buttons[i].hidden = true;
                cancel_buttons[i].hidden = true;
                edit_buttons[i].previousElementSibling.innerHTML = inputValue;
            });

            save_buttons[i].addEventListener("click", async () => {
                let newInputValue = edit_buttons[i].previousElementSibling.firstElementChild.value;

                save_buttons[i].hidden = true;
                cancel_buttons[i].hidden = true;
                edit_buttons[i].hidden = false;
                edit_buttons[i].previousElementSibling.innerText = newInputValue;
                let formData = new FormData();
                formData.append("value", newInputValue);
                formData.append("item", save_buttons[i].dataset.item);

                let response = await fetch('php/lk_obr6.php', {
                    method: 'POST',
                    body: formData,
                });

            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>