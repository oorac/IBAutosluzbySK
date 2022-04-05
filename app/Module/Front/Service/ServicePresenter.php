<?php declare(strict_types=1);

namespace App\Module\Front\Service;

use App\Module\Front\BasePresenter;

final class ServicePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('service');
        $clean_html = $this->getHtmlPurifier($blocks['service']['text']);
        $this->template->blocks = $clean_html;
    }
}