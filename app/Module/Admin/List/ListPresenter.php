<?php declare(strict_types=1);

namespace App\Module\Admin\List;

use App\Model\Car;
use App\Module\Admin\BasePresenter;

final class ListPresenter extends BasePresenter
{

    private Car $car;

    public function __construct(Car $car)
    {

        parent::__construct();
        $this->car = $car;
    }
    public function actionCars()
    {
        $this->template->cars = $this->car->getAllInfoAboutCars();
    }

    public function handleDeleteCar($carId)
    {
        $this->car->deleteCar($carId);
        $this->flashMessage('Auto bylo odstraněno', 'danger');
    }

    public function handleHiddenCar($carId)
    {
        $this->car->hiddenCar($carId);
        $this->flashMessage('Auto bylo skryto', 'info');
    }

    public function handleVisibleCar($carId)
    {
        $this->car->visibleCar($carId);
        $this->flashMessage('Auto bylo zveřejněno', 'info');
        $this->redirect(':Car:List:car');
    }

    public function actionKaroserie()
    {

    }

    public function actionModely()
    {

    }

    public function actionPaliva()
    {

    }

    public function actionParametry()
    {

    }

    public function actionPrevodovky()
    {

    }

    public function actionTagy()
    {

    }

    public function actionZnacky()
    {

    }
}