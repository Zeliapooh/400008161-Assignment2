<?php
namespace COMP3385;

class DashboardFormGenerator extends AbstractFormGenerator
{

    public function generateForm()
    {
        $formContent = $this->openForm('CreateUser.php', 'post', ['class' => 'btn-form']);
        $formContent.= $this->generateButton('Create New Researchers', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]); ;
        $formContent.= $this->closeForm();
        return $formContent;

    }
}