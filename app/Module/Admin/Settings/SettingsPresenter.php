<?php declare(strict_types=1);

namespace App\Module\Admin\Nastaveni;

use App\Model\Block;
use App\Module\Admin\BasePresenter;

final class SettingsPresenter extends BasePresenter
{

    private Block $bloky;

    public function __construct(Block $bloky)
    {
        parent::__construct();
        $this->bloky = $bloky;
    }

    public function actionDefault()
    {
        
    }

    public function actionDph()
    {
        
    }

    public function actionBloky()
    {
        $this->template->bloky = $this->bloky->getAllBloky();
    }

    public function handledeleteBlok($blokId)
    {
        $this->bloky->delete($blokId);
        $this->flashMessage('Úspešne zmazané', 'danger');
        $this->redirect(':Admin:Nastaveni:bloky');
    }
}