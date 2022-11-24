<?php
    session_start();
?>
<?php

if(isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $email = $_POST['email'];
        $powhaslo = $_POST['haslo1'];

        $walidacja = true;

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        {
            $walidacja = false;
            $_SESSION['blad'] = "Wpisz poprawny email";
            header('Location: rejestracja.php');
            exit();
        }

        if(!ctype_alnum($login))
        {
            $walidacja = false;
            $_SESSION['blad'] = "Login musi się składać z conajmniej 1 cyfry(bez polskich znaków)";
            header('Location: rejestracja.php');
            exit();
        }
        if(empty($_POST['haslo']) && empty($_POST['haslo1']))
        {
            $_SESSION['blad'] = "Wpisz hasło";
            header('location: rejestracja.php');
            exit();
        }

    }
    if($walidacja)
    {
        require_once "zmienne.php";
        $conn = new mysqli($host,$user,$password,$name);

        if($conn-> connect_errno!=0)
        {
            echo "Error: ",$conn->connect_errno;
        }
        else
        {
            

                $login = htmlentities($login);
                $email = htmlentities($email);
                $haslo = htmlentities($haslo);
                $powhaslo = htmlentities($powhaslo);

                $login = $conn-> real_escape_string($login);
                $email = $conn-> real_escape_string($email);
                $haslo = $conn-> real_escape_string($haslo);
                $powhaslo = $conn-> real_escape_string($powhaslo);

                $rezultat = $conn->query("SELECT * FROM `uzytkownik` WHERE login='$login'");
                if($rezultat->num_rows==0)
                {
                    $blogin = 0;
                }
                else
                {
                    $blogin = 1;
                }
                $rezultat = $conn->query("SELECT * FROM `uzytkownik` WHERE email='$email'");
                if($rezultat->num_rows==0)
                {
                    $bmail = 0;
                }
                else
                {
                    $bmail = 1;
                }

                if($blogin == 0 && $bmail == 0)
                {
                    if($powhaslo==$haslo)
                    {
                        unset($_SESSION['blad']);
                        $haslo = password_hash($haslo, PASSWORD_DEFAULT);
                        $rezultat = $conn->query("INSERT INTO `uzytkownik`(`login`, `haslo`, `email`) VALUES ('$login','$haslo','$email')");
                        header('Location: logowanie.php');
                    }
                    else
                    {
                        $_SESSION['blad'] = 'Wprowadź to samo hasło';
                        header('Location: rejestracja.php');
                    }
                }
                else if($blogin == 1 && $bmail == 0)
                {
                    //login zle mail git
                    $_SESSION['blad'] = 'Login zajęty';
                    header('Location: rejestracja.php');
                }
                else if($blogin == 0 && $bmail == 1)
                {
                    //login git mail zle
                    $_SESSION['blad'] = 'Ten adres email jest już używany';
                    header('Location: rejestracja.php');
                }
                else if($blogin == 1 && $bmail == 1)
                {
                    //zle wszystko
                    $_SESSION['blad'] = 'Takie konto już istnieje';
                    header('Location: rejestracja.php');
                }
                $conn->close();
        }
    }

?>