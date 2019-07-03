<?php

/**
 * The followings are the available columns in table 'tbl_user':
 *
 * @property integer $id
 * @property string $password
 * @property string $email
 * @property string $type
 */
class User extends CActiveRecord
{
    /**
     * @param $id
     * @return string
     */
    public static function getEmailSpecific($id)
    {
        return User::model()->findByPk($id)->email;
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
     * @return mixed
     */
    public static function getType()
    {
        return self::model()->findByPk(Yii::app()->user->getId())->type;
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
                'defaultOrder' => 'email ASC',
            )
        ));
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password, email', 'required'),
            array('password, email', 'length', 'max' => 128),
            array('type, id', 'safe'),
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
            'event' => array(self::HAS_MANY, 'Events', 'userid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'password' => 'Password',
            'email' => 'Email',
            'type' => 'User type'
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    /**
     * Generates the password hash.
     * @param string $password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
}
