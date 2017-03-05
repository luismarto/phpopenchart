
<h2 class="section-title">Label generators</h2>
<div class="section-block">
    <p>The axis or point values are always formatted according to a given Label generator.
        This enables you to display the value in a custom format, based on the information you want to print.<br />
        PhpOpenChart has a set of predefined formatters you can use, but you can also create your own Label formatter
        and use it.</p>

    <div id="phpopenchart-formatters" class="section-block">
        <h3 class="block-title">PhpOpenChart formatters</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-labels">
                <thead>
                <tr>
                    <th style="min-width: 100px">FQ Class Name</th>
                    <th>Description</th>
                    <th style="min-width: 190px">Example</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="option-key">\Phpopenchart\Label\DefaultLabel</td>
                    <td>The more basic formatter. Just recieve the value and print it as it is, without any formatting.</td>
                    <td>100 => 100<br />30000 => 30000</td>
                </tr>
                <tr>
                    <td class="option-key">\Phpopenchart\Label\Short</td>
                    <td>This formatter shortens the number. Instead of displaying the full number, displays a number
                        and a letter for the power of the number.</td>
                    <td>100 => 100<br />30000 => 30k<br />7000000 => 7M</td>
                </tr>
                <tr>
                    <td class="option-key">\Phpopenchart\Label\NumberFormatter</td>
                    <td>This formatter adds a separator on the given number between the thousands and millions.<br />
                        If you use the formatter on a non-valid number, it will leave it as it is.
                    </td>
                    <td>100 => 100<br />30000 => 30 000<br />7000000 => 7 000 000</td>
                </tr>
                <tr>
                    <td class="option-key">\Phpopenchart\Label\PercentageFormatter</td>
                    <td>Enables you to display percentage values, with decimals and the <code>%</code> symbol.</td>
                    <td>2.54 => 2,54 %<br />26 => 26,00 %<br />100 => 100,00 %</td>
                </tr>
                <tr>
                    <td class="option-key">\Phpopenchart\Label\EurCurrencyFormatter</td>
                    <td>Uses the <code class="language-php">NumberFormatter</code> and appends a <code>€</code> symbol at the end of the number.</td>
                    <td>100 => 100 €<br />30000 => 30 000 €<br />7000000 => 7 000 000 €</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>