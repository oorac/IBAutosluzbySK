<?php declare(strict_types=1);

namespace App\Module\Front\AdditionalService;

use App\Module\Front\BasePresenter;

final class AdditionalServicePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('add_service');
        $clean_html = $this->getHtmlPurifier($blocks['service']['text']);
        $this->template->blocks = $clean_html;
    }
}