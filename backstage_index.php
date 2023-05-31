<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
    rel="stylesheet"
    />
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
    ></script>
    <title>高雄大學學生宿舍管理系統</title>
</head>
<body>
  <div class="background-image"></div>
  <section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div style="width: 26rem;" class="bg-white border rounded-5 p-4">
    <div class="d-flex justify-content-center m-4">
      <img src="./image/nuk.png">
    </div>  
    <!--navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
      <li class="nav-item" role="presentation">
        <a
          class="nav-link active"
          id="tab-login"
          data-mdb-toggle="pill"
          href="#pills-login"
          role="tab"
          aria-controls="pills-login"
          aria-selected="true"
          >後台管理 登入</a>
      </li>
    </ul>
    <!-- content -->

  

    <div class="tab-content">
      <!-- login -->
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form action="./service/backstage_login.php" method="post">
          <div class="form-outline mb-4">
            <input required name="account" type="text" id="loginAccount" class="form-control" />
            <label class="form-label" for="loginAccount">帳號</label>
            <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
          </div>
    
          <div class="form-outline mb-4">
            <input required name="password" type="password" id="loginPassword" class="form-control" />
            <label class="form-label" for="loginPassword">密碼</label>
            <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
          </div>
          <?php
            if (isset($_SESSION["permission"]) && $_SESSION["permission"] == "Error"){
            echo "<p class='text-danger ms-1'>帳號或密碼錯誤</p>";
            }
          ?>
          <button type="submit" value="Login" class="btn btn-primary btn-block mb-4">登入</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Pills content -->
</div>
    </section>
</body>
</html>
<style>
  .background-image {
  position: fixed;
  left: 0;
  right: 0;
  z-index: -1;
  display: block;
  background-image: url('./image/background.jpg');
  background-size: cover;
  width: 100%;
  height: 100vh;
  -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);
}
</style>
<?php
    require('./service/connect_db.php');
    $conn = connect_db();


    $sql = "SELECT * FROM User WHERE account ='root'";

    $result = $conn->query($sql);

    if ($result->num_rows <= 0)
    {
        echo "NO root account , Auto create...";
        $sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

        $root = "root";
        $password = password_hash("root" ,PASSWORD_DEFAULT);  
        $email = "X";
        $phone = 0;
        $type = "system_manager";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssiss' ,$root , $password , $email , $phone , $root , $type);
        $stmt->execute();

        $sql = "INSERT INTO System_Manager (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$root);
        $stmt->execute();
        
    }

?>