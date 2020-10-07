<?php
    $nazev = (isset($_POST["nazev"])) ? $_POST["nazev"] : "";
    $obsah = (isset($_POST["obsah"])) ? $_POST["obsah"] : "";
?>

<form action="?" method="post">
    <input type="text" name="nazev" placeholder="Nazev..." value="<?php echo $nazev; ?>" /><br />
    <input type="text" name="obsah" placeholder="Obsah..." value="<?php echo $obsah; ?>" /><br />
    <input type="submit" value="Vytvorit" />
</form>