<h2 class="section-title">Options</h2>
<div class="section-block">
    <p>All the options are defined in <code>config/config.php</code> file. You can change the settings through the
        file but <i>passing the settings when creating the chart is the preferred way</i>, because you shouldn't
        ever change the package's config.php, as they may be overridden when you update the dependency.</p>
    <p>The options are divided by main components and are as follows</p>

    <?php require_once('51-options-chart.php') ?>

    <?php require_once('52-options-title.php') ?>

    <?php require_once('53-options-label-axis.php') ?>

    <?php require_once('54-options-value-axis.php') ?>

    <?php require_once('55-options-point-label.php') ?>

    <?php require_once('56-options-caption-label.php') ?>

</div>