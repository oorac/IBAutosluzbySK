<?php

namespace App\Model;

class Car extends Database
{
    public function getById($id)
    {
        return $this->getAll()->get($id);
    }

    public function getAllInfoAboutCars($najezd_od = null, $najezd_do = null)
    {
        $query = $this->getAll()
            ->select('car.*, vat.name AS vat, karoserie.name AS karoserie, 
                    znacka.name AS znacka, model.name AS model, palivo.name AS palivo, prevodovka.name AS prevodovka,
                     car.id AS id');
        if(!empty($najezd_od))
        {
            $query->where('car.hidden = 1');
        }

//        if(!empty($najezd_do))
//        {
//            $query->where('tachometr <=', $najezd_do);
//        }

        return $query->fetchAssoc('id');
    }

    public function getAllInfoAboutCarById($carId)
    {
        return $this->getAll()
            ->select('car.*, vat.name AS vat, karoserie.name AS karoserie, 
                    znacka.name AS znacka, model.name AS model, palivo.name AS palivo, prevodovka.name AS prevodovka,
                     car.id AS id')
            ->where('car.id', $carId)
            ->fetch();
    }

    public function getMainImagesByCarId($carId)
    {
        return $this->getImage()
            ->select('*')
            ->where('car_id', $carId)
            ->where('main', 1)
            ->fetch();
    }

    public function getOtherImagesByCarId($carId)
    {
        return $this->getImage()
            ->select('*')
            ->where('car_id', $carId)
            ->where('main', 0)
            ->fetchAssoc('id');
    }

    public function getAllParametersByCarId($carId)
    {
        return $this->getCarParameter()
            ->select('car_parameter.*, parameter.*, car_parameter.id AS id')
            ->where('car_parameter.car_id', $carId)
            ->where('parameter.hidden', 0)
            ->fetchAssoc('id');
    }

    public function deleteCar($carId)
    {
        return $this->getAll()
            ->where('id', $carId)
            ->delete();
    }

    public function visibleCar($carId)
    {
        return $this->getAll()
            ->where('id', $carId)
            ->update( ['hidden' => '0']);
    }

    public function hiddenCar($carId)
    {
        return $this->getAll()
            ->where('id', $carId)
            ->update( ['hidden' => '1']);
    }

    public function getAll()
    {
        return $this->database->table('car');
    }

    public function getCarParameter()
    {
        return $this->database->table('car_parameter');
    }

    public function getImage()
    {
        return $this->database->table('image');
    }
}