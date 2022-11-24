<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('location: logowanie.php');
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kontostyle.css">
    <title>Konto</title>
</head>
<body>
    <nav>
        <div class="logo">
        <h1>Zajazd u klatki<p>
        </p><div id="zegarek"></div></h1>
        </div>
        <ul class="menu">
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="pokoje.php">Pokoje</a></li>
            <li><a href="rezerwacja.php">Rezerwacja</a></li>
            <li><a href="konto.php">
                <?php
                    if(isset($_SESSION['user']))
                    {
                        echo $_SESSION['user'];
                    }
                    else
                    {
                        echo "Konto";
                    }
                ?>
                </a></li>
            <li>
                <?php
                if(isset($_SESSION['user']))
                {
                    echo "<a href='wylog.php'>Wyloguj</a>";
                }
                else
                {
                    echo "<a href='logowanie.php'>Zaloguj</a>";
                }
                        
                ?>
                </li>
        </ul>
    </nav>
      <div class="container">
        <div class="reset">
            <a href="reset.php">Zmień hasło</a>
            <a href="email.php">Zmień emial</a>
            <a href="usun.php">Usuń konto</a>
        </div>
        <div class="pokoje">
            <a href="twoje-pokoje.php">Twoje pokoje</a>
        </div>
      </div>          
      <footer class="footer">
            <p>&copy 2022 Artur Klatka</p>
        </footer>
    <script type="text/javascript">

        function zegar() {
        var data = new Date();
        var godzina = data.getHours();
        var min = data.getMinutes();
        var sek = data.getSeconds();
        var terazjest = ""+godzina+((min<10)?":0":":")+min+((sek<10)?":0":":")+sek;
        document.getElementById("zegarek").innerHTML = terazjest;
        setTimeout("zegar()", 1000); }
        zegar();
    </script>
</body>
</html>