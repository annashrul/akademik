<script type="text/javascript">
 
$(function () {
  $('#container').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false
    },
    title: {
      text: 'Data Siswa Di Setiap Jurusan'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
          style: {
            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
          }
        }
      }
    },
    series: [{
      type: 'pie',
      name: 'Persentase Jumlah Siswa',
      data: [
          <?php 
          // data yang diambil dari database
          if(count($pie)>0)
          {
             foreach ($pie as $data) {
              // $nm = count($data->nama);
             echo "['" .$data->nama_jurusan . "'," . $data->nm ."],\n";
             }
          }
          ?>
      ]
    }]
  });
});
 
</script>
 
<div id="container"></div>