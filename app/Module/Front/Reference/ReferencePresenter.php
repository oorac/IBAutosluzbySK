<?php declare(strict_types=1);

namespace App\Module\Front\Reference;

use App\Module\Front\BasePresenter;

final class ReferencePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('reference');
        $clean_html = $this->getHtmlPurifier($blocks['reference']['text']);
        $this->template->blocks = $clean_html;
    }
}