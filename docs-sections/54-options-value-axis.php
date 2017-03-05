<div id="options-value-axis"  class="section-block">
    <h3 class="block-title">Value axis options</h3>
    <div class="col-xs-8">
        <p>These options are only applicable to Column, Bar and Line charts, because Pie charts don't have "axis".</p>
        <p>The options are used on the axis the value is displayed, not the text. So, it will be the Y axis on
            Column and Line charts and the X axis on Bar charts.</p>
        <p>All the options are nested within the parent <code class="language-php">value-axis</code> key on the configuration file.</p>
    </div>
    <div class="col-xs-4">
        <img src="../assets/images/54-value-axis-options.png" alt="PHPOpenChart Value axis options" />
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
                <td class="option-key">font</td>
                <td>Path for the font (odt or ttf) to be used on the value axis text.
                    <br />You can either set this as the full path of the font
                    file or simply set the font file name if you want to use
                    one of the SourceSans fonts (that are available on the
                    <i class="italic">fonts</i> directory).</td>
                <td class="option-default-value">
                    <code class="language-php">SourceSansPro-Regular.otf</code>
                </td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">size</td>
                <td>Determines the font size for the value text</td>
                <td class="option-default-value">
                    <code class="language-php">10</code>
                </td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">color</td>
                <td>Hexadecimal color for the value axis (with #)</td>
                <td class="option-default-value">
                    <code class="language-php">#666666</code>
                </td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">angle</td>
                <td>The angle for the text rotation. Set this to the
                    number of degrees you want to rotate the text. Accepts both
                    positive and negative values.</td>
                <td class="option-default-value">
                    <code class="language-php">0</code>
                </td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">margin</td>
                <td>Array with <code class="language-php">'top'</code> and
                    <code class="language-php">'left'</code> key. Both keys
                    should be set to an integer value that represents the top
                    and left padding.</td>
                <td class="option-default-value">
<pre><code class="language-php">[
    'top' => 15,
    'left' => 0
]</code></pre>
                </td>
                <td class="option-type">array</td>
            </tr>
            <tr>
                <td class="option-key">generator</td>
                <td>A full qualified class name responsible for formatting the value axis.<br />
                    If you want to display the value in a different format, use one of the
                    <a class="scrollto" href="#label-generators-section">available label generators</a> or
                    create your custom class that implements
                    <code class="language-php">\Phpopenchart\Label\LabelInterface</code>.</td>
                <td class="option-default-value"><code class="language-php">\Phpopenchart\Label\Short</code></td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">align</td>
                <td>Array with <code class="language-php">'vertical'</code> and
                    <code class="language-php">'horizontal'</code> keys. This enables you to set the
                    vertical and horizontal alignment of the value axis.</td>
                <td class="option-default-value">
<pre><code class="language-php">[
    'vertical' => 'middle',
    'horizontal' => 'center'
]</code></pre>
                </td>
                <td class="option-type">array</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>