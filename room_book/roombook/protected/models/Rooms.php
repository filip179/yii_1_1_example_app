<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $name
 * @property int $capacity
 * @property bool $multimedia
 */
class Rooms extends CActiveRecord
{
    public static function getNameSpecific($id)
    {
        return self::model()->findByPk($id)->name;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return static the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return CActiveDataProvider
     */
    public static function findAllProvider()
    {
        $criteria = new CDbCriteria();

        return new CActiveDataProvider(__CLASS__, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
                'itemCount' => count($criteria),
            ),
            'sort' => array(
                'defaultOrder' => 'name ASC',
            )
        ));
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'rooms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, capacity', 'required'),
            array('name', 'length', 'max' => 50),
            array('multimedia', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'events' => array(self::HAS_MANY, 'Events', 'roomid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'name' => 'Name',
            'capacity' => 'Capacity',
            'multimedia' => 'Has multimedia'
        );
    }

}
