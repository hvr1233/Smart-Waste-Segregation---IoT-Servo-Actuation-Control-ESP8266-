<?php
// session_start();
include("connection.php");

// Get latest data
$sql = "SELECT * FROM 4421_dustbin ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$value1 = $row["value1"];
$value2 = $row["value2"];
$reading_time = $row["reading_time"];


// if($value1 == 0){
//     $value1="Wet Waste";
// }else{
//     $value1 ="Dry Waste";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Smart Dustbin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    :root {
      --primary: #3a6ea5;
      --secondary: #004e98;
      --accent: #ff6b6b;
      --light: #f8f9fa;
      --dark: #343a40;
      --success: #4caf50;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: var(--light);
      min-height: 100vh;
      background-attachment: fixed;
    }
    
    .dashboard-header {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding: 15px 0;
    }
    
    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      color: white;
      transition: transform 0.3s ease;
      margin-bottom: 20px;
    }
    
    .card-title {
      color: #fff;
      font-weight: 600;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding-bottom: 15px;
      margin-bottom: 20px;
    }
    
    .status-badge {
      background: var(--success);
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
    }
    
    .data-value {
      font-size: 24px;
      font-weight: 700;
      color: #4ecdc4;
    }
    
    .data-label {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 5px;
    }
    
    .robot-frame {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
      height: 400px;
      background: #000;
    }
    
    .location-data {
      background: rgba(0, 0, 0, 0.3);
      border-radius: 12px;
      padding: 15px;
    }
    
    .btn-primary {
      background: var(--primary);
      border: none;
      border-radius: 30px;
      padding: 10px 25px;
      font-weight: 500;
      transition: all 0.3s;
    }
    
    .btn-primary:hover {
      background: var(--secondary);
      transform: translateY(-2px);
    }
    
    .btn-outline-light {
      border-radius: 30px;
      padding: 10px 25px;
      font-weight: 500;
    }
    
    .control-btn {
      margin: 5px;
      min-width: 100px;
    }
    
    @media (max-width: 768px) {
      .robot-frame {
        height: 300px;
      }
      
      .data-value {
        font-size: 20px;
      }
    }
    
    .value-display {
      background: rgba(0, 0, 0, 0.2);
      padding: 15px;
      border-radius: 12px;
      text-align: center;
      margin-bottom: 15px;
    }
    
    .control-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 20px;
    }
  </style>
</head>
<body onload="getLocation()">
  <div class="dashboard-header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 text-center">
          <h2 class="mb-0"><i class="fas fa-trash-alt mr-2"></i> Smart Dustbin Monitoring System</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="container py-4">
    <div class="row">

      
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-microchip mr-2"></i> System Status</h5>
            
            <div class="value-display">
              <div class="data-label">Dustbin Level</div>
              <div class="data-value"><?= $value1 ?></div>
              
              <div class="mt-3">
              <div class="data-label">Last Reading Time</div>
              <div class="data-value"><?= $reading_time ?></div>
            </div>
            
            </div>
            

          </div>
        </div>
      </div>
    </div>
  </div>
   
   <?php
   if(isset($_POST["on"])) {
     $a = json_encode(array("wet" => "on"));
     file_put_contents("light.json", $a);
     echo '<script>window.location.replace("index.php");</script>';
   }
   if(isset($_POST["off"])) {
     $a = json_encode(array("wet" => "off"));
     file_put_contents("light.json", $a);
     echo '<script>window.location.replace("index.php");</script>';
   }
   ?>
</body>
</html>