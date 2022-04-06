<?php

namespace App\Model;

class Car extends Database
{
    public function getById($id)
    {
        return $this->getAll()->get($id);
    }

    public function getAllInfoAboutCars($type = null, $mark = null, $model = null, $fuel = null, $year_from = null, $year_to = null, $price_from = null, $price_to = null, )
    {
        $query = $this->getAll()
            ->select('car.*, vat.name AS vat, bodywork.name AS bodywork, type.name AS type, 
                    mark.name AS mark, model.name AS model, fuel.name AS fuel, transmission.name AS transmission,
                     car.id AS id');
        if(!empty($type))
        {
            $query->where('car.type_id', $type);
        }
        if(!empty($mark))
        {
            $query->where('car.mark_id', $mark);
        }
        if(!empty($model))
        {
            $query->where('car.model_id', $model);
        }
        if(!empty($fuel))
        {
            $query->where('car.fuel_id', $fuel);
        }
        if(!empty($year_from))
        {
            $query->where('car.year >=', $year_from);
        }
        if(!empty($year_to))
        {
            $query->where('car.year <=', $year_to);
        }
        if(!empty($price_from))
        {
            $query->where('car.price >=', $price_from);
        }
        if(!empty($price_to))
        {
            $query->where('car.price <=', $price_to);
        }

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