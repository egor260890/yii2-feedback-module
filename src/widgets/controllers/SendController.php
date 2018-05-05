<?php
namespace egor260890\feedback\widgets\controllers;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.05.2018
 * Time: 9:29
 */
use egor260890\feedback\forms\FeedbackForm;
use egor260890\feedback\services\FeedbackManageService;
use yii\base\Module;
use yii\filters\AjaxFilter;

class SendController extends \yii\web\Controller
{
    private $service;
    private $request;

    public function __construct($id, Module $module,FeedbackManageService $service, array $config = [])
    {
        $service->attachMany(\Yii::$app->getModule('feedback-send')->observers);
        $this->request=\Yii::$app->request;
        $this->service=$service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors=[
            [
                'class' => AjaxFilter::class,
                'only'=>['index']
            ],
        ];
        return array_merge($behaviors,parent::behaviors());
    }

    public function actionIndex(){
        \Yii::$app->response->format='json';
        $form=new FeedbackForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try{
                $this->service->create($form);
            }catch (\Exception $e){
                Yii::$app->errorHandler->logException($e);
            }
        }else{
            throw new BadRequestHttpException('Bad request');
        }
        return 'success';
    }

}