<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users Manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'username',
            //'auth_key',
            //'email:email',
            // 'password',
            // 'password_hash',
            // 'password_reset_token',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'Y-M-d']
            ],
            // 'created_at',
            // 'updated_at',
            'role',
            'status',
            'auth_user.type',
            // 'avatar',
            'login_count',
            // 'access_token',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['user/view', 'id' => $model->user_id, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    }

                ],
            ],
            //['class' => 'yii\grid\ActionColumn'],
            //[ 'class' => 'yii\grid\CheckboxColumn',],
        ],
        'responsive' => true,//是否是响应式
        'hover' => true,//悬停高亮
        'condensed' => true,//whether the grid table will have a `condensed` style.
        'striped' => false,//whether the grid table will have a `striped` style.
        'floatHeader' => true,//是否悬停头部
        'floatHeaderOptions' => ['scrollingTop' => 1],
        'bordered' => false,//是否显示图表表框
        'pjax' => true,//是否开启PJAX
        'showPageSummary' => false,//是否显示概况
        'toolbar' => [
//            [
//                'content'=>
//                    Html::button('<i class="glyphicon glyphicon-plus"></i>', [
//                        'type'=>'button',
//                        'title'=>Yii::t('kvgrid', 'Add Book'),
//                        'class'=>'btn btn-success'
//                    ]) . ' '.
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
//                        'class' => 'btn btn-default',
//                        'title' => Yii::t('kvgrid', 'Reset Grid')
//                    ]),
//            ],
            '{export}',
           // '{toggleData}'
        ],

       // 'toggleDataContainer' => ['class' => 'btn-group-sm'],
       // 'exportContainer' => ['class' => 'btn-group-sm'],

        'panel' => [
            'heading' => '<h4 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h4>',
            'type' => 'info',
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
//            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']). '&nbsp; ' ,
//            Html::a( '<i class="glyphicon glyphicon-remove"></i> Delete', ['delete'],['class'=>'btn btn-danger'] ) ,
//
//            'showFooter' => false,
        ],
        'panelBeforeTemplate' => '',
        'panelHeadingTemplate' =>"
            <div class=\"pull-right\">
                {toolbar}
            </div>
            <h3 class=\"panel-title\">
                {summary}
            </h3>
            <div class=\"clearfix\"></div>",

        'export' => [
            'fontAwesome' => true
        ],

        'exportConfig' => [
            GridView::HTML => [
                'label' => Yii::t('kvgrid', 'HTML'),
                'icon' =>  'file-text' ,// 'floppy-saved',
                'iconOptions' => ['class' => 'text-info'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The HTML export file will be generated for download.'),
              //  'options' => ['title' => Yii::t('kvgrid', 'Hyper Text Markup Language')],
                'mime' => 'text/html',
                'config' => [
                    'cssFile' => 'http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'
                ]
            ],
            GridView::CSV => [
                'label' => Yii::t('kvgrid', 'CSV'),
                'icon' =>  'file-code-o' ,// 'floppy-open',
                'iconOptions' => ['class' => 'text-primary'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The CSV export file will be generated for download.'),
               // 'options' => ['title' => Yii::t('kvgrid', 'Comma Separated Values')],
                'mime' => 'application/csv',
                'config' => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ]
            ],
            GridView::TEXT => [
                'label' => Yii::t('kvgrid', 'Text'),
                'icon' =>  'file-text-o' ,//'floppy-save',
                'iconOptions' => ['class' => 'text-muted'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The TEXT export file will be generated for download.'),
               // 'options' => ['title' => Yii::t('kvgrid', 'Tab Delimited Text')],
                'mime' => 'text/plain',
                'config' => [
                    'colDelimiter' => "\t",
                    'rowDelimiter' => "\r\n",
                ]
            ],
            GridView::EXCEL => [
                'label' => Yii::t('kvgrid', 'Excel'),
                'icon' =>  'file-excel-o',// 'floppy-remove',
                'iconOptions' => ['class' => 'text-success'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The EXCEL export file will be generated for download.'),
               // 'options' => ['title' => Yii::t('kvgrid', 'Microsoft Excel 95+')],
                'mime' => 'application/vnd.ms-excel',
                'config' => [
                    'worksheet' => Yii::t('kvgrid', 'ExportWorksheet'),
                    'cssFile' => ''
                ]
            ],
            GridView::PDF => [
                'label' => Yii::t('kvgrid', 'PDF'),
                'icon' => 'file-pdf-o',// 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
                //'options' => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                    'methods' => [
                        'SetHeader' => [
                           // ['odd' => $pdfHeader, 'even' => $pdfHeader]
                        ],
                        'SetFooter' => [
                          //  ['odd' => $pdfFooter, 'even' => $pdfFooter]
                        ],
                    ],
                    'options' => [
                       // 'title' => $title,
                        'subject' => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                        'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                    ],
                    'contentBefore'=>'',
                    'contentAfter'=>''
                ]
            ],
            GridView::JSON => [
                'label' => Yii::t('kvgrid', 'JSON'),
                'icon' => 'file-code-o' ,// 'floppy-open',
                'iconOptions' => ['class' => 'text-warning'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'grid-export'),
                'alertMsg' => Yii::t('kvgrid', 'The JSON export file will be generated for download.'),
               // 'options' => ['title' => Yii::t('kvgrid', 'JavaScript Object Notation')],
                'mime' => 'application/json',
                'config' => [
                    'colHeads' => [],
                    'slugColHeads' => false,
                    'jsonReplacer' => null,
                    'indentSpace' => 4
                ]
            ],
        ],


    ]); ?>
    <?php Pjax::end(); ?>

    <p>
        <?php //Html::a(Yii::t('user', 'Create {modelClass}', ['modelClass' => 'User',]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
