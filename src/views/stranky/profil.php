<?php
    global $zakladni_url;

    if(!isset($_SESSION["prihlaseny_uzivatel"]))
    {
        header("location:".$zakladni_url."index.php/stranky/error/");
        die();
    }
    else
    {
        $prihlaseny_uzivatel = $_SESSION["prihlaseny_uzivatel"];
    }
?>

<p>Jste přihlášeni jako <b><?php echo $prihlaseny_uzivatel; ?></b>.</p>

<form action="<?php echo $zakladni_url; ?>index.php/uzivatele/pridat_prispevek/">
    <input type="submit" value="Přidat příspevek" />
</form>

<form action="<?php echo $zakladni_url; ?>index.php/uzivatele/odhlasit/">
    <input type="submit" value="Odhlásit" />
</form>
