<?php

/**
 * This is the model class for table "project_contract".
 *
 * The followings are the available columns in table 'project_contract':
 * @property integer $pc_id
 * @property string $pc_code
 * @property integer $pc_proj_id
 * @property integer $pc_vendor_id
 * @property string $pc_details
 * @property string $pc_sign_date
 * @property string $pc_end_date
 * @property double $pc_cost
 * @property integer $pc_T_percent
 * @property integer $pc_A_percent
 * @property string $pc_guarantee
 * @property integer $pc_user_create
 * @property integer $pc_user_update
 */
class ProjectContract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_contract';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pc_code, pc_proj_id, pc_end_date', 'required'),
			array('pc_proj_id, pc_vendor_id, pc_T_percent, pc_A_percent, pc_user_create, pc_user_update', 'numerical', 'integerOnly'=>true),
			array('pc_cost', 'numerical'),
			array('pc_code', 'length', 'max'=>30),
			array('pc_guarantee', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pc_id, pc_code, pc_proj_id, pc_vendor_id, pc_details, pc_sign_date, pc_end_date, pc_cost, pc_T_percent, pc_A_percent, pc_guarantee, pc_user_create, pc_user_update', 'safe', 'on'=>'search'),
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
			'pc_id' => 'id สัญญา',
			'pc_code' => 'เลขที่สัญญา',
			'pc_proj_id' => 'id project',
			'pc_vendor_id' => 'id คู่สัญญา',
			'pc_details' => 'รายละเอียดสัญญา',
			'pc_sign_date' => 'วันที่ลงนาม',
			'pc_end_date' => 'วันที่ครบกำหนด',
			'pc_cost' => 'วงเงิน',
			'pc_T_percent' => '%T',
			'pc_A_percent' => '%A',
			'pc_guarantee' => 'หนังสือค้ำประกัน',
			'pc_user_create' => 'ผู้สร้างสัญญา',
			'pc_user_update' => 'ผู้บันทึก',
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

		$criteria->compare('pc_id',$this->pc_id);
		$criteria->compare('pc_code',$this->pc_code,true);
		$criteria->compare('pc_proj_id',$this->pc_proj_id);
		$criteria->compare('pc_vendor_id',$this->pc_vendor_id);
		$criteria->compare('pc_details',$this->pc_details,true);
		$criteria->compare('pc_sign_date',$this->pc_sign_date,true);
		$criteria->compare('pc_end_date',$this->pc_end_date,true);
		$criteria->compare('pc_cost',$this->pc_cost);
		$criteria->compare('pc_T_percent',$this->pc_T_percent);
		$criteria->compare('pc_A_percent',$this->pc_A_percent);
		$criteria->compare('pc_guarantee',$this->pc_guarantee,true);
		$criteria->compare('pc_user_create',$this->pc_user_create);
		$criteria->compare('pc_user_update',$this->pc_user_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectContract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
