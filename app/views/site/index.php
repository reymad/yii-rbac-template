<?php

use app\components\Helpers;
use kartik\social\TwitterPlugin;

/* @var $this yii\web\View */

echo 'branch module';

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Helpers::test(); ?></h1>

        <p class="lead">Hola Nen!</p>


        <?php

        if(isset(Yii::$app->user->identity->accounts['twitter'])){
            $data = Yii::$app->user->identity->accounts['twitter']->decodedData;
            $screen_name = $data['screen_name'];
            // $id = $data['id_str'];

            // var_dump($data);exit;

            echo TwitterPlugin::widget([
                'type' => TwitterPlugin::TIMELINE,
                'screenName' => $screen_name,
                'timelineConfig' => ['search' => '#chronoscan'],
                'settings' => ['widget-id' =>  '836954715543990274'],
                // 'options' => ['height'=>'350', 'width'=>'500']
                // 'content' => 'tweets content'
            ]);

            ?>

            <!-- otra manera de mostrar los widgets
            <a class="twitter-timeline"
               href="https://twitter.com/<?=$screen_name?>">
                Tweets by @<?=$screen_name?>
            </a>
            -->

            <!-- my widget @https://twitter.com/settings/widgets/836954715543990274/edit
            <a class="twitter-timeline"  href="https://twitter.com/hashtag/interesante" data-widget-id="836954715543990274">#interesante Tweets</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            -->
            <?php

        }// fin if twitter

        ?>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
</div>
