<?php
use yii\widgets\Pjax;

//
var_dump(\Yii::$app->authManager->getAssignments(\Yii::$app->user->getId()));

var_dump(Yii::$app->user);

?>

<?php Pjax::begin() ?>


<?php Pjax::end() ?>