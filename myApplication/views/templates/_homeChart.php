<title><?php echo $siteTitle; ?> | صفحه نخست</title>

<div class="panel panel-primary panelContent" id="indexChart">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">نمودار یکساله آمار کل بیماران ثبت شده</h3>
        <div class="glyphicon glyphicon-remove panelPrimaryBTN" id="indexChartRemove" onclick="showPanel('indexChart', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelPrimaryBTN" id="indexChartMinus" onclick="showPanel('indexChart', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelPrimaryBTN" style="display: none;" id="indexChartPlus" onclick="showPanel('indexChart', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="indexChartBody">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto; margin-right: 60px;"></div>
        <div style="float: right; direction: rtl; margin-right: 60px;">
            راهنما:
            <span style="color: #7CB5EC;">کل بیماران</span>
             - 
            <span style="color: black;">بیماران فوت شده</span>
             - 
            <span style="color: green;">بیماران اهدا شده</span>
             - 
            <span style="color: orange;">بیماران غیر قابل اهدا</span>
        </div>
      </div>
    </div>
    
    
<script type="text/javascript">
/*$(function () {
    $('#container').highcharts({
        title: {
            text: 'نمودار یکساله آمار کل بیماران ثبت شده',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند']
        },
        yAxis: {
            title: {
                text: 'تعداد بیماران'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'نفر'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'کل بیماران',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'فوت شده',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'اهدا شده',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'غیر قابل اهدا',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
}); */

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'نمودار یکساله آمار کل بیماران ثبت شده'
        },
        xAxis: {
            categories: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'تعداد بیماران'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});
        </script>
<script type="text/javascript" src="<?php echo asset_url(); ?>charts/js/highcharts.src.js"></script>