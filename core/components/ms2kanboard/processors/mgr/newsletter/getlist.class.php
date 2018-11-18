<?php

class ms2kNewsletterGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'ms2kNewsletter';
    public $classKey = 'ms2kNewsletter';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where([
                'name:LIKE' => "%{$query}%",
                'OR:description:LIKE' => "%{$query}%",
            ]);
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('ms2kanboard_newsletter_update'),
            //'multiple' => $this->modx->lexicon('ms2kanboard_newsletters_update'),
            'action' => 'updatenewsletter',
            'button' => true,
            'menu' => true,
        ];

        if (!$array['active']) {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('ms2kanboard_newsletter_enable'),
                'multiple' => $this->modx->lexicon('ms2kanboard_newsletters_enable'),
                'action' => 'enablenewsletter',
                'button' => true,
                'menu' => true,
            ];
        } else {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('ms2kanboard_newsletter_disable'),
                'multiple' => $this->modx->lexicon('ms2kanboard_newsletters_disable'),
                'action' => 'disablenewsletter',
                'button' => true,
                'menu' => true,
            ];
        }

        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('ms2kanboard_newsletter_remove'),
            'multiple' => $this->modx->lexicon('ms2kanboard_newsletters_remove'),
            'action' => 'removenewsletter',
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'ms2kNewsletterGetListProcessor';