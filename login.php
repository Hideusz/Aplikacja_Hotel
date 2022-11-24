<?php
    session_start();
?>
<?php

if(isset($_POST['submit']))
{
    if(empty($_POST['login']) || empty($_POST['haslo']))
    {
        $_SESSION['blad'] = "Wpisz login i hasło";
        header('location: logowanie.php');
        exit();
    }
}

$login = $_POST['login'];
$haslo = $_POST['haslo'];
require_once "zmienne.php";

$conn = new mysqli($host,$user,$password,$name);
if($conn-> connect_errno!=0)
{
    echo "Error: ",$conn->connect_errno;
}
else
{
    

    $login = htmlentities($login);
    $haslo = htmlentities($haslo);
    $login = $conn-> real_escape_string($login);
    $haslo = $conn-> real_escape_string($haslo);

    if($rezultat = $conn->query("SELECT * FROM uzytkownik WHERE login='$login'"))
        {
            if($rezultat->num_rows == 1)
             {
                $zapytanie = "SELECT haslo FROM uzytkownik WHERE  login='$login'";
                $wynik = $conn ->query($zapytanie);
                $rekord = $wynik->fetch_array();
                if(password_verify($haslo,$rekord['haslo']))
                {
                    $rezultat = $conn->query("SELECT id FROM uzytkownik WHERE login='$login'");
                    $row = $rezultat->fetch_array();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $login;
                    header('location: index.php');
                }
                else
                {
                    $_SESSION['blad'] = "Błędne hasło";
                    header('location: logowanie.php');
                    exit();
                }
                $conn->close();
            }
            else
            {
                $_SESSION['blad'] = "Błędny login";
                header('location: logowanie.php');
                exit();
            }
            $conn->close();
    }
}
?>


