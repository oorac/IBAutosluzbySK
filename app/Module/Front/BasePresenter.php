<?php

namespace App\Module\Front;

use App\Forms\SearchCars\SearchCars;
use App\Forms\SearchCars\SearchCarsFactory;
use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\Model\Car;
use App\Model\Block;
use Nette\Application\UI\Presenter;
use HTMLPurifier;
use HTMLPurifier_Config;

abstract class BasePresenter extends Presenter
{
    const FM_SUCCESS = 'success';
    const FM_INFO = 'info';
    const FM_WARNING = 'warning';
    const FM_ERROR = 'danger';

    protected Car $car;
    protected Block $block;
    protected SearchCarsFactory $searchCarsFactory;
    protected SignInFormFactory $signInFactory;
    protected SignUpFormFactory $signUpFactory;

    public function __construct(
        Car               $car,
        Block             $block,
        SearchCarsFactory $searchCarsFactory,
        SignInFormFactory $signInFactory,
        SignUpFormFactory $signUpFactory
    )
    {
        parent::__construct();
        $this->car = $car;
        $this->block = $block;
        $this->searchCarsFactory = $searchCarsFactory;
        $this->signInFactory = $signInFactory;
        $this->signUpFactory = $signUpFactory;
    }

    protected function beforeRender()
    {
        parent::beforeRender();
//        bdump($_SERVER['REQUEST_URI']);
        $this->template->blokyBase = $this->block->getContentByName('base');
        $this->template->basePath = '/';
    }

    protected function createComponentSearchCars(): SearchCars
    {
        $searchCars = $this->searchCarsFactory->create();
        $searchCars->onSearch[] = function (array $values){
            $this->forward(':Front:Car:', $values);
//          $this->redirect(':Front:Auta:', $values);
        };
        return $searchCars;
    }

    protected function getHtmlPurifier($data){
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('h4', 'target', 'Enum#_blank,_self,_target,_top');
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($data);
    }
}
