<?php

class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
       

	/**
	 * Displays the progress page
	 */
	public function actionProgress()
	{
            

		
		// display the progress form
		$this->render('progress');
	}

	
	 public function actionGenProgress()
    {
        
    	
    	if(isset($_POST["project"]) && !empty($_POST["project"])) 
    	   $model = Project::model()->findByPk($_POST["project"]);
    	else
    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

        $this->renderPartial('_formProgress2', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }
}