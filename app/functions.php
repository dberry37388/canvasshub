<?php

if (! function_exists('getElectionYearFromCode')) {
    function getElectionYearFromCode($code)
    {
        return config("voters.map_to_year.{$code}", '');
    }
}

if (! function_exists('mapElectionCode')) {
    function mapElectionCode($code)
    {
        return config("voters.election_code_map.{$code}", $code);
    }
}
