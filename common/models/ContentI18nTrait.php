<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;

trait ContentI18nTrait
{

    protected static $i18nSuffix = '_i18n_';
    protected static $i18nSuffixLen = 6; // ага, треба вручну рахувати... щоб не викликати постійно strpos
    protected static $_i18nLangs;

    protected $i18TmpValuesList = [];

    /**
     * @return mixed
     */
    public function init()
    {
        $this->on(BaseActiveRecord::EVENT_AFTER_INSERT, function () {
            foreach ($this->i18TmpValuesList as $val) {
                $val->id = $this->id;
                if (!$val->save()) {
                    throw new Exception('Something gowing wrong');
                }
            }
        });
        return parent::init();
    }

    //TODO: коротше два наступних метода це глибинні методи ектів рекорда
    //TODO: примушуэм ъх зберыгати в базу значення що не включають в себе поля доданы нами для багатомовносты
    //TODO: бо в бд ъх протсо не існує. Саме ці  методи\, бо менша ймовірність, що хтось захоче їх перезавнатажити
    /**
     * @param null $attributes
     * @return mixed
     */
    protected function insertInternal($attributes = null)
    {
        if ($attributes === null) {
            $attributes = array_keys($this->getAttributes());
        }

        $attributes = array_diff($attributes, $this->getI18nAttributes());

        return parent::insertInternal($attributes);
    }

    /**
     * @param null $attributes
     * @return mixed
     */
    protected function updateInternal($attributes = null)
    {
        if ($attributes === null) {
            $attributes = array_keys($this->getAttributes());
        }

        $attributes = array_diff($attributes, $this->getI18nAttributes());

        return parent::updateInternal($attributes);
    }


    /**
     * В загальний список атрибутів підмішуєм свої
     *
     * @return array
     */
    public function attributes()
    {
        $attrs = parent::attributes();

        foreach ($this->getI18nAttributes() as $attr) {
            $attrs[] = $attr;
        }

        return $attrs;
    }

