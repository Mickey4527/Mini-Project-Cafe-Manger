<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';
    include_once '../global/dashboard/dashboard.php';
    
    
    if(!checkLogin()){
        header('Location: login.php');
    }
    
    htmlHeader('Home',null,'d-flex bg-cafe-white');
    navbar();
?>
<script src="/seed/node_modules/chart.js/dist/chart.umd.js"></script>

<div class="container-fluid p-5">
    <h1 class="h3">สวัสดี <?php echo $_SESSION['first_name'];?></h1>
    <?php
        checkGetttingStart();
        if(checkManager()){
            echo '<canvas id="myChart" style="width:100%;"></canvas>';
        }
    ?>
</div>

<?php if(checkManager()){?>
<script>
// x is date
const date = new Date()
let xValues = [];
for(let i = 0; i < 7; i++){
    date.setDate(date.getDate() - 1);
    xValues.push(date.toLocaleDateString('th-TH'));
}

let yValues = [];
<?php

    $result = querySql($conn,"SELECT 
    SUM(price) AS price, 
    DATE_FORMAT(sale_date, '%Y/%m/%d') AS sale_date 
    FROM 
    history_sales 
    WHERE 
    DATE(sale_date) BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE() 
    GROUP BY 
    DATE_FORMAT(sale_date, '%Y/%m/%d');
    ");

    while($row = mysqli_fetch_assoc($result)){
        echo "yValues.push({x:'".$row['sale_date']."',y:".$row['price']."});";
    }
?>


var barColors = ["#017143"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
        label: 'รายได้ในช่วง 7 วันที่ผ่านมา',
        backgroundColor: barColors,
        data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "รายได้ในช่วง 7 วันที่ผ่านมา"
    }
  }
});
</script>
<?php }
    htmlFooter();
?>

