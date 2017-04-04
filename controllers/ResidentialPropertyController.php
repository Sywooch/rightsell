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
                        'actions' => ['index', 'get-properties','get-all-cities','index-new','get-city-locations','ajax-get-properties'],
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
        $params = Yii::$app->request->queryParams;
        $searchModel->load($params);
        if(!isset($params['city']))
            //$searchModel->city_id = $params['city'];
            $params['city']="";
        //echo "<pre>"; print_r($searchModel);exit; //`property_by` LIKE 'owner' AND
        $query = Residentialproperty::find();

        // $query->andFilterWhere(['property_by'=>$searchModel->property_by]);
        // $query->andFilterWhere(['location_id'=>$searchModel->location_id]);
        // $query->andFilterWhere(['city_id'=>$searchModel->city_id]);
        // $query->andFilterWhere(['bathroom'=>$searchModel->bathroom]);
        // $query->andFilterWhere(['facing'=>$searchModel->facing]);
        // $query->andFilterWhere(['floor_no'=>$searchModel->floor_no]);
        // $query->andFilterWhere(['status'=>$searchModel->status]);
        // $query->andFilterWhere(['available_for'=>$searchModel->available_for]);
        // $query->andFilterWhere(['furnished'=>$searchModel->furnished]);
        // $query->andFilterWhere(['bhk'=>$searchModel->bhk]);
        //$query->andFilterWhere(['status'=>$model->min_price]);
        $query->andFilterWhere(['city_id'=>$params['city']]);
        $query->andFilterWhere(['status'=>1]);

        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //echo "<pre>".$dataProvider->getTotalCount(); print_r($dataProvider->getModels());exit;
        //echo "<pre>"; print_r(Yii::$app->request->queryParams);exit;
        return $this->render('get-properties', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexNew()
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
    }

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

    public function actionAjaxGetProperties()
    {
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            $params = $_POST['data'];
            $locationnames = [];
            if(isset($params['location_id']))
            {
                $locas = Location::find()->where(['in','id', $params['location_id']])->all();
                $locationnamestemp = ArrayHelper::toArray($locas,['app\models\Location' =>['location']]);
                foreach ($locationnamestemp as $location) {
                    $locationnames[] = $location['location'];
                }
            }
            else
            {
                $params['location_id'] = [];
            }
            if(!isset($params['furnished']))
                $params['furnished']= [];
            
            if(!isset($params['bhk']))
                $params['bhk']= [];

            if(!isset($params['property_type']))
                $params['property_type']= [];

            if(!isset($params['available_for']))
                $params['available_for']= "";

            if(!isset($params['property_by']))
                $params['property_by']= "";

            if(!isset($params['minrent']) && $params['minrent'] == "")
                $params['minrent'] = null;
            else
                $params['minrent'] = $params['minrent'] * 1000;

            if(!isset($params['maxrent']) && $params['maxrent'] == "")
                $params['maxrent'] = null;
            else
                $params['maxrent'] = $params['maxrent'] * 1000;


            if(!isset($params['minrate']))
                $params['minrate'] =  null;
            else
                $params['minrate'] = $params['minrate'] * 100000;

            
            if(!isset($params['maxrate']))
                $params['maxrate'] =  null;
            else
                $params['maxrate'] = $params['maxrate'] * 100000;

            //echo "<pre>";print_r($params);exit;

            $query = Residentialproperty::find();
            $query->andFilterWhere(['property_by'=>$params['property_by']]);
            $query->andFilterWhere(['in','location_id',$params['location_id']]);
            $query->andFilterWhere(['in','furnished',$params['furnished']]);
            
            $query->andFilterWhere(['in','bhk',$params['bhk']]);
            $query->andFilterWhere(['in','property_type',$params['property_type']]);
            
            $query->andFilterWhere(['city_id'=>$params['city_id']]);
            $query->andFilterWhere(['bathroom'=>$params['bathroom']]);
            $query->andFilterWhere(['facing'=>$params['facing']]);
            $query->andFilterWhere(['floor_no'=>$params['floor_no']]);
            $query->andFilterWhere(['available_for'=>$params['available_for']]);

            if(isset($params['maxrate']) && $params['maxrate'] != "")
            {
                $query->andFilterWhere(['between', 'expected_rate_comp',$params['minrate'],$params['maxrate']]);
                //$query->andFilterWhere(['>', 'expected_rate_comp',$params['minrate']]);
                //$query->andFilterWhere(['<', 'expected_rate_comp',$params['maxrate']]);
            }

            if(isset($params['maxrent']) && $params['maxrent'] != "")
            {   
                $query->andFilterWhere(['between', 'expected_rent_comp',$params['minrent'],$params['maxrent']]);
                //$query->andFilterWhere(['between', 'expected_rent_comp',$params['minrent']]);
                //$query->andFilterWhere(['<', 'expected_rent_comp',$params['maxrent']]);
            }
            

            $query->andFilterWhere(['status'=>1]);
            $query->andFilterWhere(['publish_on_web'=>1]);
            //$query->andFilterWhere(['status'=>$searchModel->status]);
            //$query->andFilterWhere(['furnished'=>$searchModel->furnished]);
            //$query->andFilterWhere(['bhk'=>$searchModel->bhk]);
            //$query->andFilterWhere(['status'=>$model->min_price]);
            //$query->andFilterWhere(['status'=>$model->status]);

            // //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            //echo "<pre>";print_r($query);exit;
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            echo $this->renderPartial('property_item', [
                'dataProvider' => $dataProvider,
                'locationname' => implode(",", $locationnames),
                'propby' => $params['property_by'],
                //'cityname' => $cityname,
            ]);
        }
        else
            return "";
    }
}
