<div class="box_tite mb-3">Biểu đồ thống kê</div>

<div class="box_chart mt-3">
    <h2 class="py-2 mx-3">Thống kê đơn hàng bán được theo ngày</h2>
    <div id="myfirstchart" style="height: 350px;"></div>
</div>

<div class="box_chart mt-3">
    <h2 class="py-2 mx-3">Thống kê hàng hóa theo loại</h2>
    <div id="piechart_3d" style="width: 100%; height: 400px"></div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Loại', 'Số Lượng'],
  <?php
    foreach($listTK1 as $item){
        echo "['$item[category_name]', $item[so_luong]],";
    }
  ?>
]);

  var options = {'title':'TỈ LỆ HÀNG HÓA THEO DANH MỤC', is3D: true};

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
  let orderData = [];

  <?php
    foreach($listTk2 as $item) {
        echo "orderData.push({ 'ngay': '" . $item['ngay'] . "', 'ban_duoc': " . $item['ban_duoc'] . ", 'count_order': " . $item['count_order'] . ", 'sum_pay': " . $item['sum_pay'] . " });";
    }
  ?>

new Morris.Bar({
        // ID của phần tử HTML để vẽ biểu đồ
        element: 'myfirstchart',
        // Dữ liệu
        title: 'Biểu đồ thống kê đơn hàng theo ngày',
        data: orderData,
        // Trường dữ liệu cho trục x (ngày)
        xkey: 'ngay',
        // Trường dữ liệu cho trục y (số đơn hàng)
        ykeys: ['count_order'],
        // Nhãn cho trục y
        labels: ['Số lượng đơn hàng'],
        // Màu sắc của biểu đồ
        lineColors: ['#FF5733'], // Màu cam
        // Định dạng hiển thị cho dữ liệu trên biểu đồ
        parseTime: false
    });


</script>