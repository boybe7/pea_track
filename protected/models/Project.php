<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $pj_id
 * @property string $pj_code
 * @property string $pj_name
 * @property integer $pj_work_cat
 * @property integer $pj_fiscalyear
 * @property string $pj_date_approved
 * @property string $pj_details
 * @property integer $pj_user_create
 * @property integer $pj_user_update
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pj_code, pj_name, pj_work_cat, pj_fiscalyear, pj_date_approved, pj_details, pj_user_create, pj_user_update', 'required'),
			array('pj_work_cat, pj_fiscalyear, pj_user_create, pj_user_update', 'numerical', 'integerOnly'=>true),
			array('pj_code', 'length', 'max'=>50),
			array('pj_name', 'length', 'max'=>400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pj_id, pj_code, pj_name, pj_work_cat, pj_fiscalyear, pj_date_approved, pj_details, pj_user_create, pj_user_update', 'safe', 'on'=>'search'),
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
			'pj_id' => 'id project',
			'pj_code' => 'หมายเลขงานโครงการ',
			'pj_name' => 'ชื่อโครงการ',
			'pj_work_cat' => 'ประเภทงาน',
			'pj_fiscalyear' => 'ปีงบประมาณ',
			'pj_date_approved' => 'วันที่อนุมัติ',
			'pj_details' => 'รายละเอียด',
			'pj_user_create' => 'ผู้สร้างโครงการ',
			'pj_user_update' => 'ผู้บันทึก',
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

		$criteria->compare('pj_id',$this->pj_id);
		$criteria->compare('pj_code',$this->pj_code,true);
		$criteria->compare('pj_name',$this->pj_name,true);
		$criteria->compare('pj_work_cat',$this->pj_work_cat);
		$criteria->compare('pj_fiscalyear',$this->pj_fiscalyear);
		$criteria->compare('pj_date_approved',$this->pj_date_approved,true);
		$criteria->compare('pj_details',$this->pj_details,true);
		$criteria->compare('pj_user_create',$this->pj_user_create);
		$criteria->compare('pj_user_update',$this->pj_user_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
