<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use modules\users\Module;

/* @var $this yii\web\View */
/* @var $searchModel modules\users\models\backend\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('backend', 'TITLE_USERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-backend-default-index">
    <div class="box">
        <?php Pjax::begin(['enablePushState' => false]); ?>
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="pull-right">
                <p>
                    <?= Html::a('<span class="fa fa-plus"></span> ', ['create'], [
                        'class' => 'btn btn-block btn-success',
                        'data' => [
                            'toggle' => 'tooltip',
                            'original-title' => Module::t('backend', 'BUTTON_CREATE'),
                            'pjax' => 0,
                        ],
                    ]) ?>
                </p>
            </div>
            <?= GridView::widget([
                'id' => 'grid-users',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}", // {summary}\n{items}\n{pager}
                'tableOptions' => [
                    'class' => 'table table-bordered table-hover',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'username',
                        'filter' => Html::activeInput('text', $searchModel, 'username', [
                            'class' => 'form-control',
                            'placeholder' => Module::t('backend', 'SELECT_TEXT')
                        ]),
                        'label' => Module::t('backend', 'TITLE_USERS'),
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'email',
                        'filter' => Html::activeInput('text', $searchModel, 'email', [
                            'class' => 'form-control',
                            'placeholder' => Module::t('backend', 'SELECT_TEXT')
                        ]),
                        'format' => 'email'
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'status',
                            'data' => $searchModel->statusesArray,
                            'language' => mb_substr(Yii::$app->language, 0, strrpos(Yii::$app->language, '-')),
                            'theme' => Select2::THEME_DEFAULT,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => Module::t('backend', 'SELECT_ALL')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]),
                        'format' => 'raw',
                        'value' => function ($data) {
                            return $data->statusLabelName;
                        },
                        'contentOptions' => [
                            'class' => 'title-column',
                            'style' => 'width:150px',
                        ],
                    ],
                    [
                        'attribute' => 'userRoleName',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'userRoleName',
                            'data' => $searchModel->rolesArray,
                            'language' => mb_substr(Yii::$app->language, 0, strrpos(Yii::$app->language, '-')),
                            'theme' => Select2::THEME_DEFAULT,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => Module::t('backend', 'SELECT_ALL')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]),
                        'format' => 'raw',
                        'value' => function ($data) {
                            return $data->userRoleName;
                        },
                        'contentOptions' => [
                            'style' => 'width:200px',
                        ],
                    ],
                    [
                        'attribute' => 'last_visit',
                        'format' => 'datetime',
                        'filter' => DatePicker::widget([
                            'language' => mb_substr(Yii::$app->language, 0, strrpos(Yii::$app->language, '-')),
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'options' => ['placeholder' => Module::t('backend', 'SELECT_START_DATE')],
                            'options2' => ['placeholder' => Module::t('backend', 'SELECT_END_DATE')],
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'autoclose' => true,
                            ]
                        ])
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => [
                            'class' => 'action-column'
                        ],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['view', 'id' => $model->id]), [
                                    'data' => [
                                        'toggle' => 'tooltip',
                                        'original-title' => Module::t('backend', 'BUTTON_VIEW'),
                                        'pjax' => 0,
                                    ]
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['update', 'id' => $model->id]), [
                                    'data' => [
                                        'toggle' => 'tooltip',
                                        'original-title' => Module::t('backend', 'BUTTON_UPDATE'),
                                        'pjax' => 0,
                                    ]
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['delete', 'id' => $model->id]), [
                                    'data' => [
                                        'toggle' => 'tooltip',
                                        'original-title' => Module::t('backend', 'BUTTON_DELETE'),
                                        'method' => 'post',
                                        'confirm' => Module::t('backend', 'CONFIRM_DELETE'),
                                    ]
                                ]);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>
        <div class="box-footer">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'registerLinkTags' => true,
                'options' => [
                    'class' => 'pagination pagination-sm no-margin pull-right',
                ]
            ]) ?>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>