<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>luismarto/phpopenchart examples</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Luís Cruz">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!-- Global CSS -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Plugins CSS -->
	<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="assets/plugins/prism/prism.css">
	<link rel="stylesheet" href="assets/plugins/lightbox/dist/ekko-lightbox.min.css">

	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/phpopenchart.css">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="body-blue">
<div class="page-wrapper">
	<!-- ******Header****** -->
	<header id="header" class="header">
		<div class="container">
			<div class="branding">
				<h1 class="logo font-size-12">
					<a href="index.php">
						<!--<span aria-hidden="true" class="icon_documents_alt icon"></span>-->
						<span class="text-highlight">luismarto/phpopenchart</span><span class="color-white">  examples</span>
					</a>
				</h1>
			</div><!--//branding-->
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Examples</li>
			</ol>
		</div><!--//container-->
	</header><!--//header-->
	<div class="doc-wrapper">
		<div class="container">
			<div id="doc-header" class="doc-header text-center">
				<h1 class="doc-title"><span aria-hidden="true" class="icon icon_datareport_alt"></span> Examples</h1>
				<div class="meta"><i class="fa fa-clock-o"></i> Last updated: Mar 5th, 2017</div>
			</div><!--//doc-header-->
			<div class="doc-body">

				<div class="doc-content">
					<div class="content-inner">
						<section id="column-charts" class="doc-section">
							<h2 class="section-title">Column charts</h2>
							<div class="section-block">
								<div id="column-basic" class="section-block">
									<h3 class="block-title">Basic column chart</h3>
									<p><img src="assets/images/examples/column-basic.png" alt="Basic column chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
    'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 256, 4578, 2164, 3658, 1145]
	]
]))->render();</code></pre>
								</div>


								<div id="column-multiple" class="section-block">
									<h3 class="block-title">Multiple series column chart</h3>
									<p><img src="assets/images/examples/column-multiple.png" alt="Multiple series column chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'chart' => [
		'width'  => 1000,
		'height' => 400
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'series' => ['Apartments', 'Houses', 'Hotels'],
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [
			[15480, 9048, 6541, 2354, 7415, 8745, 3154],
			[3296, 1564, 845, 4578, 2164, 3658, 1145],
			[152, 97, 154, 385, 80, 648, 54],
		],
	]
]))->render();</code></pre>
								</div>


								<div id="column-negative" class="section-block">
									<h3 class="block-title">Column chart with negative values</h3>
									<p><img src="assets/images/examples/column-negative.png" alt="Column chart with negative values" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
	]
]))->render();</code></pre>
								</div>


								<div id="column-chart-options" class="section-block">
									<h3 class="block-title">Custom chart options</h3>
									<p><img src="assets/images/examples/column-chart-options.png" alt="Custom column chart options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'chart' => [
		'width'          => 350,
		'height'         => 200,
		'column-padding' => [0, 15, 70, 70],
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>


								<div id="column-title-options" class="section-block">
									<h3 class="block-title">Custom title options</h3>
									<p><img src="assets/images/examples/column-title-options.png" alt="Custom column chart title options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'title'  => [
		'text'   => 'Monthly values',
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 13,
		'color'  => '#FF0000',
		'height' => 20,
		'padding' => [0]
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="column-label-axis-options" class="section-block">
									<h3 class="block-title">Custom axis label options</h3>
									<p><img src="assets/images/examples/column-label-axis-options.png" alt="Column chart with custom axis label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'title'  => [
		'text' => 'Monthly values',
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#FF0000',
		'angle'  => 35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="column-point-label-options" class="section-block">
									<h3 class="block-title">Custom point label options</h3>
									<p><img src="assets/images/examples/column-point-label-options.png" alt="Column chart with custom point label options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#FF0000',
		'angle'  => 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="column-no-point-label" class="section-block">
									<h3 class="block-title">Without point label</h3>
									<p><img src="assets/images/examples/column-no-point-label.png" alt="Column chart with no point label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'show'   => false
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="column-all-options" class="section-block">
									<h3 class="block-title">Column chart with all options</h3>
									<p><img src="assets/images/examples/column-all-options.png" alt="Column chart with all options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Column;

