<?php

namespace App\Module\Admin;

use App\Presenters\RequireLoggedUser;
use App\Services\Config;
use Nette;
use Nette\Application\UI\Presenter;
use Nette\Http\IResponse;

abstract class BasePresenter extends Presenter
{
    use RequireLoggedUser;
    const FM_SUCCESS = 'success';
    const FM_INFO = 'info';
    const FM_WARNING = 'warning';
    const FM_ERROR = 'danger';

    /** @var Config */
    protected $config;
    /**
     * Common render method.
     * @return void
     */
    protected function beforeRender()
    {
        parent::beforeRender();
        if (!$this->getUser()->isInRole('ADMIN'))
            $this->error('Nedostatečné oprávnění.', IResponse::S403_FORBIDDEN);
        $this->template->basePath = '/';
        //$this->template->version = isset($this->config->getParameters()->version) ? '?v=' . $this->config->getParameters()->version : '';
    }
}
