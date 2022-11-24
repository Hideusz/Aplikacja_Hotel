<?php
    session_start();
?>
<?php

require_once "zmienne.php";
$conn = new mysqli($host,$user,$password,$name);

if($conn-> connect_errno!=0)
{
    echo "Error: ",$conn->connect_errno;
}
else
{
    $email = $_POST['email'];
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    if($email == "" || $haslo1 == "" || $haslo2 == "")
    {
        $_SESSION['blad'] = 'Wypełnij wszystkie pola';
        header('Location: reset.php');
    }
    else
    {
        $email = htmlentities($email);
        $haslo1 = htmlentities($haslo1);
        $haslo2 = htmlentities($haslo2);
        $email = $conn-> real_escape_string($email);
        $haslo1 = $conn-> real_escape_string($haslo1);
        $haslo2 = $conn-> real_escape_string($haslo2);
        
        $rezultat = $conn->query("SELECT * FROM `uzytkownik` WHERE email='$email'");
        if($rezultat->num_rows > 0)
        {
            if($haslo1==$haslo2)
            {
                unset($_SESSION['blad']);
                $haslo1 = password_hash($haslo1, PASSWORD_DEFAULT);
                $rezultat = $conn->query("UPDATE `uzytkownik` SET haslo='$haslo1' WHERE email='$email'");
                header('Location: wylog.php');
            }
            else
            {
                $_SESSION['blad'] = 'Wpisane hasła się różnią';
                header('Location: reset.php');
            }
        }
        else
        {
            $_SESSION['blad'] = 'Emaila nie ma w bazie danych';
            header('Location: reset.php');
        }
    }
    $conn->close();
}
?>