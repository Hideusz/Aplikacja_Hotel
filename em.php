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
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    if($email == "" || $email2 == "" || $email2 == "")
    {
        $_SESSION['blad'] = 'Wypełnij wszystkie pola';
        header('Location: email.php');
        exit();
    }
    else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || filter_var($email1, FILTER_VALIDATE_EMAIL) == false || filter_var($email2, FILTER_VALIDATE_EMAIL) == false)
    {
        $_SESSION['blad'] = "Wpisz poprawny email";
        header('Location: email.php');
        exit();
    }
    else
    {
        $email = htmlentities($email);
        $email1 = htmlentities($email1);
        $email2 = htmlentities($email2);
        $email = $conn-> real_escape_string($email);
        $email1 = $conn-> real_escape_string($email1);
        $email2 = $conn-> real_escape_string($email2);
        
        $rezultat = $conn->query("SELECT * FROM `uzytkownik` WHERE email='$email'");
        if($rezultat->num_rows > 0)
        {
            if($email1==$email2)
            {
                unset($_SESSION['blad']);
                $rezultat = $conn->query("UPDATE `uzytkownik` SET email='$email1' WHERE email='$email'");
                header('Location: wylog.php');
            }
            else
            {
                $_SESSION['blad'] = 'Wpisane emaile się różnią';
                header('Location: email.php');
            }
        }
        else
        {
            $_SESSION['blad'] = 'Emaila nie ma w bazie danych';
            header('Location: email.php');
        }
    }
    $conn->close();
}
?>