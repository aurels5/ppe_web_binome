<?php

    function dateShowYear($date){
        $tab_date=explode('-',$date);
        $year=intval($tab_date[0]);
        return $year;
    }