<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $u_id
 * @property string $username
 * @property string $password
 * @property integer $u_group
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	public function primaryKey()
	{
	    return 'u_id';
	    // For composite primary key, return an array like the following
	    // return array('column name 1', 'column name 2');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, u_group', 'required'),
			array('u_group', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>200),
			array('password', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('u_id, username, password, u_group', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'u_id' => 'U',
			'username' => 'Username',
			'password' => 'Password',
			'u_group' => 'กลุ่มผู้ใช้งาน',
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

		$criteria->compare('u_id',$this->u_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('u_group',$this->u_group);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getGroupName($gid)
    {
        switch ($gid) {
        	case 1:
        		$name = "admin";
        		break;
        	case 2:
        		$name = "superuser";
        		break;
        	case 3:
        		$name = "user";
        		break;	
        	default:
        		$name = "";
        		break;
        }
        return $name;
    }
	public function validatePassword($password)
    {
        return sha1($password)===$this->password;
    }
    
    public function beforeSave()
    {
        
            $this->password= sha1($this->password);
             
            return parent::beforeSave();
    }

}
