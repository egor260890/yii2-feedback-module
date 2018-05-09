<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.05.2018
 * Time: 17:18
 */


use egor260890\feedback\entities\Feedback;

class FeedbackTest extends \Codeception\Test\Unit
{

    public function setUp()
    {
        return parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testCreate(){
        $feedback=Feedback::create('name','tel','email','message','company_name');
        $this->assertEquals('name',$feedback->getName());
        $this->assertEquals('tel',$feedback->getTel());
        $this->assertEquals('email',$feedback->getEmail());
        $this->assertEquals('message',$feedback->getMessage());
        $this->assertEquals('company_name',$feedback->getCompany_name());
        $this->assertInstanceOf(\egor260890\feedback\entities\FeedbackInterface::class,$feedback);
        $this->assertEquals($feedback->status,Feedback::STATUS_UNREVIEWED);
    }

    public function testStatus(){
        $feedback=new Feedback();
        $feedback->unreviewed();
        $this->assertTrue($feedback->isUnreviewed());
        $this->assertFalse($feedback->isViewed());
        $this->assertEquals($feedback->status,Feedback::STATUS_UNREVIEWED);
        $this->assertNotEquals($feedback->status,Feedback::STATUS_VIEWED);
        $feedback->viewed();
        $this->assertTrue($feedback->isViewed());
        $this->assertFalse($feedback->isUnreviewed());
        $this->assertEquals($feedback->status,Feedback::STATUS_VIEWED);
        $this->assertNotEquals($feedback->status,Feedback::STATUS_UNREVIEWED);

    }

}