<?php declare(strict_types=1);

namespace App\Module\Admin\List\Car;

use App\Model\Car;
use App\Module\Admin\BasePresenter;

final class CarPresenter extends BasePresenter
{
    private Car $car;

    public function __construct(Car $car)
    {

        parent::__construct();
        $this->car = $car;
    }

    public function actionEdit($carId)
    {
        $this->template->car = $this->car->getAllInfoAboutCarById($carId);
    }

    public function handleDelete($carId)
    {
        $this->template->car = $this->car->getAllInfoAboutCarById($carId);
    }
}