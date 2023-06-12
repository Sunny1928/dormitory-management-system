<!--Dorm Manager-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍管理員資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addDormManagerModal'><i class='fa fa-add me-1'></i>新增</button>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div  data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">名字</th>
              <th scope="col">帳號</th>
              <th scope="col">Email</th>
              <th scope="col">電話</th>
              <th scope="col">性別</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php

              $result = dorm_manager_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $name = $info['name'];
                  $account = $info['account'];
                  $password = $info['password'];
                  $email = $info['email'];
                  $phone = $info['phone'];
                  $gender = $info['gender'];
                  $type = $info['type'];
                  
                  
                  echo "<tr>" .
                    "<td>" . $name . "</td>".
                    "<td>". $account ."</td> ".
                    "<td>" . $email . "</td>".
                    "<td>" . $phone . "</td>".
                    "<td>" . $genders[$gender] . "</td>".
                    "<td>
                      <button onclick=\"put_dorm_man('$name','$account','$email','$phone','$gender')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateDormManagerModal'><i class='fa fa-pencil'></i></button>
                      <button onclick=\"put_dorm_man('$name','$account','$email','$phone','$gender')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteDormManagerModal'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

</div>

<!-- Add Modal -->

<div class="modal fade" id="addDormManagerModal" tabindex="-1" aria-labelledby="addDormManagerModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSystemManagerModalLabel">新增宿舍管理員</h5>
      </div>
      <form method="post" action="./controller/user_controller.php">
        <div class="modal-body">
          <div class="text-center mb-3">
            <div class="form-outline mb-4">
              <input required type="text" name="name" class="form-control" />
              <label class="form-label">名稱</label>
            </div>
            <div class="form-outline mb-4">
              <input required type="text" name="account" class="form-control" />
              <label class="form-label">帳號</label>
            </div>
            <div class="form-outline mb-4">
              <input required type="password" name="password" class="form-control" />
              <label class="form-label" >密碼</label>
            </div>
            <div class="form-outline mb-4">
              <input required type="email" name="email"  class="form-control" />
              <label class="form-label">Email</label>
            </div>
            <div class="form-outline mb-4">
              <input required type="tel" name="phone" class="form-control" />
              <label class="form-label">電話</label>
            </div>
            <select class='form-select mb-4' name=gender required>
              <option value=''>性別</option>
              <?php
              for($i = 0; $i<2; $i++){
                echo "<option value=$i>".$genders[$i]."</option>";
              }
              ?>
            </select>
            <input value='1' required type='hidden' name='type' class='form-control' />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-primary" name='dorm_manager_create' value='dorm_manager_create'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Update Modal
echo "
<div class='modal fade' id='updateDormManagerModal' tabindex='-1' aria-labelledby='updateDormManagerModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/user_controller.php'>
  <div class='modal-header'>
      <h5 class='modal-title' id='updateDormManagerModalLabel'>修改宿舍管理員</h5>
    </div>
    <div class='modal-body'>
        <div class='text-center mb-3'>
          <div class='form-outline mb-4'>
          <input id='name' required type='text' name='name' class='form-control' />
          <label class='form-label'>名稱</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='account' readonly required type='text' name='account'  class='form-control' />
          <label class='form-label'>帳號</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='email' required type='email' name='email' class='form-control' />
          <label class='form-label'>Email</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='phone' required type='tel' name='phone' class='form-control' />
          <label class='form-label'>電話</label>
        </div>
        <select id='gender' class='form-select mb-4' name='gender' required>
          <option value=''>性別</option>";
          for($i = 0; $i<2; $i++){
            echo "<option value=$i"; if($gender ==$i) echo " selected"; echo ">".$genders[$i]."</option>";
          }
        echo "</select>
        <input value='1' required type='hidden' name='type' class='form-control' />
        
      </div>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
      <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
    </div>
  </form>
  </div>
  </div>
</div>";
?>

<!-- Delete  Modal -->
<div class='modal fade' id='deleteDormManagerModal' tabindex='-1' aria-labelledby='deleteDormManagerModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <form method='post' action='./controller/user_controller.php'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteDormManagerModalLabel'>刪除宿舍管理員</h5>
        </div>
        <div class='modal-body'>您確認要刪除此宿舍管理員嗎？</div>
        <div class='modal-footer'>
          <input value='1' required type='hidden' name='type' class='form-control' />
          <input id='account' required type='hidden' name='account' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function put_dorm_man(a, b, c, d, e, f){
  var elms = document.querySelectorAll("[id='name']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='account']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b

  var elms = document.querySelectorAll("[id='email']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=c

  var elms = document.querySelectorAll("[id='phone']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=d

  var elms = document.querySelectorAll("[id='gender']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=e
}
</script>