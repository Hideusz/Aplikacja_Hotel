<?php
    session_start();
?>
<?php

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $check_in = $_POST['start'];
    $check_out =  $_POST['koniec'];
    $pokoj = $_POST['pokoj'];
    $id = $_SESSION['id'];
    $data= date("Y-m-d");
    
    if(strlen($imie) < 3)
    {
        $_SESSION['blad'] = "Wpisz poprawne imię";
        header('location: rezerwacja.php');
        exit();
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
    {
        $_SESSION['blad'] = "Wpisz poprawny email";
        header('location: rezerwacja.php');
        exit();
    }
    require_once "zmienne.php";
    $conn = new mysqli($host,$user,$password,$name);
    if($conn-> connect_errno!=0)
    {
        echo "Error: ",$conn->connect_errno;
    }
    else
    {

        $imie = htmlentities($imie);
        $nazwisko = htmlentities($nazwisko);
        $email = htmlentities($email);
        $telefon = htmlentities($telefon);
        $check_in = htmlentities($check_in);
        $check_out = htmlentities($check_out);
        $pokoj = htmlentities($pokoj);
        $data = htmlentities($data);

        $imie = $conn-> real_escape_string($imie);
        $nazwisko = $conn-> real_escape_string($nazwisko);
        $email = $conn-> real_escape_string($email);
        $telefon = $conn-> real_escape_string($telefon);
        $check_in = $conn-> real_escape_string($check_in);
        $check_out = $conn-> real_escape_string($check_out);
        $pokoj = $conn-> real_escape_string($pokoj);
        $data = $conn-> real_escape_string($data);

        if(isset($_POST['pokoj']))
        {
            $rezultat = $conn->query("SELECT * FROM pokoje WHERE typ_pokoju='$pokoj' AND status='niezarezerwowany'");
            if($rezultat->num_rows > 0)
            {
                if($check_in>=$data)
                {
                    if($check_in<$check_out)
                    {
                        $rezultat = $conn->query("SELECT id FROM pokoje WHERE typ_pokoju='$pokoj'AND status='niezarezerwowany'");
                        $row = $rezultat->fetch_assoc();
                        $numer = $row['id'];
                        $rezultat = $conn->query("INSERT INTO `rezerwacja` VALUES (NULL,'$imie','$nazwisko','$email','$telefon','$check_in','$check_out','$numer')");
                        $rezultat = $conn->query("UPDATE `pokoje` SET `status`='zarezerwowany', `id_uzytkownika`='$id' WHERE `id` = '$numer'");
                        $_SESSION['show'] = "udalo";
                        header("location: index.php");
                    }
                    else
                    {
                        $_SESSION['blad'] = "Zła data zameldowania i wymeldowania";
                        header('location: rezerwacja.php');
                        exit();
                    }
                }
                else
                {
                    $_SESSION['blad'] = "Zła data zameldowania";
                    header('location: rezerwacja.php');
                    exit();
                }
            }
            else
            {
                $_SESSION['blad'] = "Brak wolnych pokoji";
                header('location: rezerwacja.php');
                exit();
            }
        }
        else
            {
                $_SESSION['blad'] = "Wybierz pokój";
                header('location: rezerwacja.php');
                exit();
            }
    }
?>