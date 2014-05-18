<?php
namespace App\Components\Forms;

use FrontModule\BasePresenter;
use Nette\Application\UI\Form AS AppForm;
use App\BootstrapFormRenderer\Bootstrap3Renderer as BootstrapRenderer;

use Nette\Forms\Form as NForm;
use Nette\Forms\IControl;
use Nextras\Forms\Rendering\Bs3FormRenderer;

//setup of default rule messages

\Nette\Forms\Rules::$defaultMessages = array(
    NForm::PROTECTION => 'Došlo k chybě při odesílání formuláře. Zkuste to prosím znovu.',
    NForm::EQUAL => 'Prosím vložte %s.',
    NForm::FILLED => 'Vyplňte prosím pole %label.',
    NForm::MIN_LENGTH => 'Do pole %label vyplňte prosím alespoň %d znaků.',
    NForm::MAX_LENGTH => 'Prosím vyplňte nejvýše %d znaků do pole $label.',
    NForm::LENGTH => 'Do pole %label vyplňte minimálně %d a maximálně %d znaků.',
    NForm::EMAIL => 'Zkontrolujte prosím e-mailovou adresu v poli %label.',
    NForm::URL => 'Do pole %label zadejte prosím URL adresu ve správném formátu.',
    NForm::INTEGER => 'Do pole %label prosím zadejte celočíselnou hodnotu.',
    NForm::FLOAT => 'Do pole %label prosím zadejte číselnou hodnotu.',
    NForm::RANGE => 'Do pole %label prosím vyplňte číslo mezi %d a %d.',
    NForm::MAX_FILE_SIZE => 'Maximální velikost nahraného souboru může být %d bytů.',
    NForm::IMAGE => 'Nahraný soubor musí být obrázek ve formátu JPEG, GIF nebo PNG.',
);
/**
 * Base form for every form in app. Adds extended field type to forms
 *
 * @author Jan Langer <langeja1@fit.cvut.cz>
 * @package Maps\Components\Forms
 */

class BaseForm extends AppForm {

    /**
     * @inheritdoc
     */
    public function __construct() {
        parent::__construct();
        $this->addProtection();
        $this->setRenderer(new \BS3FormRenderer\Bs3FormRenderer());
    }

    /**
     * @param string $message adds form error as flash message
     */
    public function addError($message) {
        if(trim($message) != "")
            $this->getPresenter()->flashMessage($message, BasePresenter::FLASH_ERROR);
        $this->valid = FALSE;
    }



    /**
     * {@inheritdoc}
     */
    public function addSubmit($name, $caption = NULL) {
        $component = parent::addSubmit($name, $caption);
        $component->getControlPrototype()->addClass("btn-primary");
        return $component;

    }



}

interface IBaseFormFactory {
    /** @return BaseForm */
    public function create();
}