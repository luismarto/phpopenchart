<section id="dataset-section" class="doc-section">
    <h2 class="section-title">Dataset</h2>
    <div class="section-block">
        <p>The dataset parameter is required and represents the information you want to
            display on the chart. There are two formats for dataset, based on the
            information you want to display</p>
        <div class="callout-block callout-warning">
            <div class="icon-holder">
                <i class="fa fa-exclamation-triangle"></i>
            </div><!--//icon-holder-->
            <div class="content">
                <h4 class="callout-title">Beware</h4>
                <p>Failing to set a <i class="italic">dataset</i> key will result in a
                    <code class="language-php">Phpopenchart\Exception\DatasetNotDefinedException</code>
                    exception.</p>
            </div><!--//content-->
        </div>


        <div id="single-series"  class="section-block">
            <h3 class="block-title">Single serie</h3>
            <p>If you want to display a single serie, you should set the
                <code class="language-php">'dataset'</code> key to an array of
                <code class="language-php">'labels'</code> and
                <code class="language-php">'data'</code>. Each element in
                <code class="language-php">'data'</code> can be either an integer
                (the value) or an array (the value and the color).</p>
            <p>Make sure you use the same number of elements both in <i>labels</i> and <i>data</i>.</p>
            <p>The format for this type of dataset is as follows.</p>
                                        <pre><code class="language-php">'dataset' => [
    'labels' => ['Jan', 'Feb', 'Mar'],
    'data' => [
        3296,
        [1546, '#F88C30'],
        5015,
    ]
]</code></pre>
            <p>The result of such dataset is similar to the example above.</p>
        </div>



        <div id="multiple-series"  class="section-block">
            <h3 class="block-title">Multiple series</h3>
            <p>Whenever you need to display multiple series in the same chart, you need
                to use another format for the <i class="italic">dataset</i>.
                Specifically, you need add a <code class="language-php">'series'</code> key,
                that must be an array with the series names.</p>
            <p>As for the <code class="language-php">'data'</code> key, when using multiple
                series, you need to set it to an array of arrays. </p>
                                        <pre><code class="language-php">'dataset' => [
    'series' => ['First series', 'Second Series'],
    'labels' => ['Jan', 'Feb', 'Mar'],
    'data'   => [
        [
            3296, 154, 5015
        ],
        [
            [564, '#cccccc'], 1564, 3215
        ],
    ]
]</code></pre>
            <p>Similar to the single series data points can either be an integer or an array, with the first
                element as the value and the second as the color.</p>
            <?php (new Phpopenchart\Chart\Column([
                'dataset' => [
                    'series' => ['First series', 'Second Series'],
                    'labels' => ['Jan', 'Feb', 'Mar'],
                    'data'   => [
                        [
                            3296, 154, 5015
                        ],
                        [
                            [564, '#cccccc'], 1564, 3215
                        ],
                    ]
                ]
            ]))->render('images/dataset-multiple-series.png');  ?>

            <p>
                <img src="../images/dataset-multiple-series.png" alt="Dataset multiple series"
                     class="img-responsive center-block" style="max-width: 500px;"/>
            </p>
            <div class="callout-block callout-info">
                <div class="icon-holder">
                    <i class="fa fa-info-circle"></i>
                </div><!--//icon-holder-->
                <div class="content">
                    <h4 class="callout-title">A note on Pie charts</h4>
                    <p>For obvious reasons, Pie charts don't support multiple series. So,
                        when creating a Pie chart, be sure to set a single serie.</p>
                    <p>It's also a good time to tell you that, any negative point value
                        on Pie charts will be treated as 0.</p>
                </div><!--//content-->
            </div>
        </div>
    </div>
</section>