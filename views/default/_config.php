<h3>
    Parameters
</h3>

<p>
    <?php
    echo CVarDumper::dumpAsString(Yii::app()->params, 10, true);
    ?></p>

<h3>
    Modules
</h3>

<p>
    <?php
    echo CVarDumper::dumpAsString(Yii::app()->getModules(), 10, true);
    ?></p>

<h3>
    Components
</h3>

<p>
    <?php
    echo CVarDumper::dumpAsString(Yii::app()->getComponents(), 10, true);
    ?></p>

