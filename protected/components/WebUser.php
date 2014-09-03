<?php
// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

// Store model to not repeat query.
private $_model;

// Return
// access it by Yii::app()->user->username
function getUsername(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->username;
   // return $user->title." ".$user->firstname." ".$user->lastname;
}
// access it by Yii::app()->user->title
function getTitle(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->title;
    
}
// access it by Yii::app()->user->firstname
function getFirstName(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->firstname;
    
}
// access it by Yii::app()->user->lastname
function getLastName(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->lastname;
    
}

// access it by Yii::app()->user->usertype
function getUsertype(){
    $user = $this->loadUser(Yii::app()->user->id);
    $usertype=StaffType::model()->findByPk($user->type_id);
    if(Yii::app()->user->id == 0)
    {  
        $usertype = new StaffType();
        return $usertype->name = "guest";     
    }
    else    
         return $usertype->name;
}

// This is a function that checks the field 'role'
// in the User model to be equal to 1, that means it's admin
// Yii::app()->user->isGuest
// Yii::app()->user->isAdmin()
// Yii::app()->user->isDoctor()
// Yii::app()->user->isNurse()
// Yii::app()->user->isCashier()
 function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->type_id == "A";
  }

function isDoctor(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->type_id == "D";
}
function isNurse(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->type_id == "N";
}
function isCashier(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->type_id == "C";
}

// Load user model.
protected function loadUser($id=null)
{
    if($this->_model===null)
    {
        if($id!==null)
            $this->_model=Staff::model()->findByPk($id);
        else
        {
            $this->_model = new Staff();
            $this->_model->username = "Guest";
            $this->_model->type_id = 0;
        }
    }
    return $this->_model;
}

}
?>
