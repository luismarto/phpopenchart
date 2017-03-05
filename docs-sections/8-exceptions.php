<h2 class="section-title">Exceptions</h2>
<div class="section-block">
    <p>Along the process some exceptions might be thrown if something goes wrong.
        Below you can check the list of existing exceptions and why they are thrown</p>
    <div class="table-responsive">
        <table class="table table-bordered table-exceptions">
            <thead>
            <tr>
                <th style="min-width: 100px">Exception</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="option-key">\Phpopenchart\Exception\DatasetNotDefinedException</td>
                <td>This exception is thrown when you fail to set a <code class="language-php">'dataset'</code> key
                    array that's passed to the chart constructor or if you pass a malformed array. <br />
                    Make sure you take a look at the <a class="scrollto" href="#dataset-section">dataset</a> documentation.
                </td>
            <tr>
                <td class="option-key">\Phpopenchart\Exception\LogoFileNotFoundException</td>
                <td>If you specified a logo on the <a href="#options-chart">chart configuration</a>
                    and the logo file cannot be found, this exception is thrown.</td>
            </tr>
            <tr>
                <td class="option-key">\Phpopenchart\Exception\PointsInSeriesDontMatchException</td>
                <td>This exception might occur when you're creating a multiple series chart.<br />
                    Make sure each array of <code class="language-php">dataset.data</code> has the exact same number of points. <br />
                    If you have a series that has 5 points and another with 3 points, this exception will be thrown.</td>
            </tr>
            <tr>
                <td class="option-key">\Phpopenchart\Exception\ChartRatioOutOfBoundariesException</td>
                <td>This will be thrown when you've specified the <code class="language-php">chart.ratio</code> option to something that's
                not a float or the float isn't between 0.0 and 1.0.</td>
            </tr>
            </tbody>
        </table>
    </div>
</div><!--//section-block-->