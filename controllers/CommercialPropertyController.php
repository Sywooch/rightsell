<?php

namespace app\controllers;

use Yii;
use app\models\Commercialproperty;
use app\models\CommercialpropertySearch;
use app\models\Location;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CommercialPropertyController implements the CRUD actions for Commercialproperty model.
 */
class CommercialPropertyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Commercialproperty models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommercialpropertySearch();
        // echo "<pre>"; print_r($_GET);exit;
        if(isset($_GET['city']) && $_GET['city'] != "")
            $searchModel->city_id = $_GET['city'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr'=>'Sale and Rent',
        ]);
    }

    public function actionIndexhome()
    {
        $searchModel = new CommercialpropertySearch();
        $searchModel->load(Yii::$app->request->queryParams);
        if($searchModel->min_rate_price != "")
        {
            if($searchModel->min_rate_price < 20)
            {
                $searchModel->min_rate_price = 10 * 100000;
                $searchModel->max_rate_price = 20 * 100000;
            }
            else if($searchModel->min_rate_price < 30)
            {
                $searchModel->min_rate_price = 20 * 100000;
                $searchModel->max_rate_price = 30 * 100000;
            }
            else if($searchModel->min_rate_price < 40)
            {
                $searchModel->min_rate_price = 30 * 100000;
                $searchModel->max_rate_price = 40 * 100000;
            }
        }
        // echo "<pre>"; print_r($searchModel);exit;

        $dataProvider = $searchModel->searchHome();
        // echo "<pre>"; print_r($dataProvider->getModels());exit;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr'=>'Sale and Rent',
        ]);
    }

    /**
     * Displays a single Commercialproperty model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Commercialproperty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Commercialproperty();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Commercialproperty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Commercialproperty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Commercialproperty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Commercialproperty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Commercialproperty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxGetPropertiesUpdate()
    {
        $searchModel = new CommercialpropertySearch();
        $dataProvider = $searchModel->search($_GET);
        // echo "<pre>"; print_r($_GET);exit;
        $locationnames = [];
        if(isset($searchModel->location_id))
        {
            $locas = Location::find()->where(['in','id', $searchModel->location_id])->all();
            $locationnamestemp = ArrayHelper::toArray($locas,['app\models\Location' =>['location']]);
            foreach ($locationnamestemp as $location) {
                $locationnames[] = $location['location'];
            }
        }
        
        return $this->renderPartial('property_item', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'locationname' => implode(",", $locationnames),
            'propby' => "",
            'availablefr' => $searchModel->available_for,
        ]);
    }
}
