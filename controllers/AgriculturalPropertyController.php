<?php

namespace app\controllers;

use Yii;
use app\models\Agriculturalproperty;
use app\models\AgriculturalpropertySearch;
use app\models\Location;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
/**
 * AgriculturalPropertyController implements the CRUD actions for Agriculturalproperty model.
 */
class AgriculturalPropertyController extends Controller
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
     * Lists all Agriculturalproperty models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgriculturalpropertySearch();
        $searchModel->city_id = $_GET['city'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => "Sale and Rent",
        ]);
    }

    public function actionIndexhome()
    {
        $searchModel = new AgriculturalpropertySearch();
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
        
        $dataProvider = $searchModel->searchHome();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => "Sale and Rent",
        ]);
    }

    /**
     * Displays a single Agriculturalproperty model.
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
     * Creates a new Agriculturalproperty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agriculturalproperty();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agriculturalproperty model.
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
     * Deletes an existing Agriculturalproperty model.
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
     * Finds the Agriculturalproperty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agriculturalproperty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agriculturalproperty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxGetPropertiesUpdate()
    {
        //echo "<pre>"; print_r($_GET);exit;
        $searchModel = new AgriculturalpropertySearch();
        $dataProvider = $searchModel->search($_GET);
        $locationnames = [];
        if(isset($searchModel->location_id))
        {
            $locas = Location::find()->where(['in','id', $searchModel->location_id])->all();
            $locationnamestemp = ArrayHelper::toArray($locas,['app\models\Location' =>['location']]);
            foreach ($locationnamestemp as $location) {
                $locationnames[] = $location['location'];
            }
        }

        if(isset($searchModel->amenities) && $searchModel->amenities != "" )
        {
            $newarr = [];
            $amenitiesarr = explode(",", $searchModel->amenities);
            //echo "<pre>"; print_r($amenitiesarr);
            foreach ($dataProvider->getModels() as $modl) {
                $propamenityids = \app\models\AgriculturalpropertyAmenities::find()->where(['property_id' => $modl->id])->all();
                $ids=[];
                if($propamenityids)
                {
                    //print_r($propamenityids);
                    foreach ($propamenityids as $val) {
                        //echo $val->amenity_id." =><br/>";
                        if(in_array($val->amenity_id, $amenitiesarr, true) == true);
                        {
                            //echo "in array".in_array($val->amenity_id, $amenitiesarr);
                            $newarr[]=$modl;
                            break;
                        }
                    }
                }
            }
            //exit;
            $provider = new ArrayDataProvider([
                'allModels' => $newarr,
                'pagination' => false,
            ]);
            return $this->renderPartial('property_item', [
                'searchModel' => $searchModel,
                'dataProvider' => $provider,
                'locationname' => implode(",", $locationnames),
                'propby' => $searchModel->property_by,
                'availablefr' => $searchModel->available_for,
            ]);
        }
        else
        {
        
            return $this->renderPartial('property_item', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'locationname' => implode(",", $locationnames),
                'propby' => "",
                'availablefr' => $searchModel->available_for,
            ]);
        }
    }
}
