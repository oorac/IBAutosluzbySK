<?php

declare(strict_types=1);

namespace App\Module\Front\Homepage;

use App\Module\Front\BasePresenter;

final class HomepagePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('homepage');
        $clean_html = $this->getHtmlPurifier($blocks['onas']['text']);
        $this->template->blocks = $clean_html;
    }
}
