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
        if(Yii::$app->request->isPost)
        {
            $postdata = Yii::$app->request->post();
            $available_for = $postdata['available_for'];
            $nearby = false;
            if(isset($postdata['nearby']))
                $nearby = $postdata['nearby'];
            //$locarray = explode(", ", $postdata['locationnames']);
            $locarray = $postdata['locationnames'];
            $searchModel = new AgriculturalpropertySearch();
            if($nearby == 1)
            {
                $searchModel->nearby = true;
            }
            if(count($locarray) > 0)
            {
                /*$locmodels =Location::find()->select('id')->where(['in', 'location',$locarray])->all();
                $locations =[];
                foreach ($locmodels as $locsmodel) {
                    $locations[]= $locsmodel->id;
                }
                $searchModel->location_id = $locations;*/
                $searchModel->location_id = $locarray;
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
                // 'locationname' => $postdata['locationnames'],
                'locationname' => "",
                //'location' => $searchModel->locations->name,
            ]);

        }
        else
        {
            if(isset($_GET['home']) && $_GET['home']==1)
            {
                // echo "<pre>"; print_r($_GET);exit;
                $searchModel = new AgriculturalpropertySearch();

                if(isset($_GET['AgriculturalpropertySearch']['available_for']) && $_GET['AgriculturalpropertySearch']['available_for'] != "")
                {
                    $searchModel->available_for = $_GET['AgriculturalpropertySearch']['available_for'];
                    $available_for = $searchModel->available_for;
                }
                else
                {
                    $available_for = "Sale and Rent";
                }

                if(isset($_GET['AgriculturalpropertySearch']['locationname']) && $_GET['AgriculturalpropertySearch']['locationname'] != "")
                    $searchModel->location_id = $_GET['AgriculturalpropertySearch']['locationname'];

                if(isset($_GET['AgriculturalpropertySearch']['city_id']) && $_GET['AgriculturalpropertySearch']['city_id'] != "")
                    $searchModel->city_id = $_GET['AgriculturalpropertySearch']['city_id'];

                if(isset($_GET['AgriculturalpropertySearch']['property_type']) && $_GET['AgriculturalpropertySearch']['property_type'] != "")
                    $searchModel->property_type = $_GET['AgriculturalpropertySearch']['property_type'];

                if(isset($_GET['AgriculturalpropertySearch']['min_rate_price']) && $_GET['AgriculturalpropertySearch']['min_rate_price'] != "")              
                {
                    $searchModel->min_rate_price = $_GET['AgriculturalpropertySearch']['min_rate_price'];
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
                $searchModel = new AgriculturalpropertySearch();
                if(isset($_GET['city']) && $_GET['city'] != "")
                    $searchModel->city_id = $_GET['city'];
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                if($searchModel->available_for != "")
                    $available_for = "Sale and Rent";
                else
                    $available_for = $searchModel->available_for;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availablefr' => $available_for,
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
        return $this->render('view_newlayout', [
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
