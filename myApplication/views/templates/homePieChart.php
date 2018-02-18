
<div class="panel panel-warning panelContent" id="homePieChart">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">نمودار آمار کل بیماران ثبت شده</h3>
        <div class="glyphicon glyphicon-remove panelPrimaryBTN" id="homePieChartRemove" onclick="showPanel('homePieChart', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelPrimaryBTN" id="homePieChartMinus" onclick="showPanel('homePieChart', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelPrimaryBTN" style="display: none;" id="homePieChartPlus" onclick="showPanel('homePieChart', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="homePieChartBody">
          <canvas id="pieChart"></canvas>
      </div>
    </div>


<script>
    $('document').ready(function () {
        var doughnutData = {
            labels: ['اهدا شده','درحال پیگیری', 'بهبود یافته', 'فوت شده', 'غیر قابل اهدا'],
            datasets: [
                {
                    'backgroundColor' : ['#37bc9b', '#ff902b','#7266ba','#232735', '#f05050'],
                    'data' : ['450','205','509','1589','1643']
                }
            ]
        };

        var doughnutOptions = {
            legend: {
                display: false
            }
        };
        var doughnutctx = document.getElementById('pieChart').getContext('2d');
        var doughnutChart = new Chart(doughnutctx, {
            data: doughnutData,
            type: 'pie',
            options: doughnutOptions
        });
    })

</script>
