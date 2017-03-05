<div id="craft-your-own-formatter" class="section-block">
    <h3 class="block-title">Craft your own formatter</h3>
    <p>If you need to display values / text in a format other than the default formatters, you can create your own Label Formatter class
    and use it on your chart.</p>
    <p>Make sure your class implements <code class="language-php">\Phpopenchart\Label\LabelInterface</code> and then specify the full
    qualified class name on the chart settings (look for <i class="italic">point-label.generator</i>,
    <i class="italic">point-label.pie-generator</i> and <i class="italic">value-axis.generator</i> on the
    <a class="scrollto" href="#options-section">options</a> section).</p>
    <pre><code class="language-php">&lt;?php

class ThousandLabelGenerator implements \Phpopenchart\Label\LabelInterface
{
    public function generateLabel($value)
    {
        return ((int)($value / 1000)) . "k";
    }
}

(new Line([
    'label-axis' => [
     'generator' => 'ThousandLabelGenerator'
    ],
    'point-label' => [
      'generator' => 'ThousandLabelGenerator'
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'data' => [
            3296,
            [1546, '#F88C30'],
            -256,
        ]
    ]
]))->render();</code></pre>
    </div>
</div>