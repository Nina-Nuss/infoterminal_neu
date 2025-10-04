<?php

    function heutigerTagVorhanden($dayString)
    {
        $aktuellerTag = date('l'); // Gibt den vollständigen Namen des Wochentags zurück (z. B. "Monday")
        $tage = explode("+", $dayString);
        foreach ($tage as $i => $tag) {
            $tage[$i] = trim($tag);
            if (strtolower($tage[$i]) === strtolower($aktuellerTag)) {
                return true;
            }
        }
    }

?>