<?php
    session_start();
?>
<?php
    require_once "pokoj.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pokojestyle.css">
    <title>Pokoje</title>
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
            </div>
        </ul>
    </nav>

        <div class="container">
            <div class="pokoje">
                <div class="pokoje-2-img">
                    <img src="img/img1.jpg" alt="Pokój 2 osobowy">
                </div>
                <div class="pokoje-2-text">
                    <h2>Pokoje 2 osobowe</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa beatae, obcaecati temporibus in doloribus laboriosam incidunt consectetur nam, eaque provident doloremque fugit porro delectus adipisci molestias tenetur voluptatem? Iste.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa beatae, obcaecati temporibus in doloribus laboriosam incidunt consectetur nam, eaque provident doloremque fugit porro delectus adipisci molestias tenetur voluptatem? Iste.</p>
                    <p><?php echo $_SESSION['liczba2'];?></p>
                    <?php
                        if($_SESSION['l2']>0)
                        {
                            echo '<div class="rez"><a href="rezerwacja.php">Zarezerwuj teraz</a></div>';
    
                        }
                    ?>
                </div>
            </div>
            <div class="pokoje">
                <div class="pokoje-3-img">
                        <img src="img/img2.jpg" alt="Pokój 3 osobowy">
                    </div>
                    <div class="pokoje-3-text">
                        <h2>Pokoje 3 osobowe</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa beatae, obcaecati temporibus in doloribus laboriosam incidunt consectetur nam, eaque provident doloremque fugit porro delectus adipisci molestias tenetur voluptatem? Iste.</p>
                        <p><?php echo $_SESSION['liczba3'];?></p>
                        <?php
                        if($_SESSION['liczba3']!=0)
                        {
                            echo '<div class="rez"><a href="rezerwacja.php">Zarezerwuj teraz</a></div>';
                        }
                    ?>
                    </div>
                </div>
            <div class="pokoje">
                <div class="pokoje-4-img">
                        <img src="img/img3.jpg" alt="Pokój 4 osobowy">
                    </div>
                    <div class="pokoje-4-text">
                        <h2>Pokoje 4 osobowe</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa beatae, obcaecati temporibus in doloribus laboriosam incidunt consectetur nam, eaque provident doloremque fugit porro delectus adipisci molestias tenetur voluptatem? Iste.</p>
                        <p><?php echo $_SESSION['liczba4'];?></p>
                        <?php
                            if($_SESSION['liczba4']!=0)
                            {
                                echo '<div class="rez"><a href="rezerwacja.php">Zarezerwuj teraz</a></div>';
                            }
                        ?>
                    </div>
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