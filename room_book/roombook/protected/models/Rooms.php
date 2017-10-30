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
	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
			array('name', 'length', 'max'=>50),
			array('multimedia', 'safe'),
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
            'multimedia' => 'Has multimedia?'
		);
	}

    public static function getNameSpecific($id){
        return Rooms::model()->findByPk($id)->name;
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
                'itemCount' => sizeof($criteria),
            ),
            'sort' => array(
                'defaultOrder' => 'name ASC',
            )
        ));
    }

}
