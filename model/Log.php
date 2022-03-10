<?php

class Log
{
    public ?int $id = null;
    public ?int $vak_id = null;
    public string $vak = '';
    public string $datum = '';
    public string $onderwerp = '';
    public string $hoe = '';
    public string $stappen = '';
    public string $evaluatie = '';
    public string $planning = '';
    public string $terugkijken = '';
    public int $minuten_besteed = 0;
}