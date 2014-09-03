<?php

/**
 * This is the model class for table "bill".
 *
 * The followings are the available columns in table 'bill':
 * @property string $bill_No
 * @property integer $total
 * @property integer $HN
 * @property string $visit_date
 */
class Bill extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $firstname;
        public $lastname;
        public $title;
        public $drugType;
	public function tableName()
	{
		return 'bill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_No, total, HN, visit_date', 'required'),
			array('total, HN', 'numerical', 'integerOnly'=>true),
			array('bill_No', 'length', 'max'=>10),
                        //array('bill_No','unique', 'message'=>'This bill_No already exists.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bill_No, total, HN, visit_date,firstname,lastname,drugType', 'safe', 'on'=>'search'),
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

				)

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bill_No' => 'เลขที่ใบเสร็จ',
			'total' => 'Total',
			'HN' => 'HN',
			'visit_date' => 'Visit Date',
                        'firstname' => 'firstname'
                    
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
         protected function afterFind(){
            parent::afterFind();
            //$this->visit_date=date('m/d/Y', strtotime(str_replace("-", "", $this->visit_date)));  
           
         
                    $billno = explode("/", $this->bill_No);
                                         
                    if(empty($billno[1]))
                        $this->bill_No = "";
        }
        
         public function beforeSave()
        {
          
         
              $str_date = explode("/", $this->visit_date);
                        $this->visit_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
            return parent::beforeSave();
        }
        
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('bill_No',$this->bill_No,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('HN',$this->HN);
		$criteria->compare('visit_date',$this->visit_date,true);
                $criteria->addSearchCondition('Patient.firstname',$this->firstname,true); //use for search       
        
                $criteria->with=array('Patient'); //jointable

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
                
                $criteria->compare('bill_No',$this->bill_No,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('HN',$this->HN);
		
                $criteria->addSearchCondition('Patient.firstname',$this->firstname,true); //use for search 
                $criteria->addSearchCondition('Patient.lastname',$this->lastname,true); //use for search
                $criteria->addSearchCondition('Patient.drug_typeID',$this->drugType,true); //use for search
                $criteria->with=array('Patient'); //jointable
                //$criteria->with=array('DrugType'); //jointable
                

                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bill the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
