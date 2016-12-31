<?php
use lulubin\echarts\ECharts;
ECharts::registerTheme('white');
$this->title = '近七日访问量';
?>
<?= ECharts::widget([
    'theme' => 'white',
    'responsive' => true,
    'options' => ['style' => 'height: 400px;'],
    'pluginOptions' => [
        'option' => [
            'tooltip' => ['trigger' => 'axis'],
            'legend' => ['data' => [$this->title]],
            'grid' => ['left' => '3%','right' => '4%','bottom' => '3%','containLabel' => true],
            'toolbox' => ['feature' => ['saveAsImage' => []]],
            'xAxis' => [
                'type' => 'category',
                'boundaryGap' => false,
                'data' => $time
            ],
            'yAxis' => ['type' => 'value'],
            'series' => [
                ['name' => $this->title,'type' => 'line','data' => $nums],
            ]
        ]
    ]
]); ?>