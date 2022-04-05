<?php declare(strict_types=1);

namespace App\Module\Admin\Settings;

use App\Model\Block;
use App\Module\Admin\BasePresenter;

final class SettingsPresenter extends BasePresenter
{

    private Block $block;

    public function __construct(Block $block)
    {
        parent::__construct();
        $this->block = $block;
    }

    public function actionDefault()
    {
        
    }

    public function actionVat()
    {
        
    }

    public function actionBlock()
    {
        $this->template->blocks = $this->block->getAllBlocks();
    }

    public function handledeleteBlock($blockId)
    {
        $this->block->delete($blockId);
        $this->flashMessage('Úspešne zmazané', 'danger');
        $this->redirect(':Admin:Settings:block');
    }
}