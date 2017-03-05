<div id="options-title" class="section-block">
    <h3 class="block-title">Title options</h3>
    <div class="col-xs-8">
        <p>These options allows you to configure the display of the chart's title. All the options are nested within the parent
            <code class="language-php">title</code> key on the configuration file.</p>
    </div>
    <div class="col-xs-4">
        <img src="assets/images/52-tile-options.png" alt="PHPOpenChart Title options" />
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
                <td class="option-key">text</td>
                <td>The description of the chart. You probably want to set
                    this for each chart</td>
                <td class="option-default-value">
                    <i class="italic">Chart default title</i>
                </td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">font</td>
                <td>Path for the font (odt or ttf) to be used on the title. <br />
                    You can either set this as the full path of the font file or
                    simply set the font file name if you want to use one of the
                    SourceSans fonts (that are available on the
                    <i class="italic">fonts</i> directory).</td>
                <td class="option-default-value">
                    <code class="language-php">SourceSansPro-Semibold.otf</code>
                </td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">size</td>
                <td>Sets the font size to be used for the title text</td>
                <td class="option-default-value">
                    <code class="language-php">12</code>
                </td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">color</td>
                <td>Sets the color in which the title should be printed.
                    Make sure you pass a valid hexadecimal color (with #)</td>
                <td class="option-default-value">
                    <code class="language-php">#999999</code>
                </td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">height</td>
                <td>Sets the height of the title component. The greater the
                    value, the greater the distance between the title and the
                    chart area.<br />Note that the width and height of the chart
                    remains, so this results in the chart area to be smaller.</td>
                <td class="option-default-value">
                    <code class="language-php">26</code>
                </td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">padding</td>
                <td>Besides the height, you can set the padding for the title
                    component, just as you do with the chart.<br />Like the
                    chart padding, this accepts an array with four integer
                    values for the top-padding, right-padding, bottom-padding
                    and left-padding.</td>
                <td class="option-default-value">
                    <code class="language-php">[15, 0, 15, 0]</code>
                </td>
                <td class="option-type">array</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>