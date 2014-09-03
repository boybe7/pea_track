<?php


/**
 * This is the model class for table "staff".
 *
 * The followings are the available columns in table 'staff':
 * @property integer $staff_id
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $type_id
 * @property string $username
 * @property string $password
 */

class Staff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $typename; 
    
	public function tableName()
	{
		return 'staff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, username, password', 'required'),
			array('title, username, password', 'length', 'max'=>20),
			array('firstname, lastname', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>10),
			array('type_id', 'length', 'max'=>1),
                        array('username','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('staff_id, title, firstname, lastname, phone, type_id, username, password,typename', 'safe', 'on'=>'search'),
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
			'StaffType' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'StaffType',       // model
					'type_id'     // FK

				)

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'staff_id' => 'ID',
			'title' => 'คำนำหน้า',
			'firstname' => 'ชื่อ',
			'lastname' => 'นามสกุล',
			'phone' => 'เบอร์โทรศัพท์',
			'type_id' => 'ประเภท',
			'username' => 'Username',
			'password' => 'Password',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('staff_id',$this->staff_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
               // $criteria->compare('StaffType.type_id',$this->typename,true);
                $criteria->addSearchCondition('StaffType.type_id',$this->typename,true); //use for search       
        
                $criteria->with=array('StaffType'); //jointable
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>10)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Staff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function validatePassword($password)
        {
            return $password===$this->password;
        }
        public function hashPassword($password,$username)
        {
            return md5($username.$password);
        }
}
