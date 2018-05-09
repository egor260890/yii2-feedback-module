<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.11.2017
 * Time: 22:43
 */

namespace egor260890\feedback\forms;


use egor260890\feedback\entities\Feedback;
use egor260890\feedback\validators\PhoneValidator;
use yii\base\Model;

class FeedbackForm extends Model
{
    private $name;
    private $tel;
    private $status;
    private $email;
    private $message;
    private $company_name;

    private $rules=[
        [['tel','company_name'], 'string'],
        //['tel',PhoneValidator::class],
        [['name','email'],'string','max'=>100],
        ['message','string','max'=>1000],
        ['email','email','message'=>'Неправильный e-mail'],
    ];

    public function __construct(Feedback $feedback=null, $config=[])
    {
        if($feedback){
            $this->name=$feedback->name;
            $this->tel=$feedback->tel;
            $this->email=$feedback->email;
            $this->message=$feedback->message;
            $this->company_name=$feedback->company_name;
            $this->status=$feedback->status;
        }else{
            $this->status=Feedback::STATUS_UNREVIEWED;
        }
        parent::__construct($config);
    }


    public function rules()
    {
        return $this->rules;

    }

    public function addRules(array $rule){
        $this->rules=array_merge($rule,$this->rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'=>'Ваше имя*:',
            'company_name'=>'Компания:',
            'tel'=>'Телефон*:',
            'email'=>'E-mail:',
            'message'=>'Заявка:'
        ];
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function getTel(){
        return $this->tel;
    }

    public function setTel($tel){
        $this->tel=$tel;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status=$status;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message=$message;
    }

    public function getCompany_name(){
        return $this->company_name;
    }

    public function setCompany_name($company_name){
        $this->company_name=$company_name;
    }

}