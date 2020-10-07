<?php

class Uzivatele
{
    private function prihlasovaci_udaje_jsou_kompletni()
    {
        if(!isset($_POST["jmeno"]))
            return false;
        if(!isset($_POST["heslo"]))
            return false; 

        return true;
    }

    private function registracni_udaje_jsou_kompletni()
    {
        if(!isset($_POST["jmeno"]))
            return false;
        if(empty(trim($_POST["jmeno"])))
            return false;

        if(!isset($_POST["heslo"]))
            return false;
        if(empty(trim($_POST["heslo"])))
            return false;

        if(!isset($_POST["heslo_znovu"]))
            return false;
        if(empty(trim($_POST["heslo_znovu"])))
            return false;

        return true;
    }

    private function ujdaje_k_prispevku_jsou_kompletni()
    {
        if(!isset($_POST["zatimnwm"]))
            return false;
        if(empty(trim($_POST["zatimnwm"])))
            return false;

        return true;
    }

    private function registracni_udaje_jsou_v_poradku($jmeno, $heslo, $heslo_znovu)
    {
        if(strlen($jmeno) < 1)
            return false;
        if(strlen($heslo) < 1)
            return false;
        if($heslo_znovu != $heslo)
            return false;

        return true;
    }

    public function registrovat()
    {
        if($this->registracni_udaje_jsou_kompletni())
        {
            // zpracovani dat z formulare
            $jmeno = trim($_POST["jmeno"]);
            $heslo = trim($_POST["heslo"]);
            $heslo_znovu = trim($_POST["heslo_znovu"]);

            if($this->registracni_udaje_jsou_v_poradku($jmeno, $heslo, $heslo_znovu))
            {
                $uzivatel = new Uzivatel($jmeno, $heslo);
                
                if($uzivatel->zaregistrovat())
                    return spustit("uzivatele", "prihlasit");
                else
                    return spustit("stranky", "error");
            }
            else
                require_once "views/uzivatele/registrovat.php";
        }
        else
        {
            // zobrazeni formulare k vyplneni
            require_once "views/uzivatele/registrovat.php";
        }
    }

    public function prihlasit()
    {
        if($this->prihlasovaci_udaje_jsou_kompletni())
        {
            $jmeno = trim($_POST["jmeno"]);
            $heslo = trim($_POST["heslo"]);

            if(Uzivatel::existuje($jmeno, $heslo))
            {
                global $zakladni_url;

                session_destroy();
                unset($_SESSION["prihlaseny_uzivatel"]);

                session_start();
                $_SESSION["prihlaseny_uzivatel"] = $jmeno;

                header("location:".$zakladni_url."index.php/stranky/profil/");
            }
            else
                require_once "views/uzivatele/prihlasit.php";
        }
        else
        {
            // zobrazeni formulare k vyplneni
            require_once "views/uzivatele/prihlasit.php";
        }
    }

    public function pridat_prispevek()
    {
        if($this->ujdaje_k_prispevku_jsou_kompletni())
        {
            $zatimnwm = trim($_POST["zatimnwm"]);
        }
        else
        {
            // zobrazeni formulare k vyplneni
            require_once "views/uzivatele/pridat_prispevek.php";
        }
    }

    public function odhlasit()
    {
        global $zakladni_url;

        session_destroy();
        session_start();

        header("location:".$zakladni_url."index.php/stranky/default/");
    }
}
