<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rejestracjastyle.css">
    <title>Rejestracja</title>
</head>
<body>
    <div class="kontener">
        <div class="formularz">
            <form action="rej.php" method="POST">
            <h1 class="logo">Zajazd u Klatki</h1>
                    <input type="text" name="login" class="login" placeholder="Nazwa użytkownika">
                    <input type="email" name="email" class="email" placeholder="Adres email">
                    <input type="password" name="haslo" class="haslo" placeholder="Hasło">
                    <input type="password" name="haslo1" class="haslo" placeholder="Powtórz hasło">
                    <div class="przyciski">
                        <input type="submit" name="submit" value="Załóż konto" class="przycisk1">
                        <button class="przycisk2"><a href="logowanie.php">Powrót</a></button>
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