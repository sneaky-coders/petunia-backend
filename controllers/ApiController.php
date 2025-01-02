<?php

namespace app\controllers;

use Yii;
use app\models\Api;
use app\models\SearchApi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;
use app\models\Properties;
use app\models\ContactUs;
use yii\web\BadRequestHttpException;
use app\models\Category;

/**
 * ApiController implements the CRUD actions for Api model.
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
public function behaviors()
{
    return [
        'corsFilter' => [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['https://www.petuniaestates.com', 'http://localhost:3000'], // Include localhost for development
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
                'Access-Control-Max-Age' => 86400,
            ],
        ],
        'contentNegotiator' => [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ],
    ];
}



    /**
     * Lists all Api models.
     * @return mixed
     */
    
 

    //APIS

    public function actionGetProperties()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Fetching all properties with category details
        $properties = Properties::find()
            ->asArray()
            ->all();

        return [
            'status' => 'success',
            'data' => $properties,
        ];
    }
    
    public function actionGetCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Fetching all properties with category details
        $properties = Category::find()
            ->asArray()
            ->all();

        return [
            'status' => 'success',
            'data' => $properties,
        ];
    }
    
    
    
    public function actionGetLatestProperties()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    // Fetch the latest 3 properties ordered by created_at in descending order
    $latestProperties = Properties::find()
        ->orderBy(['created_at' => SORT_DESC])
        ->limit(3)
        ->asArray()
        ->all();

    return [
        'status' => 'success',
        'data' => $latestProperties,
    ];
}


   public function beforeAction($action)
    {
        if ($action->id === 'contact-us') {
            Yii::$app->controller->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionContactUs()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Handle CORS preflight request (only if necessary)
        if (Yii::$app->request->isOptions) {
            Yii::$app->response->statusCode = 200;
            Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*'); // Update origin as necessary
            Yii::$app->response->headers->set('Access-Control-Allow-Methods', 'POST, OPTIONS');
            Yii::$app->response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            Yii::$app->response->headers->set('Access-Control-Allow-Credentials', 'true');
            return;
        }

        // Handle POST request for contact submission
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            // Create a new model for ContactUs form
            $model = new ContactUs();
            $model->name = $data['name'] ?? null;
            $model->email = $data['email'] ?? null;
            $model->phone = $data['phone'] ?? null;
            $model->subject = $data['subject'] ?? null;
            $model->message = $data['message'] ?? null;
            

            // Validate the model and save data to the database
            if ($model->validate() && $model->save()) {
                return [
                    'status' => 'success',
                    'message' => 'Thank you for contacting us. We will get back to you soon.',
                ];
            }

            // Return errors if validation fails
            return [
                'status' => 'error',
                'message' => 'Invalid data provided.',
                'errors' => $model->errors,
            ];
        }

        // Only POST method is allowed
        throw new BadRequestHttpException('Only POST method is allowed.');
    }

    public function actionSubmitEnquiry()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        if (!$request->isPost) {
            throw new BadRequestHttpException('Only POST requests are allowed.');
        }

        $data = $request->post();

        $model = new PropertyEnquiry();
        $model->property_id = $data['property_id'] ?? null;
        $model->name = $data['name'] ?? null;
        $model->email = $data['email'] ?? null;
        $model->phone = $data['phone'] ?? null;
        $model->message = $data['message'] ?? null;

        if ($model->validate() && $model->save()) {
            return [
                'status' => 'success',
                'message' => 'Your enquiry has been submitted successfully. We will get back to you shortly.',
            ];
        }

        return [
            'status' => 'error',
            'errors' => $model->errors,
        ];
    }



  public function actionFilter()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    $request = Yii::$app->request;

    // Allow both GET and POST methods
    $params = $request->isPost ? $request->post() : $request->get();

    // Create query for Properties model
    $query = Properties::find();

    // Apply filters dynamically based on available parameters
    if (!empty($params['region'])) {
        $query->andWhere(['region' => $params['region']]);
    }

    if (!empty($params['city'])) {
        $query->andWhere(['city' => $params['city']]);
    }

    if (!empty($params['category_id'])) {
        $query->andWhere(['category_id' => $params['category_id']]);
    }

    if (!empty($params['price_min'])) {
        $query->andWhere(['>=', 'price', $params['price_min']]);
    }

    if (!empty($params['price_max'])) {
        $query->andWhere(['<=', 'price', $params['price_max']]);
    }

    // Fetch matching properties
    $properties = $query->asArray()->all();

    return [
        'status' => 'success',
        'data' => $properties,
    ];
}

}
