<?php declare(strict_types=1);

namespace App\Module\Admin\Document;

use App\Module\Admin\BasePresenter;
use Nette\Http\IResponse;

final class DocumentPresenter extends BasePresenter
{
    public function actionOrder()
    {
        $this->template->celkem_aut = '';
        $this->template->celkem_poptavek = '';
    }

    public function actionInvoice()
    {
        $this->template->celkem_aut = '';
        $this->template->celkem_poptavek = '';
    }
}