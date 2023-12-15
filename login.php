<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            if ($user['role'] == 'admin') {
                header("Location: admin_dash.php");
                exit();
            } elseif ($user['role'] == 'prof') {
                header("Location: prof_dash.php");
                exit();
            }
        } else {
            $error_message = "Invalid username or password";
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        #proverb {
            color: white;
        }
    </style>
</head>

<body class="img js-fullheight" style="background-image: url(images/Prof.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Bonne Journée !</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Connexion</h3>
                        <form action="login.php" method="post" class="signin-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Se Connecter</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Mot de passe oublié?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Proverbe affiché en bas -->
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mt-4">
                    <p id="proverb"></p>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function isvalid() {
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if (user.length == "" && pass.length == "") {
                alert("Username and Password field is empty !");
                return false;
            } else if (user.length == "") {
                alert("Username field is empty !");
                return false;
            } else if (pass.length == "") {
                alert("Password field is empty !");
                return false;
            }
        }
    </script>

    <script>
        <?php
        if (isset($error_message) && !empty($error_message)) {
            echo "alert('$error_message');";
        }
        ?>
    </script>

    <script>

        var proverbs = [
            "La patience est la clé du paradis.",
            "Celui qui sait attendre obtient toujours ce qu'il souhaite.",
            "Le succès ne se mesure pas à la destination finale, mais au chemin parcouru.",
            "Le chemin de mille kilomètres commence par un pas.",
            "La sagesse, c'est de savoir qu'on ne sait rien.",
            "Chaque nuage a une doublure d'argent.",
            "Qui sème le vent récolte la tempête.",
            "Mieux vaut tard que jamais.",
        ];

        var proverbElement = document.getElementById("proverb");

        function changeProverb() {
            var randomProverb = proverbs[Math.floor(Math.random() * proverbs.length)];

            proverbElement.textContent = randomProverb;
        }

        setInterval(changeProverb, 5000);
    </script>

</body>

</html>