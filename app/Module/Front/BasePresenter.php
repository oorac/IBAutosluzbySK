<?php

namespace App\Module\Front;

use App\Forms\SearchCars;
use App\Forms\SearchCarsFactory;
use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\Model\Car;
use App\Model\Block;
use App\Services\Config;
use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
    const FM_SUCCESS = 'success';
    const FM_INFO = 'info';
    const FM_WARNING = 'warning';
    const FM_ERROR = 'danger';

    /** @var Config */
    protected $config;
    protected Car $auta;
    protected Block $bloky;
    protected SearchCarsFactory $searchCarsFactory;
    protected SignInFormFactory $signInFactory;
    protected SignUpFormFactory $signUpFactory;

    public function __construct(
        Car               $auta,
        Block             $bloky,
        SearchCarsFactory $searchCarsFactory,
        SignInFormFactory $signInFactory,
        SignUpFormFactory $signUpFactory,
    )
    {
        parent::__construct();
        $this->auta = $auta;
        $this->bloky = $bloky;
        $this->searchCarsFactory = $searchCarsFactory;
        $this->signInFactory = $signInFactory;
        $this->signUpFactory = $signUpFactory;
    }

    protected function beforeRender()
    {
        parent::beforeRender();

        $this->template->blokyBase = $this->bloky->getContentByName('base');
        $this->template->basePath = '/';
        //$this->template->version = isset($this->config->getParameters()->version) ? '?v=' . $this->config->getParameters()->version : '';
    }

    protected function createComponentSearchCars(): SearchCars
    {
        $searchCars = $this->searchCarsFactory->create();
        $searchCars->onSearch[] = function (array $values){
            $this->forward(':Front:Auta:', $values);
//          $this->redirect(':Front:Auta:', $values);
        };
        return $searchCars;
    }

    public function getFileVersion($file): int
    {
        if(file_exists($file)) {
            return filemtime($file);
        } else {
            return 0;
        }
    }

//    protected function searchCars($data)
//    {
//        $cars = $this->auta->getAll();
//        if(!empty($data['najezd_od']))
//            $cars->where('tachometr >= ?', $data['najezd_od']);
//        if(!empty($data['najezd_do']))
//            $cars->where('tachometr <= ?', $data['najezd_do']);
//        if(!empty($data['rok_vyroby_od']))
//            $cars->where('year >= ?', $data['rok_vyroby_od']);
//        if(!empty($data['rok_vyroby_do']))
//            $cars->where('year <= ?', $data['rok_vyroby_do']);
//        if(!empty($data['karoserie']))
//            $cars->where('karoserie_id', $data['karoserie']);
//        if(!empty($data['palivo']))
//            $cars->where('palivo_id', $data['palivo']);
//        if(!empty($data['cena_od']))
//            $cars->where('price >= ?', $data['cena_od']);
//        if(!empty($data['cena_do']))
//            $cars->where('price <= ?', $data['cena_do']);
//
//        $cars->select('car.*, car.id AS id')
//                ->order('id DESC')
//                ->fetchAll();
//        $this->redirect(':Front:Auta:');
//    }
}
