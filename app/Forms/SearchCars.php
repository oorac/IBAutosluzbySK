<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model\Car;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;


final class SearchCars extends Control
{
//    private Auta $auta;

    public array $onSearch;

//    public function __construct(Auta $auta)
//	{
//        $this->auta = $auta;
//    }

	protected function createComponentForm(): Form
	{
		$form = new Form();
		$form->addText('najezd_od', 'Najazdené od:');
		$form->addText('najezd_do', 'Najazdené do:');
		$form->addText('rok_vyroby_od', 'Rok výroby od:');
		$form->addText('rok_vyroby_do', 'Rok výroby do:');
		$form->addText('karoserie', 'Karoséria:');
		$form->addText('palivo', 'Palivo:');
		$form->addText('cena_od', 'Cena od:');
		$form->addText('cena_do', 'Cena do:');

		$form->addSubmit('send', 'Vyhľadať');
        $form->onSuccess[] = [$this, 'processForm'];
        return $form;
	}

    public function processForm(Form $form, array $values): void
    {
        $this->onSearch($values);
//        $cars = $this->auta->getAll()
//            ->select('car.*, car.id AS id');
//        if(!empty($values['najezd_od']))
//            $cars->where('tachometr >= ?', $values['najezd_od']);
//        if(!empty($values['najezd_do']))
//            $cars->where('tachometr <= ?', $values['najezd_do']);
//        if(!empty($values['rok_vyroby_od']))
//            $cars->where('year >= ?', $values['rok_vyroby_od']);
//        if(!empty($values['rok_vyroby_do']))
//            $cars->where('year <= ?', $values['rok_vyroby_do']);
//        if(!empty($values['karoserie']))
//            $cars->where('karoserie_id', $values['karoserie']);
//        if(!empty($values['palivo']))
//            $cars->where('palivo_id', $values['palivo']);
//        if(!empty($values['cena_od']))
//            $cars->where('price >= ?', $values['cena_od']);
//        if(!empty($values['cena_do']))
//            $cars->where('price <= ?', $values['cena_do']);
//        $cars->order('id DESC');
//        $cars->fetchAssoc('id');
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . '/searchCars.latte');
        $this->getTemplate()->render();
    }
}
