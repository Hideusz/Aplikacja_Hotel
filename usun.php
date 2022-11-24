<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usunstyle.css">
    <title>Usuwanie konta</title>
</head>
<body>
    <div class="kontener">
        <div class="formularz">
            <form action="usuń.php" method="POST">
            <h1 class="logo">Zajazd u Klatki</h1>
                    <input type="text" name="login" class="login" placeholder="Login">
                    <input type="password" name="haslo1" class="haslo1" placeholder="Hasło">
                    <input type="password" name="haslo2" class="haslo2" placeholder="Powtórz hasło">
                    <div class="przyciski">
                        <input type="submit" name="submit" value="Usuń konto" class="przycisk1">
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
    </div>
</body>
</html>