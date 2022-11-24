<?php
    require_once "zmienne.php";

    $conn = new mysqli($host,$user,$password,$name);
    if($conn-> connect_errno!=0)
    {
        echo "Error: ",$conn->connect_errno;
    }
    else
    { 
        $rezultat = $conn->query("SELECT * FROM pokoje WHERE typ_pokoju='2 osobowe' AND status='niezarezerwowany'");
        if($rezultat->num_rows>0)
        {
            $_SESSION['liczba2'] = "Aktualnie wolnych pokoi jest: ".$rezultat->num_rows;
            $_SESSION['l2'] = $rezultat->num_rows;
        }
        else
        {
            $_SESSION['liczba2'] = "Nie ma wolnych pokoi ";
            $_SESSION['l2'] = 0;
        }

        $rezultat = $conn->query("SELECT * FROM pokoje WHERE typ_pokoju='3 osobowe' AND status='niezarezerwowany'");
        $_SESSION['liczba3'] = $rezultat->num_rows;
        if($rezultat->num_rows>0)
        {
            $_SESSION['liczba3'] = "Aktualnie wolnych pokoi jest: ".$rezultat->num_rows;
        }
        else
        {
            $_SESSION['liczba3'] = "Nie ma wolnych pokoi ";
        }
        $rezultat = $conn->query("SELECT * FROM pokoje WHERE typ_pokoju='4 osobowe' AND status='niezarezerwowany'");
        $_SESSION['liczba4'] = $rezultat->num_rows;
        if($rezultat->num_rows>0)
        {
            $_SESSION['liczba4'] = "Aktualnie wolnych pokoi jest: ".$rezultat->num_rows;
        }
        else
        {
            $_SESSION['liczba4'] = "Nie ma wolnych pokoi ";
        }
        $conn->close();
    }
?>