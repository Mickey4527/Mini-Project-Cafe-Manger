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
<script src="/node_modules/chart.js/dist/chart.umd.js"></script>

<div class="container-fluid p-5">
    <h1 class="h3">สวัสดี <?php echo $_SESSION['first_name'];?></h1>
    <div class="row mb-4 p-4">
    <?php
        checkGetttingStart();
        if(checkManager()){?>
        <div class="col-5 border bg-body p-4 rounded">
            <h2 class="h5">รายงานการขาย</h2>
            <small class="text-secondary">รายงานการขายช่วง 7 วันที่ผ่านมา</small>
            <canvas id="myChart" style="width:100%;"></canvas>
        </div>
        <div class="col-5 mx-3">
            <div class="row">
                <div class="col-6 border bg-body p-4 rounded">
                    <h2 class="h5 text-secondary">จำนวนพนักงานทั้งหมด</h2>
                    <small class="h1">
                        <?php
                            $result = getAllSql($conn,'COUNT(user_id) AS count','employees_account');
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                        ?>
                    </small>
                </div>
                <div class="col-6 border bg-body p-4 rounded">
                    <h2 class="h5 text-secondary">จำนวนสินค้า</h2>
                    <small class="h1">
                        <?php
                            $result = getAllSql($conn,'COUNT(product_id) AS count','products');
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                        ?>
                    </small>
                </div>
            </div>

        </div>
    <?php  }
    ?>
    </div>
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
        label: 'รายได้ในแต่ละวัน',
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

