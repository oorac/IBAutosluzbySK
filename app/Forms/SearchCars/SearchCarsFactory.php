<?php

namespace App\Forms\SearchCars;

interface SearchCarsFactory
{
    public function create():SearchCars;
}