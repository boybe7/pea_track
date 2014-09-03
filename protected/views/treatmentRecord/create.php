<?php
$this->breadcrumbs=array(
	'Treatment Records'=>array('index'),
	'Create',
);

?>

<h1>Create TreatmentRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>