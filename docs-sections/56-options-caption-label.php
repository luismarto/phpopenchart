<div id="options-caption-label"  class="section-block">
    <h3 class="block-title">Caption label options</h3>
    <div class="col-xs-8">
        <p>When you print a Pie chart or any other type that has multiple series, a "caption" is added on the top right of the chart.</p>
        <p>In order to customize it, you are able to change any of the following options, existing under
            the <code class="language-php">caption-label</code> key.</p>
    </div>
    <div class="col-xs-4">
        <img src="assets/images/56-caption-label-options.png" alt="PHPOpenChart Caption label options" />
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
                <td>Path for the font (odt or ttf) to be used on the text. <br />
                    You can either set this as the full path of the font file or simply set the font file name,
                    if you want to use one of the SourceSans fonts (that are available on the
                    <i class="italic">fonts</i> directory).</td>
                <td class="option-default-value"><code class="language-php">SourceSansPro-Regular.otf</code></td>
                <td class="option-type">string</td>
            </tr>
            <tr>
                <td class="option-key">size</td>
                <td>The size for the text under the caption.</td>
                <td class="option-default-value"><code class="language-php">10</code></td>
                <td class="option-type">int</td>
            </tr>
            <tr>
                <td class="option-key">color</td>
                <td>Hexadecimal color used for the text. You can set any hexadecimal color value.</td>
                <td class="option-default-value"><code class="language-php">#666666</code></td>
                <td class="option-type">string</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>