(new Column([
	'chart' => [
		'width'          => 800,
		'height'         => 500,
		'column-padding' => [0, 15, 70, 70],
	],
	'title'  => [
		'text'   => 'Monthly values',
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 13,
		'color'  => '#FF0000',
		'height' => 20,
		'padding' => [0]
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#00FF00',
		'angle'  => -35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'point-label'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#0000FF',
		'angle'  => 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>

							</div>
						</section><!--//doc-section-->









						<section id="bar-charts" class="doc-section">
							<h2 class="section-title">Bar charts</h2>
							<div class="section-block">
								<div id="bar-basic" class="section-block">
									<h3 class="block-title">Basic bar chart</h3>
									<p><img src="assets/images/examples/bar-basic.png" alt="Basic bar chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
    'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 256, 4578, 2164, 3658, 1145]
	]
]))->render();</code></pre>
								</div>


								<div id="bar-multiple" class="section-block">
									<h3 class="block-title">Multiple series bar chart</h3>
									<p><img src="assets/images/examples/bar-multiple.png" alt="Multiple series bar chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'chart' => [
		'width'  => 1000,
		'height' => 400
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'series' => ['Apartments', 'Houses', 'Hotels'],
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [
			[15480, 9048, 6541, 2354, 7415, 8745, 3154],
			[3296, 1564, 845, 4578, 2164, 3658, 1145],
			[152, 97, 154, 385, 80, 648, 54],
		],
	]
]))->render();</code></pre>
								</div>


								<div id="bar-negative" class="section-block">
									<h3 class="block-title">Bar chart with negative values</h3>
									<p><img src="assets/images/examples/bar-negative.png" alt="Bar chart with negative values" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
	]
]))->render();</code></pre>
								</div>





								<div id="bar-chart-options" class="section-block">
									<h3 class="block-title">Custom chart options</h3>
									<p><img src="assets/images/examples/bar-chart-options.png" alt="Custom bar chart options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'chart' => [
		'width'       => 350,
		'height'      => 200,
		'bar-padding' => [0, 15, 25, 30],
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>


								<div id="bar-title-options" class="section-block">
									<h3 class="block-title">Custom title options</h3>
									<p><img src="assets/images/examples/bar-title-options.png" alt="Custom bar chart title options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'title'  => [
		'text'    => 'Monthly values',
		'font'    => 'SourceSansPro-Light.otf',
		'size'    => 13,
		'color'   => '#FF0000',
		'height'  => 20,
		'padding' => [0]
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="bar-label-axis-options" class="section-block">
									<h3 class="block-title">Custom axis label options</h3>
									<p><img src="assets/images/examples/bar-label-axis-options.png" alt="Column chart with custom axis label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'title'  => [
		'text' => 'Monthly values',
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#FF0000',
		'angle'  => 35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="bar-point-label-options" class="section-block">
									<h3 class="block-title">Custom point label options</h3>
									<p><img src="assets/images/examples/bar-point-label-options.png" alt="Column chart with custom point label options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'font'   	=> 'SourceSansPro-Light.otf',
		'size'  	=> 12,
		'color' 	=> '#FF0000',
		'angle'  	=> 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="bar-no-point-label" class="section-block">
									<h3 class="block-title">Without point label</h3>
									<p><img src="assets/images/examples/bar-no-point-label.png" alt="Bar chart with no point label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'show'   => false
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="bar-all-options" class="section-block">
									<h3 class="block-title">Bar chart with all options</h3>
									<p><img src="assets/images/examples/bar-all-options.png" alt="Bar chart with all options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Bar;

