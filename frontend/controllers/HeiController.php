<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\StateForm;
use common\models\Statement;
use common\models\StatementForm;
use common\models\EditprofileForm;
use common\models\State;
use common\models\User;
use common\models\ChangepassForm;
use common\models\UploadForm;
use common\models\Zan;
use common\models\ZanForm;
use common\models\Userinfo;
use common\models\Provinces;
use common\models\Cities;
use common\models\Areas;
use common\models\Lq;
use yii\helpers\Html;
/**
 * Site controller
 */
class HeiController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = false;
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$this->layout = false;
    	$model = new StateForm();
        $modelc = new StatementForm();
    	return $this->render('index', [
            'model' => $model,
            'modelc' => $modelc,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionAjaxcontent(){
        $this->layout = false;
        $model = new StateForm();
        if (\Yii::$app->user->isGuest){
            exit;
        }else{
            if ($model->load(yii::$app->request->post())) {
                if (Yii::$app->request->isAjax) {
                $model -> wcontent();
                }
            }
        }
    }
    public function actionLogin()
    {
    	$this -> layout = false;
        if (!\Yii::$app->user->isGuest) {
            $model = new StateForm();
            $modelc = new StatementForm();
            return $this->render('index',['model' => $model,'modelc' => $modelc]);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionWelcom(){

    	 $this -> layout="hello";
    	 return $this->render('welcom');
    }
    public function actionSignup()
    {
        $this->layout = false;
        $model = new SignupForm();
        // $model->load($_POST);
        // if (Yii::$app->request->isAjax) {
        //    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //    return \yii\bootstrap\ActiveForm::validate($model);
        // }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $model = new StateForm();
                    $modelc = new StatementForm();
                    return $this->render('index', [
                        'model' => $model, 'modelc' => $modelc,
                    ]);
                }
            }
        }else{
            return $this->render('signup', [
            'model' => $model,
             ]);
        }
        
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $model = new StateForm();
        $modelc = new StatementForm();
        return $this->render('index',['model'=>$model, 'modelc'=>$modelc]);
    }

    public function actionAjaxcomment(){
        $this-> layout = false;
        $model = new StateForm();
        $modelc = new StatementForm();
        if ($modelc->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                $modelc -> wcomment();
            }
        }
    }
    public function actionCommentp(){
        $this-> layout = 'heimain';
        $modelc = new StatementForm();
        $modelid = new StateForm();
        if ($modelc->load(Yii::$app->request->post())) {
            $modelc -> wcomment();
        }
    }
    public function actionProfile(){
        $this->layout = 'heimain';
        if (\Yii::$app->user->isGuest) {
            echo "<script>alert('对不起你还没登陆哦');</script>";
            header("refresh:1; url= ?r=hei/login");
            exit;
        }else{
        $modelc = new StatementForm();
        $modelid = new StateForm();
        return $this->render('profile',['modelc' => $modelc, 'modelid' => $modelid]);
        }
    }

    public function actionEditprofile(){
        $this->layout = 'heimain';
        if (!\Yii::$app->user->isGuest) {
            $model = new EditprofileForm();
            $userinfo = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
            $model->gender = $userinfo['gender'];
            $model->provinceid = $userinfo['provinceid'];
            $model->cityid = $userinfo['cityid'];
            $model->areaid = $userinfo['areaid'];
            return $this->render('editprofile',['model' => $model]);
        }else{
            echo "<script>
                  alert('对不起您还没登陆哦');   
                  </script>";
            header("refresh:1; url= ?r=hei/login");
            exit;
        }
        
    }
    public function actionCity(){
        $this->layout=false;
        $model=new EditprofileForm();
        $userinfo = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
        if(!empty($_POST['pid'])){
            $a = $model->getCityList($_POST['pid']);
        }else{
            $a = $model->getCityList($userinfo['provinceid']);
        }
        foreach($a as $cityid=>$city)
        {
            echo Html::tag('option',Html::encode($city),array('value'=>$cityid));
        }
    }

    public function actionArea(){
        $this->layout=false;
        $model = new EditprofileForm();
        $userinfo = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
        if (!empty($_POST['cid'])) {
            $aa = $model->getAreaList($_POST['cid']);
        }else{
            $aa = $model->getAreaList($userinfo['cityid']);
        }
        foreach ($aa as $areaid => $area) {
            echo Html::tag('option',Html::encode($area),array('value'=>$areaid));
        }
    }

    public function actionProfilesave(){
        $this->layout=false;
        $model = new EditprofileForm();
        if ($model->load(Yii::$app->request->post())) {
                $model -> wuserinfo();
        }
    }

    public function actionSetting(){
        $this->layout = 'heimain';
        if (!\Yii::$app->user->isGuest) {
            $model = new ChangepassForm();
            $modelf = new UploadForm();
            return $this->render('setting',['model'=>$model,'modelf'=>$modelf]);
        }else{
            echo "<script>
                  alert('对不起您还没登陆哦');   
                  </script>";
            header("refresh:1; url= ?r=hei/login");
        }
    }

    public function actionChangepass(){
        $this->layout = false;
        $model = new ChangepassForm();
        if ($model->load(Yii::$app->request->post())) {
            $model -> changepass();
        }
    }

    public function actionDelete(){
        $this->layout = false;
        $sid = $_POST['sid'];
        $statede = State::find()->where(['id'=>$sid])->one();
        if ($statede != null) {
            $statede -> delete();
        }else{
             echo "<script>
                  alert('对不起找不到该状态！');   
                  </script>";
        }
    }

    public function actionZan(){
        $this->layout = false;
        $modelz = new ZanForm();
        if (Yii::$app->request->isAjax) {
                $sid = $_POST['sid'];
                $modelz -> zans($sid);
        }
    }

    public function actionLq(){
        $this->layout = false;
        $modell = new Lq();
        if (yii::$app->request->isAjax) {
            $sid = $_POST['sid'];
            $modell -> lq($sid);
        }
    }
    
}