    /**
     * @return array
     */
    public function getI18nAttributes()
    {
        $result = [];
        foreach (self::$i18nFields as $field) {
            foreach ($this->getI18nLangs() as $lang) {
                $result[] = $this->getI18nFieldTitle($field, $lang);
            }
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public static function getI18nLangs()
    {
        if (empty(self::$_i18nLangs)) {
            self::$_i18nLangs = self::getLanguages();
        }

        return self::$_i18nLangs;
    }

    /**
     * @return array
     */
    protected static function getLanguages()
    {
        $result = [
            substr(Yii::$app->sourceLanguage, 0, 2)
        ];

        foreach (Yii::$app->i18n->languages as $language) {
            $result[] = substr($language, 0, 2);
        }

        return $result;
    }

    /**
     * @param $id
     * @param $field
     * @param $lang
     * @return false|null|string
     */
    private function getValueByLang($id, $field, $lang)
    {
        $value = [
            'id' => $id,
            'type' => $this->i18nType,
            'title' => $field,
            'lang' => $lang
        ];

        if (!$this->isNewRecord) {
            $value = i18nContentValue::find()
                ->select('value')
                ->where($value)
                ->scalar();
        } else {
            $key = $this->getKey($value);
            if (isset($this->i18TmpValuesList[$key])) {
                return $this->i18TmpValuesList[$key]->value;
            }
        }

        return $value;
    }


    /**
     * //TODO: Взагалі це дуже спірне питання лишати перевизначення методу в
     * //TODO: трейті чи реалізовувати якийсь доп метод і вже його юзати в цільовому класі
     * //TODO: Бо по ходу якшо в цільовому класі зараз  реалізувати цей же метод
     * //TODO: і віднаслідуватись від паретна то трейт піде лісом і це буде лажа. На подумати поки
     *
     * Returns the value of a component property.
     *
     * This method will check in the following order and act accordingly:
     *
     *  - a property defined by a getter: return the getter result
     *  - a property of a behavior: return the behavior property value
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$value = $component->property;`.
     * @param string $name the property name
     * @return mixed the property value or the value of a behavior's property
     * @throws UnknownPropertyException if the property is not defined
     * @throws InvalidCallException if the property is write-only.
     * @see __set()
     */
    public function __get($name)
    {
        /* припустим у нас є магічне поле title_i18n_ru
         * цуй блок коду буде шукати його в базі і повертати
         */
        if (($suffixPos = strpos($name, self::$i18nSuffix)) !== false) {
            $lang = substr($name, $suffixPos + self::$i18nSuffixLen);

            if (in_array($lang, $this->i18nLangs)) {
                $titleCleared = substr($name, 0, $suffixPos);

                return $this->getValueByLang($this->getAttribute('id'), $titleCleared, $lang);
            }
        }

        /*
         *  Щоб в коді всди не писати атку фігю типу title_i18n_ru,  ми можем писати просто title
         * тоді наступний блок  коду буде шукати таке поле в моделі і намагатись отирмати його з моделі
         * яка в свою чергу запускатиме цей же магічний метод, але все закінчуватиметься на поепредньому блоці
         */
        if (in_array(self::getI18nFieldTitle($name), $this->getI18nAttributes())) {
            return $this->{self::getI18nFieldTitle($name)};
        }

        return parent::__get($name);
    }

    /**
     * Sets the value of a component property.
     *
     * This method will check in the following order and act accordingly:
     *
     *  - a property defined by a setter: set the property value
     *  - an event in the format of "on xyz": attach the handler to the event "xyz"
     *  - a behavior in the format of "as xyz": attach the behavior named as "xyz"
     *  - a property of a behavior: set the behavior property value
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$component->property = $value;`.
     *
     * @param $name
     * @param $value
     * @return bool|mixed
     * @throws UnknownPropertyException
     */
    public function __set($name, $value)
    {
        if (($suffixPos = strpos($name, self::$i18nSuffix)) !== false) {
            $lang = substr($name, $suffixPos + self::$i18nSuffixLen);

            if (in_array($lang, $this->i18nLangs)) {
                $titleCleared = substr($name, 0, $suffixPos);

                $i18nContentValue = i18nContentValue::find()
                    ->where([
                        'id' => $this->getAttribute('id'),
                        'type' => $this->i18nType,
                        'title' => $titleCleared,
                        'lang' => $lang
                    ])
                    ->one();

                $params = [
                    'id' => $this->getAttribute('id'),
                    'type' => $this->i18nType,
                    'title' => $titleCleared,
                    'lang' => $lang
                ];

                if (empty($i18nContentValue)) {
                    $i18nContentValue = new i18nContentValue($params);
                }

                $i18nContentValue->setAttributes(['value' => $value]);

                if ($this->isNewRecord) { // якшо створення - то анкопичуэм значення
                    $key = $this->getKey($params);
                    $this->i18TmpValuesList[$key] = $i18nContentValue;
                } else { // інакше зберігаєм одразу
                    $i18nContentValue->save();
                }
            }
        }

        return parent::__set($name, $value);
    }

    /**
     * @param array $data
     * @return string
     */
    private function getKey(array $data)
    {
        return md5(implode(',', $data));
    }

    /**
     * @param $fieldTitle
     * @param $lang
     * @return string
     */
    public static function getI18nFieldTitle($fieldTitle, $lang = null)
    {
        if ($lang === null) {
            $lang = substr(\Yii::$app->language, 0, 2);
        }

        return $fieldTitle . self::$i18nSuffix . $lang;
    }

    /**
     * @param $title
     * @return false|null|string
     */
    public function getFieldValue($title)
    {
        return i18nContentValue::find()
            ->select('value')
            ->where([
                'id' => $this->getAttribute('id'),
                'type' => $this->i18nType,
                'title' => $title,
                'lang' => substr(\Yii::$app->language, 0, 2)
            ])
            ->scalar();
    }
}