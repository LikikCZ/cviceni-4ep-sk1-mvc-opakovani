<?php

require_once "db.php";

class Uzivatel
{
    private $jmeno;
    private $heslo;

    public function __construct($jmeno, $heslo)
    {
        $this->jmeno = $jmeno;
        $this->heslo = password_hash($heslo, PASSWORD_DEFAULT);
    }

    public function zaregistrovat()
    {
        $spojeni = DB::pripojit();

        $dotaz = "INSERT INTO 4ep_sk1_mvc_uzivatele (jmeno, heslo) VALUES ('$this->jmeno', '$this->heslo')";
        mysqli_query($spojeni, $dotaz);

        return (mysqli_affected_rows($spojeni) == 1);
    }

    public function ()
    {
        
    }

    static public function existuje($jmeno, $heslo)
    {
        $spojeni = DB::pripojit();

        $dotaz = "SELECT * FROM 4ep_sk1_mvc_uzivatele WHERE jmeno='$jmeno'";
        $vysledek = mysqli_query($spojeni, $dotaz);

        if(mysqli_num_rows($vysledek) == 1)
        {
            $heslo_z_db = mysqli_fetch_assoc($vysledek)["heslo"];

            return (password_verify($heslo, $heslo_z_db));
        }
        else
            return false;
    }
}
