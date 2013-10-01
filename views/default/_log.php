<?php

// taken from https://github.com/Sammaye/audittrail/blob/master/README.md

Yii::import('vendor.sammaye.auditrail2.models.AuditTrail');

$criteria = new CDbCriteria(array(
                                 'order' => 'stamp DESC',
                                 'with'  => array('user'),
                            ));

$this->widget(
    'zii.widgets.grid.CGridView',
    array(
         'id'           => 'title-grid',
         'template'     => '{summary}{pager}{items}{pager}',
         'dataProvider' => new CActiveDataProvider(
             'AuditTrail', array(
                                'criteria'   => $criteria,
                                'pagination' => array(
                                    'pageSize' => 50,
                                )
                           )),
         'columns'      => array(
             array(
                 'name'  => 'Author',
                 'value' => '$data->user ? $data->user->username : ""'
             ),
             'action',
             array(
                 'name' => 'field',
                 //'value' => '$data->getParent()->getAttributeLabel($data->field)'
             ),
             'old_value',
             'new_value',
             'model',
             'model_id',
             array(
                 'name'  => 'Date Changed',
                 'value' => 'date("d-m-Y H:i:s", strtotime($data->stamp))'
             )
         ),
    )
);