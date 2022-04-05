<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use App\Model\UserFacade;
use Nette;
use Nette\Application\UI\Form;


final class SignUpFormFactory
{
	use Nette\SmartObject;

	private FormFactory $factory;

	private UserFacade $userFacade;


    public function __construct(FormFactory $factory, UserFacade $userFacade)
	{
		$this->factory = $factory;
		$this->userFacade = $userFacade;
	}


	public function create(callable $onSuccess): Form
	{
		$form = $this->factory->create();
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Prosím vložte své jméno.');

		$form->addEmail('email', 'Váš e-mail:')
			->setRequired('Prosím vložte Váš e-mail.');

		$form->addPassword('password', 'Vložte heslo:')
			->setOption('description', sprintf('minimálně %d znaků', $this->userFacade::PASSWORD_MIN_LENGTH))
			->setRequired('Prosím vložte heslo.')
			->addRule($form::MIN_LENGTH, null, $this->userFacade::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Registrovat');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->userFacade->add($values->username, $values->email, $values->password);
			} catch (Model\DuplicateNameException $e) {
				$form['username']->addError('Uživatelské jméno již existuje.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}
