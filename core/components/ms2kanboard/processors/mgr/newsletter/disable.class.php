<?php

class ms2kNewsletterDisableProcessor extends modObjectProcessor
{
    public $objectType = 'ms2kNewsletter';
    public $classKey = 'ms2kNewsletter';
    public $languageTopics = ['ms2kanboard'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('ms2kanboard_newsletter_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var ms2kNewsletter $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('ms2kanboard_newsletter_err_nf'));
            }

            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }

}

return 'ms2kNewsletterDisableProcessor';
