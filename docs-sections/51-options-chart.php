<div id="options-chart" class="section-block">
    <h3 class="block-title">Chart options</h3>
    <div class="col-xs-8">
        <p>These are global options for the chart. All of this options are nested within the parent
            <code class="language-php">chart</code> key on the configuration file.</p>
    </div>
    <div class="col-xs-4">
        <img src="assets/images/51-chart-options.png" alt="PHPOpenChart Chart options" />
    </div>

    <div class="table-responsive clear-both">
        <table class="table table-bordered table-options">
            <thead>
            <tr>
                <th style="min-width: 150px;">Option key</th>
                <th>Description</th>
                <th style="min-width: 150px">Default value</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="option-key">width</td>
                <td>Sets the width for the output area</td>
                <td class="option-default-value"><code class="language-php">600</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">height</td>
                <td>Sets the height for the output area</td>
                <td class="option-default-value"><code class="language-php">300</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">logo</td>
                <td>
                    Defines the file path for the logo if you intend to use one. Otherwise, leave it as false.<br />
                    If you specify a path that's not valid, the logo won't be rendered.
                </td>
                <td class="option-default-value"><code class="language-php">false</code></td>
                <td class="option-type">string|bool</td>
            </tr>
            <tr>
                <td class="option-key">use-multiple-color</td>
                <td>Allows the points of a single series to have different colors</td>
                <td class="option-default-value"><code class="language-php">false</code></td>
                <td class="option-type">bool</td>
            </tr>
            <tr>
                <td class="option-key">sort-data-point</td>
                <td>Allows you to display the columns / bars / discs / dots in an ordered fashion. By default (0) they are displayed
                    as you've added them on the <i>dataset</i>. If you want the information to be displayed in an ascending order, set
                    this value to 1. If you want a descending order, set this to -1.</td>
                <td class="option-default-value"><code class="language-php">0</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">bar-padding</td>
                <td rowspan="4" style="vertical-align: middle">Array with four positions at most, with integer values, that represent
                    the top-padding, right-padding, bottom-padding and left-padding used for the chart.<br />
                    Use the key that matches the chart type you're creating.<br />
                    If you pass an array with less than four values, the remaining paddings will be 0.</td>
                <td class="option-default-value"><code class="language-php">[5, 30, 30, 50]</code></td>
                <td class="option-type">array</td>
            </tr>
            <tr>
                <td class="option-key">column-padding</td>
                <td class="option-default-value"><code class="language-php">[5, 30, 50, 50]</code></td>
                <td class="option-type">array</td>
            </tr>
            <tr>
                <td class="option-key">line-padding</td>
                <td class="option-default-value"><code class="language-php">[5, 30, 50, 50]</code></td>
                <td class="option-type">array</td>
            </tr>
            <tr>
                <td class="option-key">pie-padding</td>
                <td class="option-default-value"><code class="language-php">[15, 10, 30, 30]</code></td>
                <td class="option-type">array</td>
            </tr>
            <tr>
                <td class="option-key">ratio</td>
                <td>When you print a pie chart or a chart with multiple series a caption is added. If the
                    caption labels are too long they will be truncated.<br />
                    You can use this multiplier to specify the width for the chart and for the caption.
                    A value of 0.7 means the chart will have 70% of the available width and the caption will
                    have 30%. When using larger labels on the caption, you might want to reduce this value.<br />
                    This value needs to be between 0 and 1, otherwise a
                    <code class="language-php">ChartRatioOutOfBoundariesException</code> will be throwed.</td>
                <td class="option-default-value"><code class="language-php">0.7</code></td>
                <td class="option-type">float</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>