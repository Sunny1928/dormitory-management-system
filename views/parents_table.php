<!--Parents-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">家長資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addParentsModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">學生帳號</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php

              $result = parents_read_all($conn);

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
                  $student_account = $info['student_account'];
                  
                  
                  echo "<tr>" .
                    "<td>" . $name . "</td>".
                    "<td>". $account ."</td> ".
                    "<td>" . $email . "</td>".
                    "<td>" . $phone . "</td>".
                    "<td>" . $genders[$gender] . "</td>".
                    "<td>" . $student_account . "</td>".
                    "<td> 
                      <button onclick=\"put_parents('$name','$account','$email','$phone','$gender')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateParentsModal'><i class='fa fa-pencil'></i></button>
                      <button onclick=\"put_parents('$name','$account','$email','$phone','$gender')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteParentsModal'><i class='fa fa-trash'></i></button>
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
<div class="modal fade" id="addParentsModal" tabindex="-1" aria-labelledby="addParentsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSystemManagerModalLabel">新增家長</h5>
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
              <select class='form-select mb-4' name='student_account' required>
                <option value=''>學生帳號</option>
                <?php
                  $res = student_read_all($conn);
                  if (mysqli_num_rows($res) > 0) {
                    while ($info = mysqli_fetch_assoc($res)){
                      echo "<option value=".$info['account'].">".$info['account']."</option>";
                    }
                  }
                ?>
              </select>
              <input value='2' required type='hidden' name='type' class='form-control' />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" name='parents_create' value='parents_create'>確認</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php

// Update Modal
echo "
<div class='modal fade' id='updateParentsModal' tabindex='-1' aria-labelledby='updateParentsModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/user_controller.php'>
  <div class='modal-header'>
      <h5 class='modal-title' id='updateParentsModalLabel'>修改家長</h5>
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
        <input value='$type' required type='hidden' name='type' class='form-control' />
        
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
<div class='modal fade' id='deleteParentsModal' tabindex='-1' aria-labelledby='deleteParentsModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
    <form method='post' action='./controller/user_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteParentsModalLabel'>刪除家長</h5>
        </div>
        <div class='modal-body'>您確認要刪除此家長嗎？</div>
        <div class='modal-footer'>
          <input value=2 required type='hidden' name='type' class='form-control' />
          <input id='account' required type='hidden' name='account' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
    </form>
      </div>
  </div>
</div>

<script>
function put_parents(a, b, c, d, e){
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