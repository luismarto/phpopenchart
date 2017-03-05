<h2 class="section-title">Methods</h2>
<div class="section-block">
    <p>The only available public method is <code class="language-php">render(['filepath']);</code> which renders the chart on the
        browser or stores the chart onto a file.</p>
    <p>If you call the method with no parameter (e.g.: <code class="language-php">render();</code>) the chart will be rendered in the
    browser and a <code class="language-php">header("Content-type: image/png")</code> will be used, so beware if you have already
        printed something before the chart.</p>
    <p>If you specify a file path (e.g.: <code class="language-php">render('charts/sample.png');</code>) a file is created and then
        you can load that file.</p>
</div><!--//section-block-->