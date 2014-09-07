<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php 
       /* Yii::app()->getClientScript()->reset(); 
        Yii::app()->bootstrap->register();   */
        
        ?>
        <?php echo Yii::app()->bootstrap->init();?>
</head>
<link rel="shortcut icon" href="../favicon.ico">
    <style>
.navbar .brand {
display: block;
float: left;
padding: 10px 20px 10px;
margin-left: -20px;
font-size: 20px;
font-weight: 200;
color: #fff;
text-shadow: 0 0 0 #ffffff;
}        
        
.navbar .nav > li > a{
float: none;
padding: 10px 15px 10px;
color: #fff;
text-decoration: none;
text-shadow: 0 0 0 #ffffff;
}       

.navbar .nav  > li > a:hover, .nav > li > a:focus {
    float: none;
padding: 10px 15px 10px;
color: #fff;
text-decoration: none;
text-shadow: 0 0 0 #ffffff;
    background-color: #33aa33;
}
.navbar .nav  > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
    color: #ffffff;
     background-color: #499249;

}       
 .navbar-inner {
	background-color:#229922;
        color:#ffffff;
  	border-radius:0;
}
  
.navbar-inner .navbar-nav > li > a {
  	color:#fff;
  	padding-left:20px;
  	padding-right:20px;
}
.navbar-inner .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus {
    color: #ffffff;
     background-color: #33aa33;
	background-color:transparent;
}
      
.navbar-inner .navbar-nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none;
    background-color: #33aa33;
}
      
.navbar-inner .navbar-brand {
  	color:#eeeeee;
}
.navbar-inner .navbar-toggle {
  	background-color:#eeeeee;
}
.navbar-inner .icon-bar {
  	background-color:#33aa33;
}

.nav .open>a, .nav .open>a:hover, .nav .open>a:focus {
	background-color: #33aa33;
	border-color: #428bca;
}
        
    </style>     
     
<body>

<?php 
   

if(!Yii::app()->user->isGuest)
{

   $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noPrint'),
    'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '/dist/img/hospital-icon.png', 'Logo', array('width' => '20', 'height' => '20'))."  ".Yii::app()->name,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home','icon'=>'home', 'url'=>array('/site/index')),
                
                
            ),
        ),    
        array(
            'class'=>'bootstrap.widgets.TbButtonGroup',           
            'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'=>array(
                    //array('label'=>Yii::app()->user->title.Yii::app()->user->firstname."   ".Yii::app()->user->lastname,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('label'=>Yii::app()->user->username,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('items'=>array(
                        array('label'=>'เปลี่ยนรหัสผ่าน','icon'=>'cog', 'url'=>array('/staff/password/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest),
                        '---',
                        array('label'=>'ออกจากระบบ','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                ),
            
        ),
        ),
    ));
}
else if(!Yii::app()->user->isGuest)
{
    
   $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noPrint'),
    'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '/dist/img/hospital-icon.png', 'Logo', array('width' => '20', 'height' => '20'))."  ".Yii::app()->name,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'รายชื่อผู้เข้ารับบริการ','icon'=>'user', 'url'=>array('/treatmentRecord/indexDoctor'), 'visible'=>Yii::app()->user->isDoctor()),
              
            ),
        ),    
        array(
            'class'=>'bootstrap.widgets.TbButtonGroup',           
            'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'=>array(
                    array('label'=>Yii::app()->user->title.Yii::app()->user->firstname."   ".Yii::app()->user->lastname,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('items'=>array(
                        array('label'=>'เปลี่ยนรหัสผ่าน','icon'=>'cog', 'url'=>array('/staff/password/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest),
                        '---',
                        array('label'=>'ออกจากระบบ','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                ),
            
        ),
        ),
    ));
    
}
else{
    $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noprint'),
    'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '/dist/img/hospital-icon.png', 'Logo', array('width' => '20', 'height' => '20'))."  ".Yii::app()->name,
   
    ));
}   
 
   ?>

    <div class="container" id="page" style="padding-top: 50px">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>


</div><!-- page -->

</body>
</html>
