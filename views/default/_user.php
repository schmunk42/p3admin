<h3>Information</h3>
<div class="row">
    <div class="span4">
        <h4>Name</h4>

        <p><?php echo Yii::app()->user->name ?></p>
    </div>
    <div class="span4">
        <h4>Id</h4>

        <p><?php echo Yii::app()->user->id ?></p>
    </div>
</div>

<h3>Assignments</h3>
<div class="row">
    <div class="span4">
        <h4>Roles</h4>

        <p>
            <?php foreach (Yii::app()->authManager->getAuthItems(2, Yii::app()->user->id) AS $key => $value) {
                echo $key . ", ";
            } ?>
        </p>
    </div>
    <div class="span4">
        <h4>Operations</h4>

        <p><?php
            foreach (Yii::app()->authManager->getAuthItems(1, Yii::app()->user->id) AS $key => $value) {
                echo $key . ", ";
            }
            ?></p>
    </div>
    <div class="span4">
        <h4>Tasks</h4>

        <p><?php
            foreach (Yii::app()->authManager->getAuthItems(0, Yii::app()->user->id) AS $key => $value) {
                echo $key . ", ";
            }
            ?></p>
    </div>
</div>
