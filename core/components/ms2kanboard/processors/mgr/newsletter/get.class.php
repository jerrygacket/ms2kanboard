<?php

class ms2kNewsletterGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'ms2kNewsletter';
    public $classKey = 'ms2kNewsletter';
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

return 'ms2kNewsletterGetProcessor';