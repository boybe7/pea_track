<?php

/**
 * This is the model class for table "drug".
 *
 * The followings are the available columns in table 'drug':
 * @property string $drug_id
 * @property string $drug_name
 * @property string $unit
 * @property integer $price
 * @property string $drug_type_id
 */
class Drug extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $typename; 
	public function tableName()
	{
		return 'drug';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('drug_id, drug_name, unit, price, drug_type_id', 'required'),
			//array('price', 'numerical', 'integerOnly'=>true),
			//edit july2014
                        array('drug_id', 'length', 'max'=>4),
			array('drug_name', 'length', 'max'=>50),
			array('unit', 'length', 'max'=>10),
			array('drug_type_id', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('drug_id, drug_name, unit, price, drug_type_id,typename', 'safe', 'on'=>'search'),
                    
                        array('drug_type_id+drug_id', 'application.extensions.uniqueMultiColumnValidator'),
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
			'DrugType' => array(
				    //self::HAS_MANY, // relation 1:M
					self::BELONGS_TO, // relation M:1
					'DrugType',       // model
					'drug_type_id'     // FK

				)

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'drug_id' => 'รหัสยา',
			'drug_name' => 'ชื่อยา',
			'unit' => 'หน่วย',
			'price' => 'ราคาต่อหน่วย(บาท)',
			'drug_type_id' => 'ประเภทยา',
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

		$criteria->compare('drug_id',$this->drug_id,true);
		$criteria->compare('drug_name',$this->drug_name,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('drug_type_id',$this->drug_type_id,true);

		$criteria->addSearchCondition('DrugType.type_id',$this->typename,true); //use for search       
        
                $criteria->with=array('DrugType'); //jointable
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>10)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Drug the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
