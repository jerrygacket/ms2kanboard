<?php

class ms2KanboardItemGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'ms2KanboardItem';
    public $classKey = 'ms2KanboardItem';
    public $languageTopics = ['ms2kanboard:default'];
    //public $permission = 'view';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return mixed
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        return parent::process();
    }

}

return 'ms2KanboardItemGetProcessor';