<?php declare(strict_types=1);

namespace App\Module\Admin\Homepage;

use App\Module\Admin\BasePresenter;
use Nette\Http\IResponse;

final class HomepagePresenter extends BasePresenter
{
    public function actionDefault()
    {
        $this->template->celkem_aut = '';
        $this->template->celkem_poptavek = '';
    }
}