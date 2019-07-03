<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property int $id
 * @property int $roomid
 * @property int $codename
 * @property bool $name
 */
class Equipment extends CActiveRecord
{
    public static function getNameSpecific($id)
    {
        return Equipment::model()->findByPk($id)->name;
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
    public static function findAllProvider($id)
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('roomid = ' . $id);

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
        return 'equipment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('codename, name', 'required'),
            array('name', 'length', 'max' => 50),
            array('codename', 'length', 'max' => 25),
            array('roomid', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'room' => array(self::HAS_ONE, 'Rooms', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'codename' => 'Unique codename',
            'name' => 'Name',
            'roomid' => 'Room'
        );
    }
}
