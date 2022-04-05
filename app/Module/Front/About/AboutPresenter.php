<?php declare(strict_types=1);

namespace App\Module\Front\About;

use App\Module\Front\BasePresenter;

final class AboutPresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('about');
        $clean_html = $this->getHtmlPurifier($blocks['about']['text']);
        $this->template->blocks = $clean_html;
    }
}