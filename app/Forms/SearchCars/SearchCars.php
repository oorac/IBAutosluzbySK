<?php

declare(strict_types=1);

namespace App\Forms\SearchCars;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;


final class SearchCars extends Control
{
    public array $onSearch;

    const TYPE_SELECT = [
        '0' => 'Ano',
        '1' => 'Ne',
    ];
    const MARK_SELECT = [
        '0' => 'Ano',
        '1' => 'Ne',
    ];
    const MODEL_SELECT = [
        '0' => 'Ano',
        '1' => 'Ne',
    ];

	protected function createComponentForm(): Form
	{
		$form = new Form();
		$form->addSelect('type', '', self::TYPE_SELECT);
		$form->addSelect('mark', '', self::MARK_SELECT);
		$form->addText('model', self::MODEL_SELECT);
		$form->addText('year_from', 'Rok výroby od:');
		$form->addText('year_to', 'Rok výroby do:');
		$form->addText('fuel', 'Palivo:');
		$form->addText('price_from', 'Cena od:');
		$form->addText('price_to', 'Cena do:');

		$form->addSubmit('send', 'Vyhľadať');
        $form->onSuccess[] = [$this, 'processForm'];
        return $form;
	}

    public function processForm(Form $form, array $values): void
    {
        $this->onSearch($values);
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . '/templates/searchCars.latte');
        $this->getTemplate()->render();
    }
}
