<?php

require_once "db.php";

class Uzivatel
{
    private $autor;
    private $nazev;
    private $datum_vytvoreni;
    private $datum_posledni_zmeny;
    private $obsah;
    private $zobrazovat;

    public function __construct($autor, $nazev, $datum_vytvoreni, $datum_posledni_zmeny, $obsah, $zobrazovat)
    {
        $this->autor = $autor;
        $this->nazev = $nazev;
        $this->datum_vytvoreni = $datum_vytvoreni;
        $this->datum_posledni_zmeny = $datum_posledni_zmeny;
        $this->obsah = $obsah;
        $this->zobrazovat = $zobrazovat;
    }    

    public function vytvorit()
    {        
        $spojeni = DB::pripojit();

        $dotaz = "INSERT INTO 4ep_sk1_mvc_prispevky (autor, nazev, obsah, zobrazovat) VALUES ('$this->autor', '$this->nazev', '$this->obsah',  '$zobrazovat')";
        mysqli_query($spojeni, $dotaz);

        return (mysqli_affected_rows($spojeni) == 1);
    }
    
    static public function nacist_vsechny($autor, $zobrazovat)
    {
        $spojeni = DB::pripojit();
        if($zobrazovat != NULL){
            if($autor != NULL)
            $dotaz = "SELECT * FROM 4ep_sk1_mvc_prispevky WHERE autor = '$autor', zobrazovat = '$zobrazovat'";
            else
            $dotaz = "SELECT * FROM 4ep_sk1_mvc_prispevky WHERE zobrazovat = '$zobrazovat'";
        }
        else{
            if($autor != NULL)
            $dotaz = "SELECT * FROM 4ep_sk1_mvc_prispevky WHERE autor = '$autor', zobrazovat = 'ano'";
            else
            $dotaz = "SELECT * FROM 4ep_sk1_mvc_prispevky WHERE zobrazovat = 'ano'";
        }
        $vysledek = mysqli_query($spojeni, $dotaz);

        if(mysqli_num_rows($vysledek) != 0)
        {
            $prispevky = [];
            while($radek = mysqli_fetch_assoc($vysledek))
            {
                $autor = $radek["autor"];
                $nazev = $radek["nazev"];
                $datum_vytvoreni = $radek["datum_vytvoreni"];
                $datum_posledni_zmeny = $radek["datum_posledni_zmeny"];
                $obsah = $radek["obsah"];
                $zobrazovat = $radek["zobrazovat"];
                $prispevky[] = new Prispevek($autor, $nazev, $datum_posledni_zmeny, $obsah, $zobrazovat, $zobrazovat);
            }
            return ($prispevky);
        }
        else
            return false;
    }
}