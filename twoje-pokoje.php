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
    $id=$_SESSION['id'];
    $rezultat = $conn->query("SELECT rezerwacja.id, rezerwacja.imie, rezerwacja.nazwisko, rezerwacja.zameldowanie, rezerwacja.wymeldowanie, pokoje.typ_pokoju FROM pokoje JOIN uzytkownik ON uzytkownik.id = pokoje.id_uzytkownika JOIN rezerwacja ON pokoje.id=rezerwacja.id_pokoju WHERE uzytkownik.id='$id'");
}
?>
<?php
    if(isset($_GET['id']))
    {
        $id_pokoju=$_GET['id'];
        $rezultat = $conn->query("SELECT rezerwacja.id_pokoju FROM pokoje JOIN uzytkownik ON uzytkownik.id = pokoje.id_uzytkownika JOIN rezerwacja ON pokoje.id=rezerwacja.id_pokoju WHERE rezerwacja.id='$id_pokoju'");
        $row = $rezultat->fetch_assoc();
        $numer = $row['id_pokoju'];
        $rezultat = $conn->query("DELETE FROM `rezerwacja` WHERE `id`='$id_pokoju'");
        $rezultat = $conn->query("UPDATE `pokoje` SET `status`='niezarezerwowany', `id_uzytkownika`=NULL WHERE `id`='$numer'");
        header("location: twoje-pokoje.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="twoje-pokoje.css">
    <title>Twoje pokoje</title>
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
        </ul>
    </nav>
      <div class="container">
        <div class="tabela">
        <?php
        
        echo '<table border="1" cellpadding="0">';
        echo '<tr>
                    <th>Imie </th>
                    <th>Nazwisko</th>
                    <th>Zamledowanie</th>
                    <th>Wymeldowanie</th>
                    <th>Typ pokoju</th>
                    <th>Operacje</th>
                </tr>';
                $num = mysqli_num_rows($rezultat);
                if($num>0)
                {
                    while($wiersz=mysqli_fetch_assoc($rezultat))
                    {
                        echo "
                        <tr>
                        <td>".$wiersz['imie']."</td>
                        <td>".$wiersz['nazwisko']."</td>
                        <td>".$wiersz['zameldowanie']."</td>
                        <td>".$wiersz['wymeldowanie']."</td>
                        <td>".$wiersz['typ_pokoju']."</td>
                        <td>
                            <a href='twoje-pokoje.php?id=".$wiersz['id']."'>Usun</a>
                        </td>
                        </tr>
                        ";
                }
                }
                
        echo '</table>';
        ?>
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