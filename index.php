<?php

    require DOCROOT."/includes/config.inc.php";

    if (isset($_GET["page"])) {
        $filename = DOCROOT."/pages/".$_GET["page"].".php";

        if (file_exists($filename)) {
            require DOCROOT."/pages/".$_GET["page"].".php";
        } else {
            header("Location: 404.html");
        }
    } elseif (file_exists(DOCROOT."/pages/accueil.php")) {
        require DOCROOT."/pages/accueil.php";
    } else {
        header("Location: 404.html");
    }
