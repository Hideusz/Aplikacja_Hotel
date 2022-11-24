<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('location: logowanie.php');
    }
    $test = $_SESSION['user'];
    require_once "zmienne.php";
    $conn = new mysqli($host,$user,$password,$name);
    $rezultat = $conn->query("SELECT email FROM uzytkownik WHERE login='$test'");
    $row = $rezultat->fetch_array();
    $email = $row['email'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rezerwacjastyle.css">
    <title>Rezerwacja</title>
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
            <form action="rez.php" method="POST">
                <h2>Rezerwacja pokoji</h2>
                <div class="kreska"></div>
                <div class="dane">
                    <label for="dane">Dane</label>
                    <div class="imie">
                        <input type="text" name="imie" placeholder="Imię">
                    </div>
                    <div class="nazwisko">
                        <input type="text" name="nazwisko" placeholder="Nazwisko">
                    </div>
                </div>
                <div class="kontakt">
                    <div class="email">
                        <label for="kontakt">Email</label><br>
                        <input type="email" name="email" value="<?php echo $email ?>" readonly>
                    </div>
                    <div class="telefon">
                        <label for="kontakt">Telefon</label><br>
                        <input type="tel" name="telefon" pattern="[0-9]{9}">
                    </div>
                </div>
                <div class="czas">
                    <div class="check-in">
                        <label for="check-in">Zameldowanie</label><br>
                        <input type="date" name="start">
                    </div>
                    <div class="check-out">
                        <label for="check-out">Wymeldowanie</label><br>
                        <input type="date" name="koniec">
                    </div>
                </div>
                <div class="room">
                    <label for="pokoje">Typ pokoju</label><br>
                    <div class="room2">
                        <input type="radio" name="pokoj" id="room2" value="2 osobowe"><p>2 osobowy</p><br>
                    </div>
                    <div class="room3">
                        <input type="radio" name="pokoj" id="room3" value="3 osobowe"><p>3 osobowy</p><br>
                    </div>
                    <div class="room4">
                        <input type="radio" name="pokoj" id="room4" value="4 osobowe"><p>4 osobowy</p><br>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="submit"  value="Wyślij" class="przycisk">
                </div>
                <?php if(isset($_SESSION['blad'])): ?>
                        <div class="error">
                            <?php
                                echo $_SESSION['blad'];
                                unset($_SESSION['blad']);
                            ?>
                        </div>
                <?php endif; ?>
            </form>
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