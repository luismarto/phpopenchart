<section id="create-chart-section" class="doc-section">
    <h2 class="section-title">Create chart</h2>
    <div class="section-block">
        <p>To create a chart you need to use one of the following classes, based on the
            chart you want to produce. The class names are fairly expressive.</p>
        <pre><code class="language-php">&lt;?php
use Phpopenchart\Chart\Column;
use Phpopenchart\Chart\Bar;
use Phpopenchart\Chart\Line;
use Phpopenchart\Chart\Pie;</code></pre>
        <p>Then, you just need to create the chart with your options and render it, as such,
            which produces a chart like the image below</p>
        <pre><code class="language-php">&lt;?php
use Phpopenchart\Chart\Column;

$chart = new Column([
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'data'   => [3296, 1546, 5015]
    ]
]);
$chart->render();</code></pre>
        <p>
            <?php
            (new Phpopenchart\Chart\Column([
                'dataset' => [
                    'labels' => ['Jan', 'Feb', 'Mar'],
                    'data'   => [3296, 1546, 5015]
                ]
            ]))->render('assets/images/generated/sample-column-chart.png'); ?>
            <img src="assets/images/generated/sample-column-chart.png" alt="Sample demo"
                 class="img-responsive center-block" />
        </p>
    </div>
</section><!--//doc-section-->