<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $pj_id
 * @property string $pj_name
 * @property integer $pj_vendor_id
 * @property integer $pj_work_cat
 * @property integer $pj_fiscalyear
 * @property string $pj_date_approved
 * @property integer $pj_user_create
 * @property integer $pj_user_update
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $workcat_search;
	public $sumcost = 0;


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
			array('pj_name, pj_vendor_id, pj_work_cat, pj_fiscalyear, pj_user_create, pj_user_update', 'required'),
			array('pj_vendor_id, pj_work_cat, pj_fiscalyear, pj_user_create, pj_user_update', 'numerical', 'integerOnly'=>true),
			array('pj_name', 'length', 'max'=>400),
			array('pj_date_approved', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pj_id,pj_cost, pj_name,pj_CA, pj_vendor_id, pj_work_cat, pj_fiscalyear, pj_date_approved, pj_user_create, pj_user_update,workcat_search', 'safe', 'on'=>'search'),
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
            'outsource' => array(self::HAS_MANY, 'OutsourceContract', 'oc_proj_id'),
            'contract' => array(self::HAS_MANY, 'ProjectContract', 'pc_proj_id'),
            'workcat' => array(self::BELONGS_TO, 'WorkCategory', 'pj_work_cat'),

        );
    }

    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pj_id' => 'id project',
			'pj_name' => 'ชื่อโครงการ',
			'pj_vendor_id' => 'บริษัทที่ว่าจ้าง',
			'pj_work_cat' => 'ประเภทงาน',
			'pj_fiscalyear' => 'ปีงบประมาณ',
			'pj_date_approved' => 'วันที่อนุมัติ',
			'pj_user_create' => 'ผู้สร้างโครงการ',
			'pj_user_update' => 'ผู้บันทึก',
			'pj_CA' => 'หมายเลข CA',
			'pj_cost'=> 'วงเงินรวม'
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
		//$criteria->compare('pj_cost',$this->sumcost);
		$criteria->compare('pj_name',$this->pj_name,true);
		$criteria->compare('pj_vendor_id',$this->pj_vendor_id);
		$criteria->compare('pj_work_cat',$this->pj_work_cat);
		$criteria->compare('pj_fiscalyear',$this->pj_fiscalyear);
		$criteria->compare('pj_date_approved',$this->pj_date_approved,true);
		$criteria->compare('pj_user_create',$this->pj_user_create);
		$criteria->compare('pj_user_update',$this->pj_user_update);
		$criteria->compare('pj_CA',$this->pj_CA,true);
		$criteria->compare('workcat.wc_name',$this->workcat_search);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->pj_date_approved);
            if(count($str_date)>1)
            	$this->pj_date_approved = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            

            foreach($this->getRelated('contract') as $projectCost)
   			{
     			$this->sumcost += $projectCost->pc_cost;
   			}
    }
    protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->pj_date_approved);
            if(count($str_date)>1)
            	$this->pj_date_approved = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            
    }
    public function beforeSave()
    {
        if($this->pj_date_approved!="")
        {

            $str_date = explode("/", $this->pj_date_approved);
            if(count($str_date)>1)
            $this->pj_date_approved= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        }	

        return parent::beforeSave();
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
