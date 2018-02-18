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
          <canvas id="homeBarChart"></canvas>
        <!--<div style="float: right; direction: rtl; margin-right: 60px;">
            راهنما:
            <span style="color: #7CB5EC;">کل بیماران</span>
             -
            <span style="color: black;">بیماران فوت شده</span>
             -
            <span style="color: green;">بیماران اهدا شده</span>
             -
            <span style="color: orange;">بیماران غیر قابل اهدا</span>
        </div>-->
      </div>
    </div>


<script>

    $(function () {
        var datasets= [
            {
                label: 'همه بیماران',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                backgroundColor: '#5d9cec',
                borderColor: '#5d9cec',
                borderWidth: 1
            },
            {
                label: 'اهدا شده',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3],
                backgroundColor: '#37bc9b',
                borderColor: '#37bc9b',
                borderWidth: 1
            },
            {
                label: 'درحال پیگیری',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2],
                backgroundColor: '#ff902b',
                borderColor: '#ff902b',
                borderWidth: 1
            },
            {
                label: 'بهبود یافته',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3],
                backgroundColor: '#7266ba',
                borderColor: '#7266ba',
                borderWidth: 1
            },
            {
                label: 'فوت شده',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2],
                backgroundColor: '#232735',
                borderColor: '#232735',
                borderWidth: 1
            },
            {
                label: 'غیر قابل اهدا',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1],
                backgroundColor: '#f05050',
                borderColor: '#f05050',
                borderWidth: 1
            }
        ];
        var barData = {
            labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
        datasets: datasets
    };

        var barOptions = {
            legend: {
                display: true
            }
        };
        var barctx = document.getElementById('homeBarChart').getContext('2d');
        var barChart = new Chart(barctx, {
            data: barData,
            type: 'bar',
            options: barOptions
        });

    });

</script>


<!--<script type="text/javascript">


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
<script type="text/javascript" src="<?php /*echo asset_url(); */?>charts/js/highcharts.src.js"></script>-->