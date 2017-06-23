<?php
namespace Concrete\Attribute\Boolean;

use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Concrete\Core\Entity\Attribute\Key\Settings\BooleanSettings;
use Concrete\Core\Entity\Attribute\Value\Value\BooleanValue;
use Core;
use Concrete\Core\Search\ItemList\Database\AttributedItemList;
use Concrete\Core\Attribute\Controller as AttributeTypeController;

class Controller extends AttributeTypeController
{
    protected $searchIndexFieldDefinition = ['type' => 'boolean', 'options' => ['default' => 0, 'notnull' => false]];

    public function getIconFormatter()
    {
        return new FontAwesomeIconFormatter('check-square');
    }

    public function searchForm($list)
    {
        $list->filterByAttribute($this->attributeKey->getAttributeKeyHandle(), $this->request('value'));

        return $list;
    }

    public function filterByAttribute(AttributedItemList $list, $boolean, $comparison = '=')
    {
        $qb = $list->getQueryObject();
        $column = sprintf('ak_%s', $this->attributeKey->getAttributeKeyHandle());
        switch ($comparison) {
            case '<>':
            case '!=':
                $boolean = $boolean ? false : true;
                break;
        }
        if ($boolean) {
            $qb->andWhere("{$column} = 1");
        } else {
            $qb->andWhere("{$column} <> 1 or {$column} is null");
        }
    }

    public function exportKey($akey)
    {
        $this->load();
        $type = $akey->addChild('type');
        $type->addAttribute('checked', $this->akCheckedByDefault);

        return $akey;
    }

    public function importKey(\SimpleXMLElement $akey)
    {
        $type = $this->getAttributeKeySettings();
        if (isset($akey->type)) {
            $checked = (string) $akey->type['checked'];
            if ($checked != '') {
                $type->setIsCheckedByDefault(true);
            }
        }

        return $type;
    }

    protected function load()
    {
        $ak = $this->getAttributeKey();
        if (!is_object($ak)) {
            return false;
        }

        $this->akCheckedByDefault = $ak
            ->getAttributeKeySettings()->isCheckedByDefault();
        $this->set('akCheckedByDefault', $this->akCheckedByDefault);
    }

    public function form()
    {
        $checked = false;
        if (is_object($this->attributeValue)) {
            $value = $this->getAttributeValue()->getValue();
            $checked = $value == 1 ? true : false;
        } else {
            $this->load();
            if ($this->akCheckedByDefault) {
                $checked = true;
            }
        }
        $this->set('checked', $checked);
    }

    public function type_form()
    {
        $this->set('form', Core::make('helper/form'));
        $this->load();
    }

    // run when we call setAttribute(), instead of saving through the UI
    public function createAttributeValue($value)
    {
        $v = new BooleanValue();
        $value = ($value == false || $value == '0') ? false : true;
        $v->setValue($value);

        return $v;
    }

    public function validateValue()
    {
        $v = $this->getAttributeValue()->getValue();
        return $v == 1;
    }

    public function getSearchIndexValue()
    {
        return $this->attributeValue->getValue() ? 1 : 0;
    }

    public function saveKey($data)
    {
        $type = $this->getAttributeKeySettings();

        $akCheckedByDefault = 0;
        if (isset($data['akCheckedByDefault']) && $data['akCheckedByDefault']) {
            $akCheckedByDefault = 1;
        }

        $type->setIsCheckedByDefault($akCheckedByDefault);

        return $type;
    }

    public function getAttributeValueClass()
    {
        return BooleanValue::class;
    }
    public function createAttributeValueFromRequest()
    {
        $data = $this->post();

        return $this->createAttributeValue(isset($data['value']) ? $data['value'] : false);
    }

    // if this gets run we assume we need it to be validated/checked
    public function validateForm($data)
    {
        return isset($data['value']) && $data['value'] == 1;
    }

    public function getAttributeKeySettingsClass()
    {
        return BooleanSettings::class;
    }

}
