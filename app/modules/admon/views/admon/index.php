<?php
use yii\widgets\Pjax;

//
var_dump(\Yii::$app->authManager->getAssignments(\Yii::$app->user->getId()));



?>

<?php Pjax::begin() ?>


<?php Pjax::end() ?>