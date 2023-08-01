<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'role', // Add the 'role' column here
        [
            'class' => 'yii\grid\ActionColumn',
            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],
    ],
]); ?>


</div>
<!-- <!DOCTYPE html>
<html>
<head>
  <title>Profile Picture Upload</title>
  <style>
    /* Styles for the profile picture upload section */
    .profile-pic-upload {
      display: flex;
      align-items: center;
    }
    .profile-pic-upload label {
      cursor: pointer;
    }
    .profile-pic-upload img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }
    .profile-pic-upload input[type="file"] {
      display: none;
    }
    .profile-pic-upload .settings-icon {
      position: absolute;
      right: -10px; /* Adjust the position as needed */
      font-size: 24px;
      color: #333;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="profile-pic-upload">
    <img src="./assets\pictures\Snapchat-1160162712.jpg" alt="Profile Picture Preview">
    <label for="profile-pic-input">Upload Picture</label>
    <input type="file" id="profile-pic-input" name="profile_pic" accept="image/*">
    <i class="bi bi-gear settings-icon"></i>
  </div>
</body>
</html> -->
