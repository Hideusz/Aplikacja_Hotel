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
    $login = $_POST['login'];
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    if($login == "" || $haslo1 == "" || $haslo2 == "")
    {
        $_SESSION['blad'] = 'Wypełnij wszystkie pola';
        header('Location: usun.php');
    }
    else
    {
        $login = htmlentities($login);
        $haslo1 = htmlentities($haslo1);
        $haslo2 = htmlentities($haslo2);
        $login = $conn-> real_escape_string($login);
        $haslo1 = $conn-> real_escape_string($haslo1);
        $haslo2 = $conn-> real_escape_string($haslo2);
        
        $rezultat = $conn->query("SELECT * FROM `uzytkownik` WHERE login='$login'");
        if($rezultat->num_rows == 1)
        {
            $zapytanie = "SELECT haslo FROM uzytkownik WHERE  login='$login'";
            $wynik = $conn ->query($zapytanie);
            $rekord = $wynik->fetch_array();
            if(password_verify($haslo1,$rekord['haslo']))
            {
                if($haslo1==$haslo2)
                {
                    unset($_SESSION['blad']);
                    $rezultat = $conn->query("DELETE FROM `uzytkownik` WHERE login='$login'");
                    header('Location: wylog.php');
                }
                else
                {
                    $_SESSION['blad'] = 'Różne hasła';
                    header('Location: usun.php');
                }
                
            }
            else
            {
                $_SESSION['blad'] = 'Złe hasło';
                header('Location: usun.php');
            }
        }
        else
        {
            $_SESSION['blad'] = 'Logina nie ma w bazie danych';
            header('Location: usun.php');
        }
    }
    $conn->close();
}
?>