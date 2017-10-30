<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $begin
 * @property string $end
 * @property string $name
 * @property int $userid
 * @property string $created
 * @property int $roomid
 *
 */
class Events extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return static the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'events';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('begin, end', 'isThereEvent', 'on' => 'create'),
            array('begin, end, name', 'isThereEvent', 'on' => 'create'),
            array('begin, end, name, roomid', 'required'),
            array('name', 'length', 'max' => 128),
            array('userid, id, created, roomid', 'safe'),
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
            'rooms' => array(self::HAS_MANY, 'Rooms', 'id'),
            'user' => array(self::HAS_ONE, 'User', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'begin' => 'Begin',
            'end' => 'End',
            'userid' => 'User',
            'created' => 'Created',
            'name' => 'Title',
            'roomid' => 'Room',
        );
    }

    public function firstRoom($attribute, $params){
        if (!isset($this->roomid)) {
            $this->addError('roomid', 'First choose room.');
            return false;
        }
    }

    public function isThereEvent($attribute, $params)
    {
        if (isset($this->$attribute) && isset($this->roomid)) {
            $sql = '  SELECT 
                    id
                  FROM 
                    events 
                  WHERE 
                    \'' . $this->$attribute . '\' BETWEEN begin AND end AND
                    roomid = ' . $this->roomid;

            $result = Yii::app()->db->createCommand($sql)->query();
            if (sizeof($result) > 0) {
                $this->addError($attribute, 'There is an Event- change Room or ' . $attribute . ' time');
                return false;
            }
        }
    }

    /**
     * Turns array of models into well formated EFullCalendar input array set
     *
     * @return array
     */
    public static function fetchAllForCalendar()
    {
        $result = array();
        $events = self::model()->findAll();
        foreach ($events as $event) {
            $result[] = array(
                'title' => $event->name . ' ' . Rooms::getNameSpecific($event->roomid),
                'start' => $event->begin,
                'end' => $event->end,
                'allDay' => false,
                'url' => Yii::app()->createAbsoluteUrl('/events/view/' . $event->id)
            );
        }
        return $result;
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
                'defaultOrder' => 'begin DESC',
            )
        ));
    }

    public function isOwner()
    {
        if ($this->userid === Yii::app()->user->getId())
            return true;
        return false;
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->userid = Yii::app()->user->getId();
        return parent::beforeSave();
    }
}
