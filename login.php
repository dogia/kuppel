<?php 
    session_start(); 
    if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
        header("Location: ../");
        exit(0);
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Signin Template · Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="https://getbootstrap.com/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.4/examples/sign-in/signin.css" rel="stylesheet">
    <script data-dapp-detection="">
        (function() {
            let alreadyInsertedMetaTag = false

            function __insertDappDetected() {
                if (!alreadyInsertedMetaTag) {
                    const meta = document.createElement('meta')
                    meta.name = 'dapp-detected'
                    document.head.appendChild(meta)
                    alreadyInsertedMetaTag = true
                }
            }

            if (window.hasOwnProperty('web3')) {
                // Note a closure can't be used for this var because some sites like
                // www.wnyc.org do a second script execution via eval for some reason.
                window.__disableDappDetectionInsertion = true
                // Likely oldWeb3 is undefined and it has a property only because
                // we defined it. Some sites like wnyc.org are evaling all scripts
                // that exist again, so this is protection against multiple calls.
                if (window.web3 === undefined) {
                    return
                }
                __insertDappDetected()
            } else {
                var oldWeb3 = window.web3
                Object.defineProperty(window, 'web3', {
                    configurable: true,
                    set: function(val) {
                        if (!window.__disableDappDetectionInsertion)
                            __insertDappDetected()
                        oldWeb3 = val
                    },
                    get: function() {
                        if (!window.__disableDappDetectionInsertion)
                            __insertDappDetected()
                        return oldWeb3
                    }
                })
            }
        })()
    </script>
</head>

<body class="text-center">
    <?php
    function printForm($error = false){
    ?>
    <form class="form-signin" action="#" method="POST">
            <img class="mb-4" src="./logo.png" alt="" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Inicio de sesi&oacute;n</h1>
            <label style="color:brown;"><?php if($error){ echo $error; } ?></label>
            <label for="inputEmail" class="sr-only">Email</label>
            <input name="userEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Constrase&ntilde;a</label>
            <input name="userPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <!--<div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" value="true"> Recu&eacute;rdame
                </label>
            </div>
            TODO Cookie Login
            -->
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Seción</button>
            <p class="mt-5 mb-3 text-muted">© Kuppel test</p>
        </form>
    <?php
    }

    if ($_POST == array()) {
        printForm();
    }else{
        require "./src/config/db.php";

        $db = new mongodb("dbUser", "dogiaAtlas", "cluster.oxs3r.gcp.mongodb.net", "kuppel", "usuarios");
        $data = @json_decode($db->getDocuments(["email" => $_POST["userEmail"]], ["limit" => 1]), true)[0];
        if($data){
            if($data["email"] == $_POST["userEmail"] && $data["password"] == $_POST["userPassword"]){
                    $_SESSION["logged"] = true;
                    $_SESSION["userEmail"] = $data["email"];
                    $_SESSION["sticker"] = "0055e02801c134be13c8a971456e0180bcd515ce504de1b8e0d964c1172d4f0929efa591092c4dd2e25d2b88a6ff5ebe279291fb9c906b2d7fb7a600d2abf80d";
                    $_SESSION["rango"] = $data["rango"];
                    echo "Iniciando sesi&oacute;n";
                    header("Location: ../");
                    exit(0);
            }else{
                printForm("Usuario y/o contrase&ntilde;a incorrectos.");
            }
        }else{
            printForm("Usuario y/o contrase&ntilde;a incorrectos.");
        }
    }
    ?>


</body>

</html>