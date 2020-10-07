<?php

function spustit($pozadovany_controller, $pozadovana_akce)
{
    require_once "controllers/" . $pozadovany_controller . "_controller.php";

    switch($pozadovany_controller)
    {
        case "stranky":
            $aktivni_controller = new Stranky();
            break;
        case "uzivatele":
            require_once "models/Uzivatel.php";
            $aktivni_controller = new Uzivatele();
            break;
    }

    // hle, lifehack
    $aktivni_controller->{$pozadovana_akce}();
}

// co je povoleno
$controllery_a_akce = array(
    "stranky" => array(
        "default",
        "error",
        "profil",
    ),
    "uzivatele" => array(
        "registrovat",
        "prihlasit",
        "odhlasit",
        "pridat_prispevek",
    ),
);

// kontrola pripustnosti zadaneho controlleru a akce
if(array_key_exists($controller, $controllery_a_akce) &&
   in_array($akce, $controllery_a_akce[$controller]))
{
    spustit($controller, $akce);
}
else
{
    spustit("stranky", "error");
}
