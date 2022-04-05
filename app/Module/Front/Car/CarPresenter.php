<?php declare(strict_types=1);

namespace App\Module\Front\car;

use App\Model\Car;
use App\Module\Front\BasePresenter;

final class CarPresenter extends BasePresenter
{
    public function actionDefault()
    {
        $carsWithoutImages = $this->car->getAllInfoAboutCars($this->getParameter('najezd_od'), $this->getParameter('najezd_do'));
        $carsWithImages = [];
        if (!empty($carsWithoutImages))
            foreach ($carsWithoutImages as $car)
            {
                $car['main_images'] = $this->car->getMainImagesByCarId($car['id']);
                $carsWithImages[] = $car;
            }

        $this->template->cars = $carsWithImages;
    }

    public function actionDetail($carId)
    {
        $car = $this->car->getAllInfoAboutCarById($carId);
        $mainImage = $this->car->getMainImagesByCarId($carId);
        $otherImages = $this->car->getOtherImagesByCarId($carId);
        $parameters = $this->car->getAllParametersByCarId($carId);
        $this->template->car = $car;
        $this->template->mainImage = $mainImage;
        $this->template->otherImages = $otherImages;
        $this->template->parameters = $parameters;
    }
}