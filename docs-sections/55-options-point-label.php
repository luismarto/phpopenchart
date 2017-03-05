<div id="options-point-label" class="section-block">
    <h3 class="block-title">Point Label options</h3>
    <div class="col-xs-8">
        <p>The following configuration options can be used on any of the chart types (Column, Bar, Line and Pie).</p>
        <p>Using this configurations you are able to customize the text for each point (ie: bar, line, column or disc)
            of the chart. In order to set different configurations, you should set them inside the array with
            the <code class="language-php">point-label</code> key.</p>
    </div>
    <div class="col-xs-4">
        <img src="assets/images/55-point-label-options.png" alt="PHPOpenChart Point label options" />
    </div>
    <div class="table-responsive clear-both">
        <table class="table table-bordered table-options">
            <thead>
            <tr>
                <th style="min-width: 100px;">Option key</th>
                <th>Description</th>
                <th style="min-width: 150px">Default value</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td class="option-key">show</td>
                <td>Boolean value that indicates if the point label should be displayed.
                    If set to false, all the remaining settings are discarded.</td>
                <td class="option-default-value"><code class="language-php">true</code></td>
                <td class="option-type">bool</td>
            </tr>
            <tr>
                <td class="option-key">font</td>
                <td>Path for the font (odt or ttf) to be used on the point label. <br />
                    You can either set this as the full path of the font file or simply set the font file name,
                    if you want to use one of the SourceSans fonts (that are available on the
                    <i class="italic">fonts</i> directory).</td>
                <td class="option-default-value"><code class="language-php">SourceSansPro-Semibold.otf</code></td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">size</td>
                <td>The size for the point label text.</td>
                <td class="option-default-value"><code class="language-php">10</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">color</td>
                <td>Hexadecimal color used for the point label. You can set any hexadecimal color value</td>
                <td class="option-default-value"><code class="language-php">#333333</code></td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">angle</td>
                <td>The angle for the point text. Set this to an integer value to display the point label rotated.
                This options accepts positive and negative values.</td>
                <td class="option-default-value"><code class="language-php">0</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">generator</td>
                <td>A fully qualified class name responsible for formatting the point value on Column, Bar and Line charts.<br />
                    If you want to display the value in a different format, use one of the
                    <a class="scrollto" href="#label-generators-section">available label generators</a>
                    or create your custom class that implements
                    <code class="language-php">\Phpopenchart\Label\LabelInterface</code>.</td>
                <td class="option-default-value"><code class="language-php">\Phpopenchart\Label\NumberFormatter</code></td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">pie-generator</td>
                <td>A fully qualified class name responsible for formatting the disc point value on Pie charts.<br />
                    If you want to display the value in a different format, use one of the
                    <a class="scrollto" href="#label-generators-section">available label generators</a>
                    or create your custom class that implements
                    <code class="language-php">\Phpopenchart\Label\LabelInterface</code>.</td>
                <td class="option-default-value"><code class="language-php">\Phpopenchart\Label\PercentageFormatter</code></td>
                <td class="option-type">string</td>
            </tr>

            </tbody>
        </table>
    </div>
</div>