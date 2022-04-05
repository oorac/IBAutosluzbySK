<?php declare(strict_types=1);

namespace App\Module\Front\car;

use App\Model\Car;
use App\Module\Front\BasePresenter;

final class CarPresenter extends BasePresenter
{
    public function actionDefault()
    {
        $carsWithoutImages = $this->auta->getAllInfoAboutCars($this->getParameter('najezd_od'), $this->getParameter('najezd_do'));
        $carsWithImages = [];
        if (!empty($carsWithoutImages))
            foreach ($carsWithoutImages as $car)
            {
                $car['main_images'] = $this->auta->getMainImagesByCarId($car['id']);
                $carsWithImages[] = $car;
            }

        $this->template->cars = $carsWithImages;
    }

    public function actionDetail($carId)
    {
        $car = $this->auta->getAllInfoAboutCarById($carId);
        $mainImage = $this->auta->getMainImagesByCarId($carId);
        $otherImages = $this->auta->getOtherImagesByCarId($carId);
        $parameters = $this->auta->getAllParametersByCarId($carId);
        $this->template->car = $car;
        $this->template->mainImage = $mainImage;
        $this->template->otherImages = $otherImages;
        $this->template->parameters = $parameters;
    }
}