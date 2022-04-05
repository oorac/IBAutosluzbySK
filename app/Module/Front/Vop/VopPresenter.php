<?php declare(strict_types=1);

namespace App\Module\Front\Vop;

use App\Module\Front\BasePresenter;

final class VopPresenter extends BasePresenter
{
    public function actionDefault()
    {
        $blocks = $this->block->getContentByName('vop');
        $clean_html = $this->getHtmlPurifier($blocks['vop']['text']);
        $this->template->blocks = $clean_html;
    }
}