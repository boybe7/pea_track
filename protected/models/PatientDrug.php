<?php

/**
 * This is the model class for table "patient_drug".
 *
 * The followings are the available columns in table 'patient_drug':
 * @property integer $HN
 * @property string $visit_date
 * @property string $drugID
 * @property integer $quantity
 * @property string $method
 */
class PatientDrug extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patient_drug';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HN, visit_date, drugID, quantity, method', 'required'),
			array('HN, quantity', 'numerical', 'integerOnly'=>true),
			array('drugID', 'length', 'max'=>4),
			array('method', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('HN, visit_date, drugID, quantity, method', 'safe', 'on'=>'search'),
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
        public function beforeSave()
        {
           
            //$this->visit_date = date('Y-m-d', strtotime($this->visit_date));
            $str_date = explode("/", $this->visit_date);
             $this->visit_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
            return parent::beforeSave();
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HN' => 'Hn',
			'visit_date' => 'Visit Date',
			'drugID' => 'Drug',
			'quantity' => 'Quantity',
			'method' => 'Method',
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
		$criteria->compare('visit_date',$this->visit_date,true);
		$criteria->compare('drugID',$this->drugID,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('method',$this->method,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PatientDrug the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
