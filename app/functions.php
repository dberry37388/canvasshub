<?php

if (! function_exists('getElectionYearFromCode')) {
    function getElectionYearFromCode($code)
    {
        return config("voters.map_to_year.{$code}", '');
    }
}
