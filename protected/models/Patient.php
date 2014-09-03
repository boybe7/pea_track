<?php

/**
 * This is the model class for table "patient".
 *
 * The followings are the available columns in table 'patient':
 * @property integer $HN
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $birthdate
 * @property string $sex
 * @property string $id_no
 * @property string $phone
 * @property string $emergency_phone
 * @property string $allergy
 * @property string $address
 * @property string $sub_district
 * @property string $district
 * @property string $province
 * @property string $drug_typeID
 */
class Patient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $drugTypename;
        public $age; 
         
	public function tableName()
	{
		return 'patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' firstname, lastname, province,district,birthdate, sex, id_no, emergency_phone, drug_typeID', 'required'),
			array('id_no', 'numerical', 'integerOnly'=>true),
                        array('id_no', 'length', 'min'=>13,'max'=>13,'tooLong'=>"{attribute} ต้องเท่ากับ 13.",'tooShort'=>"{attribute} ต้องมี 13 ตัว"),
		
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('HN, title, firstname, lastname, birthdate, sex, id_no, phone, emergency_phone, allergy,drugTypename, address, sub_district, district, province, drug_typeID', 'safe', 'on'=>'search'),
		);
	}
        protected function afterFind(){
            parent::afterFind();
              $str_date = explode("-", $this->birthdate);
           
            $this->birthdate = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            //$this->birthdate=date('m/d/Y', strtotime(str_replace("-", "", $this->birthdate)));       
        }
         public function beforeSave()
        {
           
            //$this->birthdate = date('Y-m-d', strtotime($this->birthdate));
             $str_date = explode("/", $this->birthdate);
             $this->birthdate= $str_date[2]."-".$str_date[1]."-".$str_date[0];
             
            return parent::beforeSave();
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'DrugType' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'DrugType',       // model
					'drug_typeID'     // FK

				),
                    'Province' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'Province',       // model
					'province'     // FK

				),
                    'Amphur' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'Amphur',       // model
					'district'     // FK

				)

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HN' => 'เลขที่ผู้ป่วย',
			'title' => 'คำนำหน้า',
			'firstname' => 'ชื่อ',
			'lastname' => 'นามสกุล',
			'birthdate' => 'วันเกิด',
			'sex' => 'เพศ',
			'id_no' => 'เลขบัตรประชาชน',
			'phone' => 'โทรศัพท์',
			'emergency_phone' => 'เบอร์โทรฉุกเฉิน',
			'allergy' => 'แพ้ยา',
			'address' => 'ที่อยู่',
			'sub_district' => 'ตำบล',
			'district' => 'อำเภอ',
			'province' => 'จังหวัด',
			'drug_typeID' => 'ประเภทยา',
                        'age' => 'อายุ (ปี)',
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

		$criteria->compare('HN',$this->HN);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('id_no',$this->id_no,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('emergency_phone',$this->emergency_phone,true);
		$criteria->compare('allergy',$this->allergy,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('sub_district',$this->sub_district,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('drug_typeID',$this->drug_typeID,true);
                
                $criteria->addSearchCondition('DrugType.id',$this->drugTypename,true); //use for search       
        
                $criteria->with=array('DrugType'); //jointable
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'HN DESC')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
