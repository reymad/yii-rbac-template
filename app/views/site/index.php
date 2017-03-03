<?php

use app\components\Helpers;
use kartik\icons\Icon;
use kartik\social\TwitterPlugin;
use russ666\widgets\Countdown;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>
            <?php
                // tarta
                // echo Icon::show('birthday-cake', ['class'=>'fa-6 text-sunset'] );
            ?>
        </h1>
        <p class="lead">Hola Nen!</p>
        <?php
            // danis bd // date('2017-09-08 00:00:01 O'),

            echo Countdown::widget([
                'datetime' => date('2017-03-03 15:24:01'),
                'format' => '%-m months %-W weeks %-d days %-H h %M min %S sec',
                'events' => [
                    // 'finish' => 'function(){location.reload()}',
                ],
            ]);
        ?>

        <?php
            /*
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
            */
         ?>

         <!-- my widget @https://twitter.com/settings/widgets/836954715543990274/edit
         <a class="twitter-timeline"  href="https://twitter.com/hashtag/interesante" data-widget-id="836954715543990274">#interesante Tweets</a>
         <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
         -->
         <?php
            /*
            }// fin if twitter
            */
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
