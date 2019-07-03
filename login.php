<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>France Info</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <img src="img/logo.png">
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <nav>
                        <ul>
                            <li><a href="index.php">home</a></li>
                            <li><a href="kategorija.php?catID=1">elections</a></li>
                            <li><a href="kategorija.php?catID=0">sports</a></li>
                            <li><a href="administration.php">administration</a></li>
                            <li><a href="unos.php">new article</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <hr>
        </header>
        <content>
            <div class="container">
                <?php
                    include("connect.php");
                    session_start();
                    $prijavaImeKorisnika = $_POST['username'];
                    $prijavaLozinkaKorisnika = $_POST['pass'];
                    $sql = "SELECT username, password, razina FROM users
                        WHERE username = ?";
                    $stmt = mysqli_stmt_init($dbc);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                    }
                    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
                    mysqli_stmt_fetch($stmt);
                    if (password_verify($_POST['pass'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
                        if($levelKorisnika == 0) {
                            $_SESSION["level"] = 0;
                        }
                        else {
                            $_SESSION["level"] = 1;
                        }
                        $_SESSION['loggedin'] = 1;
                        $_SESSION['username'] = $imeKorisnika;
                        header("Location: administration.php");
                    }                
                ?>
            </div>
        </content>
        <footer>
            <div class="container">
                <p><b>Author:</b> Filip Čulig</p>
                <p><b>E-mail:</b> <a href="mailto:filip.culig@gmail.com" target="_top">filip.culig@gmail.com</a></p>
                <p>June 2019</p>
            </div>
        </footer>
    </body>
</html>