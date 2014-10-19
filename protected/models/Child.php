<?php
 
/**
 * This is the model class for table "children".
 *
 * The followings are the available columns in table 'children':
 * @property integer $id
 * @property integer $father_id
 * @property string $name
 * @property integer $age
 *
 * The followings are the available model relations:
 * @property Fathers $father
 */
class Child extends CActiveRecord
{
 
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Child the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'children';
    }
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('father_id, name, age', 'required'),
            array('father_id, age', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, father_id, name, age', 'safe', 'on' => 'search'),
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
            'father' => array(self::BELONGS_TO, 'Father', 'father_id'),
        );
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'father_id' => 'Father',
            'name' => 'Name',
            'age' => 'Age',
        );
    }
 
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
 
        $criteria = new CDbCriteria;
 
        $criteria->compare('id', $this->id);
        $criteria->compare('father_id', $this->father_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('age', $this->age);
 
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
 
     
 
}