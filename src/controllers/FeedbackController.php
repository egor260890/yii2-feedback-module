<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.05.2018
 * Time: 15:39
 */

namespace egor260890\feedback\controllers;


use yii\web\Controller;
use egor260890\feedback\forms\search\FeedbackSearch;
use egor260890\feedback\services\FeedbackManageService;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\filters\AjaxFilter;

class FeedbackController extends Controller
{

    private $feedbackManageService;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors=[
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only'=>['delete-multiple','unreviewed-multiple','viewed-multiple']
            ],
        ];
        return array_merge($behaviors,parent::behaviors());
    }

    public function __construct($id, Module $module, array $config = [],FeedbackManageService $feedbackManageService)
    {
        $this->feedbackManageService=$feedbackManageService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedback model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $feedback=$this->feedbackManageService->findModel($id);
        $this->feedbackManageService->viewed($feedback->id);
        return $this->render('view', [
            'model' => $feedback,
        ]);
    }

    /**
     * Deletes an existing Feedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->feedbackManageService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);

    }

    public function actionDeleteMultiple(){
        if (Yii::$app->request->isAjax){
            $keys=Yii::$app->request->post('keys');
            $this->feedbackManageService->removeMultiple($keys);
            return 'success';
        }else
        {
            throw new BadRequestHttpException('Bad request');
        }
    }

    public function actionUnreviewedMultiple(){
        if (Yii::$app->request->isAjax){
            $keys=Yii::$app->request->post('keys');
            $this->feedbackManageService->unreviewedMultiple($keys);
            return 'success';
        }else
        {
            throw new BadRequestHttpException('Bad request');
        }
    }

    public function actionViewedMultiple(){
        if (Yii::$app->request->isAjax){
            $keys=Yii::$app->request->post('keys');
            $this->feedbackManageService->viewedMultiple($keys);
            return 'success';
        }else
        {
            throw new BadRequestHttpException('Bad request');
        }
    }

    public function actionTest(){
        return 'test';
    }

}