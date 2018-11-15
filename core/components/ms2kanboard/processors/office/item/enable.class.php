<?php

class ms2KanboardOfficeItemEnableProcessor extends modObjectProcessor
{
    public $objectType = 'ms2KanboardItem';
    public $classKey = 'ms2KanboardItem';
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
            return $this->failure($this->modx->lexicon('ms2kanboard_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var ms2KanboardItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('ms2kanboard_item_err_nf'));
            }

            $object->set('active', true);
            $object->save();
        }

        return $this->success();
    }

}

return 'ms2KanboardOfficeItemEnableProcessor';
