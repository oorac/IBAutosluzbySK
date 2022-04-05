<?php

declare(strict_types=1);

namespace App\Module\Front\Error4xx;

use Nette;


final class Error4xxPresenter extends Nette\Application\UI\Presenter
{
	public function startup(): void
	{
		parent::startup();
		if (!$this->getRequest()->isMethod(Nette\Application\Request::FORWARD)) {
			$this->error();
		}
	}


	public function renderDefault(Nette\Application\BadRequestException $exception): void
	{
		// load template 403.latte or 404.latte or ... 4xx.latte
		$file = __DIR__ . "/templates/{$exception->getCode()}.latte";
		$this->template->setFile(is_file($file) ? $file : __DIR__ . '/templates/4xx.latte');
	}
}
