<?php

class ms2KanboardOfficeItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'ms2kNewsletter';
    public $classKey = 'ms2kNewsletter';
    public $languageTopics = ['ms2kanboard'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2kanboard_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2kanboard_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'ms2KanboardOfficeItemCreateProcessor';