(new Bar([
	'chart' => [
		'width'       => 800,
		'height'      => 500,
		'bar-padding' => [0, 15, 70, 70],
	],
	'title'  => [
		'text'   => 'Monthly values',
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 13,
		'color'  => '#FF0000',
		'height' => 20,
		'padding' => [0]
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#00FF00',
		'angle'  => -35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'point-label'  => [
		'font'  	=> 'SourceSansPro-Light.otf',
		'size'  	=> 12,
		'color' 	=> '#0000FF',
		'angle'  	=> 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>


							</div>
						</section><!--//doc-section-->












						<section id="line-charts" class="doc-section">
							<h2 class="section-title">Line charts</h2>
							<div class="section-block">
								<div id="line-basic" class="section-block">
									<h3 class="block-title">Basic line chart</h3>
									<p><img src="assets/images/examples/line-basic.png" alt="Basic line chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
    'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 256, 4578, 2164, 3658, 1145]
	]
]))->render();</code></pre>
								</div>


								<div id="line-multiple" class="section-block">
									<h3 class="block-title">Multiple series line chart</h3>
									<p><img src="assets/images/examples/line-multiple.png" alt="Multiple series line chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'chart' => [
		'width'  => 1000,
		'height' => 400
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'series' => ['Apartments', 'Houses', 'Hotels'],
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [
			[15480, 9048, 6541, 2354, 7415, 8745, 3154],
			[3296, 1564, 845, 4578, 2164, 3658, 1145],
			[152, 97, 154, 385, 80, 648, 54],
		],
	]
]))->render();</code></pre>
								</div>


								<div id="line-negative" class="section-block">
									<h3 class="block-title">Line chart with negative values</h3>
									<p><img src="assets/images/examples/line-negative.png" alt="Line chart with negative values" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="line-chart-options" class="section-block">
									<h3 class="block-title">Custom chart options</h3>
									<p><img src="assets/images/examples/line-chart-options.png" alt="Custom line chart options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'chart' => [
		'width'       => 350,
		'height'      => 200,
		'line-padding' => [0, 15, 25, 30],
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>


								<div id="line-title-options" class="section-block">
									<h3 class="block-title">Custom title options</h3>
									<p><img src="assets/images/examples/line-title-options.png" alt="Custom line chart title options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'title'  => [
		'text'    => 'Monthly values',
		'font'    => 'SourceSansPro-Light.otf',
		'size'    => 13,
		'color'   => '#FF0000',
		'height'  => 20,
		'padding' => [0]
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="line-label-axis-options" class="section-block">
									<h3 class="block-title">Custom axis label options</h3>
									<p><img src="assets/images/examples/line-label-axis-options.png" alt="Line chart with custom axis label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'title'  => [
		'text' => 'Monthly values',
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#FF0000',
		'angle'  => 35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="line-point-label-options" class="section-block">
									<h3 class="block-title">Custom point label options</h3>
									<p><img src="assets/images/examples/line-point-label-options.png" alt="Line chart with custom point label options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'font'   	=> 'SourceSansPro-Light.otf',
		'size'  	=> 12,
		'color' 	=> '#FF0000',
		'angle'  	=> 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="line-no-point-label" class="section-block">
									<h3 class="block-title">Without point label</h3>
									<p><img src="assets/images/examples/line-no-point-label.png" alt="Line chart with no point label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'show'   => false
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="line-all-options" class="section-block">
									<h3 class="block-title">Line chart with all options</h3>
									<p><img src="assets/images/examples/line-all-options.png" alt="Bar chart with all options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Line;

