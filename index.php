<?php require_once 'common.php'; ?>
<?php require_once 'layout/header.php'; ?>


<?php require_once('docs-sections/header.php') ?>

<div class="container">
    <div id="doc-header" class="doc-header text-center">
        <h1 class="doc-title"><i class="icon fa fa-file-text-o"></i> Documentation</h1>
        <div class="meta"><i class="fa fa-clock-o"></i> Last updated: Mar 05th, 2017</div>
    </div><!--//doc-header-->
    <div class="doc-body">
        <div class="doc-content">
            <div class="content-inner">
                <?php require_once('docs-sections/1-how-dows-this-work.php') ?>

                <?php require_once('docs-sections/2-installation.php') ?>

                <?php require_once('docs-sections/3-create-chart.php') ?>


                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Phpopenchart - docs -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5079617207217056"
                     data-ad-slot="5668434329"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>


                <?php require_once('docs-sections/4-dataset.php') ?>


                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Phpopenchart - docs -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5079617207217056"
                     data-ad-slot="5668434329"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>





                <section id="options-section" class="doc-section">
                    <?php require_once('docs-sections/5-options.php') ?>
                </section><!--//doc-section-->



                <section id="label-generators-section" class="doc-section">
                    <?php require_once('docs-sections/6-label-generators.php') ?>

                    <?php require_once('docs-sections/61-custom-label-generator.php') ?>

                </section><!--//doc-section-->



                <section id="methods-section" class="doc-section">
                    <?php require_once('docs-sections/7-methods.php') ?>
                </section><!--//doc-section-->

                <section id="exceptions-section" class="doc-section">
                    <?php require_once('docs-sections/8-exceptions.php') ?>
                </section><!--//doc-section-->

            </div><!--//content-inner-->
        </div><!--//doc-content-->

        <?php require_once('docs-sections/xx-menu.php') ?>

    </div><!--//doc-body-->
</div><!--//container-->

<?php require_once 'layout/footer.php'; ?>