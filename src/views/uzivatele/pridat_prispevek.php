<?php
    $zatimnwm = (isset($_POST["zatimnwm"])) ? $_POST["zatimnwm"] : "";
?>

<form action="?" method="post">
    <input type="text" name="zatimnwm" placeholder="Zatimnwm..." value="<?php echo $zatimnwm; ?>" /><br />
    <input type="submit" value="Vytvorit" />
</form>