<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Residentialproperty;
use app\models\ResidentialpropertySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\City;
use app\models\Location;
use yii\data\ActiveDataProvider;
/**
 * ResidentialPropertyController implements the CRUD actions for Residentialproperty model.
 */
class ResidentialPropertyController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'get-properties','get-all-cities','index-new','ajax-get-properties-update','get-city-locations'],
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Residentialproperty models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new ResidentialpropertySearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     //echo "<pre>"; print_r($dataProvider->getModels());exit;
    //     //echo "<pre>"; print_r(Yii::$app->request->queryParams);exit;
    //     return $this->render('get-properties', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    public function actionIndex()
    {
        $searchModel = new ResidentialpropertySearch();
        $searchModel->city_id = $_GET['city'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //echo "<pre>"; print_r($searchModel);exit;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => "Sale and Rent",
            'city' => $searchModel->cityName->city,
            'locationname' => "",
            //'location' => $searchModel->locations->name,
        ]);
    }

    /*public function actionIndexNew()
    {
        $params = Yii::$app->request->queryParams;
        $model = new ResidentialpropertySearch();
        $model->load($params);
        //echo "<pre>"; print_r($model);exit;

        $query = Residentialproperty::find();
        $query->andFilterWhere(['city_id'=>$model->location_id]);
        $query->andFilterWhere(['bathroom'=>$model->bathroom]);
        $query->andFilterWhere(['facing'=>$model->facing]);
        $query->andFilterWhere(['floor_no'=>$model->floor_no]);
        $query->andFilterWhere(['status'=>$model->status]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //echo "<pre>".$dataProvider->getTotalCount(); print_r($dataProvider->getModels());exit;
        return $this->render('get-properties', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Residentialproperty model.
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
     * Creates a new Residentialproperty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Residentialproperty();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Residentialproperty model.
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
     * Deletes an existing Residentialproperty model.
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
     * Finds the Residentialproperty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Residentialproperty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Residentialproperty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetProperties()
    {
        $searchModel = new ResidentialpropertySearch();
        //$searchModel->load($_GET['residentialproperty']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //echo "<pre>"; print_r($dataProvider);
        return $this->render('get-properties', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetAllCities()
    {
        $cities = City::find()->where(['status'=>1])->all();
        return json_encode(ArrayHelper::map($cities,"id","city"));
    }

    public function actionGetCityLocations()
    {
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            $cityid = $_GET['cityid'];
            $locationname = $_GET['locationname'];
            $locations = Location::find()->where(['city_id'=>$cityid,'status'=>1])->andWhere(['like','location',$locationname])->all();
            //return json_encode(ArrayHelper::map($locations,"id","location"));

            //return json_encode(ArrayHelper::toArray($locations,["app\models\Location"=>["id","location"]]));
            $data = [];
            foreach ($locations as $loc) {

                $d['id'] = $loc['id'];
                $d['label'] = trim($loc['location']);
                $d['value'] = trim($loc['location']);
                $data[]=$d;
            }
            return json_encode($data);
        }
        else
            return "";
    }

    public function actionAjaxGetPropertiesUpdate()
    {
        $searchModel = new ResidentialpropertySearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $v = urldecode($_GET);
        // $parts = parse_url($v);
        // parse_str($parts['path'], $query);
        //echo "<pre>"; print_r($_GET);exit;
        //$searchModel->nearby = $_GET['nearby'];
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
        
        return $this->renderPartial('property_item', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'locationname' => implode(",", $locationnames),
            'propby' => $searchModel->property_by,
            'availablefr' => $searchModel->available_for,
        ]);
    }
}