(new Line([
	'chart' => [
		'width'       => 800,
		'height'      => 500,
		'line-padding' => [0, 15, 70, 70],
	],
	'title'  => [
		'text'   => 'Monthly values',
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 13,
		'color'  => '#FF0000',
		'height' => 20,
		'padding' => [0]
	],
	'label-axis'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#00FF00',
		'angle'  => -35,
		'margin' => [
			'top'  => 15,
			'left' => 20
		],
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'point-label'  => [
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 12,
		'color'  => '#0000FF',
		'angle'  => 35,
		'generator' => '\Phpopenchart\Label\DefaultLabel',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>












							</div>
						</section><!--//doc-section-->



























						<section id="pie-charts" class="doc-section">
							<h2 class="section-title">Line charts</h2>
							<div class="section-block">
								<div id="pie-basic" class="section-block">
									<h3 class="block-title">Basic pie chart</h3>
									<p><img src="assets/images/examples/pie-basic.png" alt="Basic pie chart" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
    'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 256, 4578, 2164, 3658, 1145]
	]
]))->render();</code></pre>
								</div>


								<div id="pie-negative" class="section-block">
									<h3 class="block-title">Pie chart with negative values</h3>
									<div class="callout-block callout-info">
										<div class="icon-holder">
											<i class="fa fa-info-circle"></i>
										</div><!--//icon-holder-->
										<div class="content">
											<h4 class="callout-title">A note for negative values on Pie charts</h4>
											<p>As you can see in the example below, all values lower than 0 are treated as 0 and are not taken into account when the chart is processed. That's why there's only three pie slices on the chart.</p>
										</div><!--//content-->
									</div>
									<p><img src="assets/images/examples/pie-negative.png" alt="Pie chart with negative values" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="pie-chart-options" class="section-block">
									<h3 class="block-title">Custom chart options</h3>
									<p><img src="assets/images/examples/pie-chart-options.png" alt="Custom pie chart options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
	'chart' => [
		'width'       => 350,
		'height'      => 200,
		'pie-padding' => [0, 15, 25, 30],
	],
	'title'  => [
		'text' => 'Monthly values',
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>


								<div id="pie-title-options" class="section-block">
									<h3 class="block-title">Custom title options</h3>
									<p><img src="assets/images/examples/pie-title-options.png" alt="Custom pie chart title options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
	'title'  => [
		'text'    => 'Monthly values',
		'font'    => 'SourceSansPro-Light.otf',
		'size'    => 13,
		'color'   => '#FF0000',
		'height'  => 20,
		'padding' => [0]
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>




								<div id="pie-no-point-label" class="section-block">
									<h3 class="block-title">Without point label</h3>
									<p><img src="assets/images/examples/pie-no-point-label.png" alt="Pie chart with no point label" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
	'title'  => [
		'text' => 'Monthly values',
	],
	'point-label'  => [
		'show'   => false
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



								<div id="pie-all-options" class="section-block">
									<h3 class="block-title">Pie chart with all options</h3>
									<p><img src="assets/images/examples/pie-all-options.png" alt="Bar chart with all options" class="img-responsive centered"/></p>
									<pre><code class="language-php">&lt;?php
include "../vendor/autoload.php";

use Phpopenchart\Chart\Pie;

(new Pie([
	'chart' => [
		'width'       => 800,
		'height'      => 500,
		'pie-padding' => [0, 15, 70, 70],
	],
	'title'  => [
		'text'   => 'Monthly values',
		'font'   => 'SourceSansPro-Light.otf',
		'size'   => 13,
		'color'  => '#FF0000',
		'height' => 20,
		'padding' => [0]
	],
	'dataset' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
		'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
	]
]))->render();</code></pre>
								</div>



							</div>
						</section><!--//doc-section-->









					</div><!--//content-inner-->
				</div><!--//doc-content-->
				<div class="doc-sidebar">
					<nav id="doc-nav">
						<ul id="doc-menu" class="nav doc-menu hidden-xs" data-spy="affix">
							<li><a href="https://github.com/luismarto/phpopenchart">Back to Github repo</a></li>
							<li><a href="index.php">Go to docs</a></li>
							<li>&nbsp;</li>
							<li>
								<a class="scrollto" href="#column-charts">Column charts</a>
								<ul class="nav doc-sub-menu">
									<li><a class="scrollto" href="#column-basic">Basic</a></li>
									<li><a class="scrollto" href="#column-multiple">Multiple series</a></li>
									<li><a class="scrollto" href="#column-negative">Negative values</a></li>
									<li><a class="scrollto" href="#column-chart-options">Custom chart options</a></li>
									<li><a class="scrollto" href="#column-title-options">Custom title options</a></li>
									<li><a class="scrollto" href="#column-label-axis-options">Custom axis label options</a></li>
									<li><a class="scrollto" href="#column-point-label-options">Custom point label options</a></li>
									<li><a class="scrollto" href="#column-no-point-label">Without point label</a></li>
									<li><a class="scrollto" href="#column-all-options">All options</a></li>
								</ul><!--//nav-->
							</li>
							<li>
								<a class="scrollto" href="#bar-charts">Bar charts</a>
								<ul class="nav doc-sub-menu">
									<li><a class="scrollto" href="#bar-basic">Basic</a></li>
									<li><a class="scrollto" href="#bar-multiple">Multiple series</a></li>
									<li><a class="scrollto" href="#bar-negative">Negative values</a></li>
									<li><a class="scrollto" href="#bar-chart-options">Custom chart options</a></li>
									<li><a class="scrollto" href="#bar-title-options">Custom title options</a></li>
									<li><a class="scrollto" href="#bar-label-axis-options">Custom axis label options</a></li>
									<li><a class="scrollto" href="#bar-point-label-options">Custom point label options</a></li>
									<li><a class="scrollto" href="#bar-no-point-label">Without point label</a></li>
									<li><a class="scrollto" href="#bar-all-options">Custom options</a></li>
								</ul><!--//nav-->
							</li>
							<li>
								<a class="scrollto" href="#line-charts">Line charts</a>
								<ul class="nav doc-sub-menu">
									<li><a class="scrollto" href="#line-basic">Basic</a></li>
									<li><a class="scrollto" href="#line-multiple">Multiple series</a></li>
									<li><a class="scrollto" href="#line-negative">Negative values</a></li>
									<li><a class="scrollto" href="#line-chart-options">Custom chart options</a></li>
									<li><a class="scrollto" href="#line-title-options">Custom title options</a></li>
									<li><a class="scrollto" href="#line-label-axis-options">Custom axis label options</a></li>
									<li><a class="scrollto" href="#line-point-label-options">Custom point label options</a></li>
									<li><a class="scrollto" href="#line-no-point-label">Without point label</a></li>
									<li><a class="scrollto" href="#line-all-options">Custom options</a></li>
								</ul><!--//nav-->
							</li>
							<li>
								<a class="scrollto" href="#pie-charts">Pie charts</a>
								<ul class="nav doc-sub-menu">
									<li><a class="scrollto" href="#pie-basic">Basic</a></li>
									<li><a class="scrollto" href="#pie-negative">Negative values</a></li>
									<li><a class="scrollto" href="#pie-chart-options">Custom chart options</a></li>
									<li><a class="scrollto" href="#pie-title-options">Custom title options</a></li>
									<li><a class="scrollto" href="#pie-label-axis-options">Custom axis label options</a></li>
									<li><a class="scrollto" href="#pie-point-label-options">Custom point label options</a></li>
									<li><a class="scrollto" href="#pie-no-point-label">Without point label</a></li>
									<li><a class="scrollto" href="#pie-all-options">Custom options</a></li>
								</ul><!--//nav-->
							</li>
						</ul><!--//doc-menu-->
					</nav>
				</div><!--//doc-sidebar-->
			</div><!--//doc-body-->
		</div><!--//container-->
	</div><!--//doc-wrapper-->

</div><!--//page-wrapper-->

<footer id="footer" class="footer text-center">
	<div class="container">
		<!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
		<small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com/" target="_blank">Xiaoying Riley</a> for developers</small>

	</div><!--//container-->
</footer><!--//footer-->


<!-- Main Javascript -->
<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/plugins/prism/prism.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="assets/plugins/lightbox/dist/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-match-height/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>

</body>
</html>

