<?php

declare(strict_types=1);

namespace App\Module\Front\Homepage;

use App\Module\Front\BasePresenter;
use HTMLPurifier;
use HTMLPurifier_Config;

final class HomepagePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $bloky= $this->bloky->getContentByName('homepage');
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($bloky['onas']['text']);
        $this->template->bloky = $clean_html;
    }
}
