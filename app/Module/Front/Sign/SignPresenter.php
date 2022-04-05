<?php

declare(strict_types=1);

namespace App\Module\Front\Sign;

use App\Module\Front\BasePresenter;
use Nette;
use Nette\Application\UI\Form;


final class SignPresenter extends BasePresenter
{
    /**
     * Sign-in form factory.
     */
    protected function createComponentSignInForm(): Form
    {
        return $this->signInFactory->create(function (): void {
            $this->redirect(':Admin:Homepage:default');
        });
    }

    /**
     * Sign-up form factory.
     */
    protected function createComponentSignUpForm(): Form
    {
        return $this->signUpFactory->create(function (): void {
            $this->flashMessage('Byl jste registrován. Vyčkejte na schválení adminem.', 'warning');
            $this->redirect('Homepage:');
        });
    }

    public function actionDefault()
    {
        
    }

    public function actionOut(): void
    {
        $this->getUser()->logout();
    }
}
