<?php

/**
 * This is the model class for table "treatment_record".
 *
 * The followings are the available columns in table 'treatment_record':
 * @property integer $id
 * @property integer $HN
 * @property string $visit_date
 * @property string $time
 * @property integer $bloodPressure1
 * @property integer $bloodPressure2
 * @property integer $temperature
 * @property integer $rate
 * @property integer $pulse
 * @property string $symptomID
 * @property string $diagID1
 * @property string $diagID2
 * @property string $diagID3
 * @property integer $nurseID
 * @property integer $doctorID
 * @property integer $cashierID
 */
class TreatmentRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $firstname;
        public $lastname;
        public $title;
        public $hour;
        public $minute;
        public $bloodpressure; 
        public $allergy;
        public $drugs;
        public $check;
        public function tableName()
	{
		return 'treatment_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HN, visit_date', 'required'),
			array('HN, bloodPressure1, bloodPressure2, rate, pulse', 'numerical', 'integerOnly'=>true),
                        array('HN+visit_date', 'application.extensions.uniqueMultiColumnValidator'),
                        //array('bill_No','unique', 'message'=>'This bill_No already exists.'),
                        array('temperature', 'length', 'max'=>5),
                        array('temperature', 'numerical', 'allowEmpty' => true,
                                'integerOnly' => false),
                        array('temperature', 'application.extensions.numericRangeValidator', 'min'=>25.00, 'max'=>50.00),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,firstname, HN, visit_date, bloodPressure1, bloodPressure2, temperature, rate, pulse, symptomID, diagID1, diagID2, diagID3, nurseID, doctorID, cashierID', 'safe', 'on'=>'search'),
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
			'Patient' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'Patient',       // model
					'HN'     // FK

				),
                        'Doctor' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'Staff',       // model
					'doctorID'     // FK

				)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'HN' => 'เลขที่ผู้ป่วย',
			'visit_date' => 'วันที่เข้ารับการบริการ',
                        'visit_time' => 'เวลา',
			'bloodPressure1' => 'Blood Pressure1',
			'bloodPressure2' => 'Blood Pressure2',
			'temperature' => 'อุณหภูมิร่างกาย',
			'rate' => 'อัตราการหายใจ',
			'pulse' => 'ชีพจร',
			'symptomID' => 'อาการ',
			'diagID1' => 'Diag Id1',
			'diagID2' => 'Diag Id2',
			'diagID3' => 'Diag Id3',
			'nurseID' => 'พยาบาล',
			'doctorID' => 'แพทย์',
			'cashierID' => 'เจ้าหน้าที่การเงิน',
                        'firstname'=>'ชื่อ',
                        'lastname'=>'นามสกุล',
                        'title'=>'คำนำหน้า',
                        'bloodpressure'=>'ความดันโลหิต',
                        'symp_code'=>'รหัสอาการ',
                        'check'=>'แสดงรายการที่บันทึกแล้ว'
		);
	}
        
         protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->visit_date);
            //$this->visit_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]-543);
            $this->visit_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            //$this->visit_date=date('Y/m/d', strtotime(str_replace("-", "", $this->visit_date)));       
        }
         public function beforeSave()
        {
          
           // $this->visit_date = date('Y-m-d', strtotime($this->visit_date));
            //$this->visit_date = date('Y-m-d', strtotime(str_replace("/", "-", $this->visit_date)));
              $str_date = explode("/", $this->visit_date);
                        $this->visit_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
            return parent::beforeSave();
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

		$criteria->compare('id',$this->id);
		$criteria->compare('HN',$this->HN);
		$criteria->compare('visit_date',$this->visit_date,true);
		$criteria->compare('bloodPressure1',$this->bloodPressure1);
		$criteria->compare('bloodPressure2',$this->bloodPressure2);
		$criteria->compare('temperature',$this->temperature);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('pulse',$this->pulse);
		$criteria->compare('symptomID',$this->symptomID,true);
		$criteria->compare('diagID1',$this->diagID1,true);
		$criteria->compare('diagID2',$this->diagID2,true);
		$criteria->compare('diagID3',$this->diagID3,true);
		$criteria->compare('nurseID',$this->nurseID);
		$criteria->compare('doctorID',$this->doctorID);
		$criteria->compare('cashierID',$this->cashierID);
                
 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchPresent()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$today = date('Y-m-d');
                
                $str_date = explode("-", $today);
                $today = ($str_date[0]+543)."-".$str_date[1]."-".$str_date[2];
		
                $criteria->compare('visit_date',$today,true);
                
                $criteria->addSearchCondition('Patient.firstname',$this->firstname,true); //use for search    
		$criteria->with=array('Patient'); //jointable
                $criteria->with=array('Doctor'); //jointable

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'visit_time ASC')
		));
	}
        
         public function searchPresentDoctor()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$today = date('Y-m-d');
		 $str_date = explode("-", $today);
                $today = ($str_date[0]+543)."-".$str_date[1]."-".$str_date[2];
               
                $criteria->addCondition('diagID1=""');
                $criteria->with=array('Patient'); //jointable
                $criteria->with=array('Doctor'); //jointable
                $criteria->compare('visit_date',$today,true);
                $criteria->compare('doctorID',Yii::app()->user->id,true);
                $criteria->addSearchCondition('Patient.firstname',$this->firstname,true); //use for search    
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'visit_time ASC')
		));
	}
         
         public function searchPresentDoctorRecord()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$today = date('Y-m-d');
		 $str_date = explode("-", $today);
                $today = ($str_date[0]+543)."-".$str_date[1]."-".$str_date[2];
                $criteria->addCondition('diagID1!=""');
                $criteria->compare('visit_date',$today,true);
                $criteria->compare('doctorID',Yii::app()->user->id,true);
                $criteria->together = true;
                $criteria->with=array('Patient'); //jointable
                $criteria->compare('Patient.firstname',$this->firstname,true); //use for search    
		$criteria->compare('Patient.HN',$this->HN,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'visit_time ASC')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TreatmentRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
