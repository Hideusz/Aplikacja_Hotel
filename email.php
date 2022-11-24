<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="emailstyle.css">
    <title>Zmiana emaila</title>
</head>
<body>
    <div class="kontener">
        <div class="formularz">
            <form action="em.php" method="POST">
            <h1 class="logo">Zajazd u Klatki</h1>
                    <input type="email" name="email" class="email" placeholder="Aktualny adres email">
                    <input type="email" name="email1" class="email1" placeholder="Nowy adres email">
                    <input type="email" name="email2" class="email2" placeholder="Potwierdź nowy adres email">
                    <div class="przyciski">
                        <input type="submit" name="submit" value="Nowe hasło" class="przycisk1">
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