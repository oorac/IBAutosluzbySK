<?php declare(strict_types=1);

namespace App\Module\Front\Gdpr;

use App\Module\Front\BasePresenter;

final class GdprPresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('gdpr');
        $clean_html = $this->getHtmlPurifier($blocks['gdpr']['text']);
        $this->template->blocks = $clean_html;
    }
}