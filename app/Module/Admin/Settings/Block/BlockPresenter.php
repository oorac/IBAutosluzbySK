<?php declare(strict_types=1);

namespace App\Module\Admin\Settings\Block;

use App\Model\Block;
use App\Module\Admin\BasePresenter;
use Nette\Application\UI\Form;

final class BlockPresenter extends BasePresenter
{
    public const LIST_PAGES = [
      'base' => 'Predvolené',
      'homepage' => 'Úvodná',
      'sluzby' => 'Služby',
      'dopl_sluzby' => 'Doplnkové služby',
      'auta' => 'Autá',
    ];
    private Block $block;

    public function __construct(Block $block)
    {

        parent::__construct();
        $this->block = $block;
    }

    public function actionAdd(): void
    {
        $form = $this->getComponent('blockCreateEdit');
        $form->onSuccess[] = [$this, 'createBlock'];
    }

    public function actionEdit($blockId): void
    {
        $block = $this->block->getContentById($blockId);
        if (!$block) {
            $this->error();
        }

        $form = $this->getComponent('blockCreateEdit');
        $form->setDefaults($block);
        $form->onSuccess[] = [$this, 'editBlock'];
    }

    public function handleDelete($blockId)
    {
        $this->template->block = $this->block->getAllInfoAboutCarById($blockId);
    }

    protected function createComponentBlockCreateEdit(): Form
    {
        if (!in_array($this->getAction(), ['add', 'edit'])) {
            $this->error();
        }
        $form = new Form;
        $form->addHidden('id');
        $form->addSelect('page', 'Pre stránku', self::LIST_PAGES)
            ->setRequired('"Pre stránku" je povinný');
        $form->addText('name', 'Názov bloku')
            ->setRequired('"Názov bloku" je povinný');
        $form->addTextArea('text', 'Obsah bloku')
            ->setHtmlId('mytextarea')
            ->setRequired('"Obsah bloku" je povinný');
        $form->addCheckbox('default', 'Výchozí');
        $form->addSubmit('submit', 'Uložit');
        return $form;
    }

    public function createBlock(Form $form, array $data): void
    {
        unset($data['id']);
        $data['default'] = 1;
        $this->block->add($data);
        $this->flashMessage('Úspešne pridané', 'success');
        $this->redirect(':Admin:Settings:block');
    }

    public function editBlock(Form $form, array $data): void
    {
        $id = $data['id'];
        unset($data['id']);
        $this->block->update($id, $data);
        $this->flashMessage('Úspešne upravené','success');
        $this->redirect(':Admin:Settings:block');
    }
}