<?php
namespace common\models;

use Yii;
use common\models\Handyfunctions;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
        ];
    }



    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {

            $user=$this->getUser();
            if ($this->servervalidation($user))
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
           else
                return false;

        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }





    public function servervalidation($user)
    {


        $data['email']=$user->email;
        $data['pwd']=$user->password_hash;


        /*echo '<br><br><br><br>';
        echo '<br>'.$data['email'];
        echo '<br>'.$data['pwd'];
        echo '<br><br><br><br>';
		*/

        $url='http://gomobileserver.rapportsoftware.co.uk/gomobile/index.php?r=authentication/authentication';

        $response=Handyfunctions::curl_post_data($url,$data );
        //echo $response;
        $full_response_json=json_decode($response);
        $response_json=$full_response_json[0];




        if ($response_json->status=="OK")
        {
            return true;
        }
        else{

            Yii::$app->session->setFlash('error', 'Login Error: '.$response_json->status_message);

        }

    }///end of public function servervalidation()

}
