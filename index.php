<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stronastyle.css">
    <title>Strona główna</title>
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
    <?php
        if(isset($_SESSION['show']))
        {
            echo '<div class="rezerwacja"><a href="twoje-pokoje.php">Udało się zarezerwować pokój</a></div>';
            unset($_SESSION['show']);
        }
    ?>
    <div class="main">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse possimus doloremque eos error perspiciatis reiciendis commodi nisi, inventore exercitationem voluptatibus dicta dolor eum pariatur, qui architecto, voluptatem cum incidunt fugit!
        Ratione iure quibusdam tenetur suscipit odit sed voluptate amet fugiat expedita quasi possimus et, eum asperiores alias deserunt? Consequuntur quae veniam eveniet velit vel voluptate neque unde itaque ex vero!
        Commodi voluptatum quibusdam, nam itaque sequi sapiente animi nisi veritatis cupiditate recusandae voluptates natus autem saepe quisquam quidem, numquam dicta! Quod ullam minus neque minima et quis vel dolores temporibus?
        Error, amet neque fugiat fuga enim id veritatis iste praesentium natus dolorem saepe laboriosam totam. Perspiciatis recusandae odio sapiente repellat, placeat sed similique ducimus vitae accusantium quidem, dolores ipsam blanditiis.
        Quos temporibus alias non necessitatibus dolores repellat aliquam deleniti omnis mollitia natus. Repellat provident itaque ab sunt sequi vitae magnam. Soluta, impedit ipsam fugiat doloribus nemo sequi animi quis adipisci!
    </div>
    <div class="main">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse possimus doloremque eos error perspiciatis reiciendis commodi nisi, inventore exercitationem voluptatibus dicta dolor eum pariatur, qui architecto, voluptatem cum incidunt fugit!
        Ratione iure quibusdam tenetur suscipit odit sed voluptate amet fugiat expedita quasi possimus et, eum asperiores alias deserunt? Consequuntur quae veniam eveniet velit vel voluptate neque unde itaque ex vero!
        Commodi voluptatum quibusdam, nam itaque sequi sapiente animi nisi veritatis cupiditate recusandae voluptates natus autem saepe quisquam quidem, numquam dicta! Quod ullam minus neque minima et quis vel dolores temporibus?
        Error, amet neque fugiat fuga enim id veritatis iste praesentium natus dolorem saepe laboriosam totam. Perspiciatis recusandae odio sapiente repellat, placeat sed similique ducimus vitae accusantium quidem, dolores ipsam blanditiis.
        Quos temporibus alias non necessitatibus dolores repellat aliquam deleniti omnis mollitia natus. Repellat provident itaque ab sunt sequi vitae magnam. Soluta, impedit ipsam fugiat doloribus nemo sequi animi quis adipisci!
    </div>
    <div class="main">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse possimus doloremque eos error perspiciatis reiciendis commodi nisi, inventore exercitationem voluptatibus dicta dolor eum pariatur, qui architecto, voluptatem cum incidunt fugit!
        Ratione iure quibusdam tenetur suscipit odit sed voluptate amet fugiat expedita quasi possimus et, eum asperiores alias deserunt? Consequuntur quae veniam eveniet velit vel voluptate neque unde itaque ex vero!
        Commodi voluptatum quibusdam, nam itaque sequi sapiente animi nisi veritatis cupiditate recusandae voluptates natus autem saepe quisquam quidem, numquam dicta! Quod ullam minus neque minima et quis vel dolores temporibus?
        Error, amet neque fugiat fuga enim id veritatis iste praesentium natus dolorem saepe laboriosam totam. Perspiciatis recusandae odio sapiente repellat, placeat sed similique ducimus vitae accusantium quidem, dolores ipsam blanditiis.
        Quos temporibus alias non necessitatibus dolores repellat aliquam deleniti omnis mollitia natus. Repellat provident itaque ab sunt sequi vitae magnam. Soluta, impedit ipsam fugiat doloribus nemo sequi animi quis adipisci!
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