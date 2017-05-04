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
use yii\data\ArrayDataProvider;
use yii\db\Query;

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
                        'actions' => ['index','indexhome', 'get-properties','get-all-cities','index-new','ajax-get-properties-update','get-city-locations','view','city-list'],
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
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        if(Yii::$app->request->isPost)
        {
            $postdata = Yii::$app->request->post();

            $available_for = $postdata['available_for'];
            $nearby = false;
            if(isset($postdata['nearby']))
                $nearby = $postdata['nearby'];
            $locarray = explode(", ", $postdata['locationnames']);
            $searchModel = new ResidentialpropertySearch();
            if($nearby == 1)
            {
                $searchModel->nearby = true;
            }
            if(count($locarray) > 0)
            {
                $locmodels =Location::find()->select('id')->where(['in', 'location',$locarray])->all();
                $locations =[];
                foreach ($locmodels as $locsmodel) {
                    $locations[]= $locsmodel->id;
                }
                // echo "<pre>"; print_r($locations);exit;
                // $locations = $postdata;
                //$query->andFilterWhere(["in", "location_id", $locations]);
                $searchModel->location_id = $locations;
            }

            
            $searchModel->available_for = $available_for;
            $dataProvider = $searchModel->search(null);

            /*$query = Residentialproperty::find();
            
            
            $query->andFilterWhere(["=", "available_for", $available_for]);*/

            /*$dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);*/
            
            // $searchModel->locationnames = $postdata['locationnames'];
            $searchModel->city_id = $postdata['property_city_id'];

            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => $available_for,
            'city' => $searchModel->city_id,
            'locationname' => $postdata['locationnames'],
            //'location' => $searchModel->locations->name,
        ]);
        }
        else
        {
            if(isset($_GET['home']) && $_GET['home']==1)
            {
                $available_for = $_GET['ResidentialpropertySearch']['available_for'];
                $city_id = $_GET['ResidentialpropertySearch']['city_id'];
                $locationname = $_GET['ResidentialpropertySearch']['locationname'];
                $bhk = $_GET['ResidentialpropertySearch']['bhk'];
                $min_rate_price = $_GET['ResidentialpropertySearch']['min_rate_price'];
                $searchModel = new ResidentialpropertySearch();
                $searchModel->available_for = $available_for;
                $searchModel->location_id = $locationname;
                $searchModel->city_id = $city_id;
                $searchModel->bhk = $bhk;

                $searchModel->min_rate_price = $min_rate_price;

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


                $dataProvider = $searchModel->search(null);
            }
            else
            {

                $searchModel = new ResidentialpropertySearch();
                
                if(isset($_GET['city']) && $_GET['city'] != "")
                    $searchModel->city_id = $_GET['city'];
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            }
            //echo "<pre>"; print_r($searchModel);exit;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => "Sale and Rent",
            'city' => $searchModel->city_id,
            'locationname' => "",
            //'location' => $searchModel->locations->name,
        ]);
    }

    public function actionIndexhome()
    {
        $searchModel = new ResidentialpropertySearch();
        $searchModel->load(Yii::$app->request->queryParams);
        // echo "<pre>"; print_r($searchModel);exit;
        //if($searchModel->bhk != "")
        //$searchModel->available_for = null;
        //$searchModel->bhk = [$searchModel->bhk];
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
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => "Sale and Rent",
            'city' => $searchModel->city_id,
            'locationname' => $searchModel->locationname,
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
        return $this->render('view_newlayout', [
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
        // echo "<pre>"; print_r($_GET);exit;
        $searchModel = new ResidentialpropertySearch();
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
            foreach ($dataProvider->getModels() as $modl) {
                $propamenityids = \app\models\ResidentialpropertyAmenities::find()->where(['property_id' => $modl->id])->all();
                $ids=[];
                if($propamenityids)
                {
                    foreach ($propamenityids as $val) {
                        if(in_array($val->amenity_id,$amenitiesarr)===true);
                        {
                            $newarr[]=$modl;
                            break;
                        }

                    }
                }
            }
            
            $provider = new ArrayDataProvider([
                'allModels' => $newarr,
                'pagination' => false,
            ]);
            if(!$searchModel->available_for)
                $available_for="Buy and Rent";
            else
                $available_for = $searchModel->available_for;
            return $this->renderPartial('property_item', [
                'searchModel' => $searchModel,
                'dataProvider' => $provider,
                'locationname' => implode(",", $locationnames),
                'propby' => $searchModel->property_by,
                'availablefr' => $available_for,
            ]);
        }
        else
        {
            if(!$searchModel->available_for)
                $available_for="Sale, Rent and Flatmate";
            else
                $available_for = $searchModel->available_for;
            return $this->renderPartial('property_item', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'locationname' => implode(",", $locationnames),
                'propby' => $searchModel->property_by,
                'availablefr' => $available_for,
            ]);
        }
    }

    public function actionCityList($q = null, $id = null) {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new Query;
        $query->select('id, location AS text')
            ->from('tbl_location')
            ->where(['like', 'location', $q])
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => Location::find($id)->location];
    }
    return $out;
}
}
