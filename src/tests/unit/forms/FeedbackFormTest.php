<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.05.2018
 * Time: 18:58
 */

use Codeception\Test\Unit;

class FeedbackFormTest extends Unit
{

    public function testCreate(){
        $feedback=\egor260890\feedback\entities\Feedback::create('name','tel','email','message','company_name');
        $form=new \egor260890\feedback\forms\FeedbackForm($feedback);
        $this->assertEquals('name',$form->getName());
        $this->assertEquals('tel',$form->getTel());
        $this->assertEquals('email',$form->getEmail());
        $this->assertEquals('message',$form->getMessage());
        $this->assertEquals('company_name',$form->getCompany_name());
    }

}