<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['first_name'], 'trim'],
            [['first_name'], 'string', 'min' => 2, 'max' => 255],

            [['last_name'], 'trim'],
            [['last_name'], 'string', 'min' => 2, 'max' => 255],

            [['role'], 'string']

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role?? 'USER';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        // $user->generateEmailVerificationToken();

        if ($user->save() && $this->sendEmail($user)) {
            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole($user->role), $user->getId());

            return true;
        }

        return false;
    }

    public function populateUserForm(int $id): void
    {
        $user = User::findOne($id);
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role =$user->role;
    }

    public function updateLoadedUser(int $id): bool
    {
        $user = User::findOne($id);
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->id = $id;
        $user->role = $this->role;
        // $auth = \Yii::$app->authManager;
        // $assignedRole = current($auth->getRolesByUser($id));
       

        // revoke previous role if exists.
        // if ($assignedRole instanceof Role && $assignedRole->name !== $this->role) {
        //     $auth->revoke($auth->getRole($assignedRole->name), $user->getId());
        // }
        // $auth->assign($auth->getRole($this->role), $user->getId());
        

        return $user->save();
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
