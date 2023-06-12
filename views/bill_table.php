<!--Bill-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">帳單資料</h4>
    <div class="d-flex">
      <select type="text" id="billYearFilter" onchange="table_filter('billYearFilter','billTable',1)" class='form-select-sm ms-2'  required>
        <option value=''>年</option>
        <?php
        for($i = 0; $i<count($years); $i++){
          echo "<option value=".$years[$i].">".$years[$i]."</option>";
        }?>
      </select>
      <select type="text" id="billTypeFilter" onchange="table_filter('billTypeFilter','billTable',4)" class='form-select-sm ms-2'  required>
        <option value=''>帳單類別</option>
        <?php
        for($i = 0; $i<count($bill_types); $i++){
          echo "<option value=".$bill_types[$i].">".$bill_types[$i]."</option>";
        }?>
      </select>
      <select type="text" id="billStateFilter" onchange="table_filter('billStateFilter','billTable',6)" class='form-select-sm ms-2'  required>
        <option value=''>帳單狀態</option>
        <?php
        for($i = 0; $i<count($bill_states); $i++){
          echo "<option value=".$bill_states[$i].">".$bill_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0){
            echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addBillModal'><i class='fa fa-add me-1'></i>新增</button>";
        }
      ?>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id="billTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th>
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">標題</th>
              <th scope="col">類別</th>
              <th scope="col">費用</th>
              <th scope="col">狀態</th>
              <?php
                if( $_SESSION["permission"] == 0){
                  echo "<th scope='col'>操作</th>";
                }
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = bill_read_all($conn);
            }else if($_SESSION["permission"] == 2){
              $result = bill_read_account($conn , $_SESSION['student_account']);
            }else{
              $result = bill_read_account($conn , $_SESSION['account']);
            }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['bill_id'];
                  $fee = $info['fee'];
                  $type = $info['type'];
                  $title = $info['title'];
                  $state = $info['state'];
                  $account = $info['account'];
                  $year = $info['year'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $title . "</td>".
                    "<td>" . $bill_types[$type] . "</td>".
                    "<td>" . $fee . "</td>".
                    "<td class='".$state_classes[$state]."'>" . $bill_states[$state] . "</td>";
                  if( $_SESSION["permission"] == 0){
                    echo "<td>
                      <button onclick=\"put_bill('$id','$year','$account','$type','$title','$fee','$state')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateBillModal'><i class='fa fa-pencil'></i></button>
                      <button onclick=\"put_bill('$id','$year','$account','$type','$title','$fee','$state')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteBillModal'><i class='fa fa-trash'></i></button>
                    </td>";
                  }
                  echo  "</tr>";

                  
                }
              }else{
                echo "<td class='text-center' colspan='100%'>無</td>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>



<!-- Add Modal -->
<div class='modal fade' id='addBillModal' tabindex='-1' aria-labelledby='addBillModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增帳單</h5>
      </div>
      <form method='post' action='./controller/bill_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='year_account' required>
              <option value=''>年度-帳號</option>
              <?php
                $res = border_read_year($conn, $default_year);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['year'].'-'.$info['account'].">".$info['year'].'-'.$info['account'].''."</option>";
                  }
                }
              ?>
            </select>
            <select class='form-select mb-4' name=type required>
              <option value=''>類別</option>
              <?php
              for($i = 0; $i<5; $i++){
                echo "<option value=$i>".$bill_types[$i]."</option>";
              }
              ?>
            </select>
            <div class='form-outline mb-4'>
              <input required type='text' name='title' id='title' class='form-control' />
              <label class='form-label' for='title'>名稱</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='fee' class='form-control' />
              <label class='form-label'>費用</label>
            </div>
          </div>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='create' value='create'>確認</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<?php
// Update Modal
echo "
<div class='modal fade' id='updateBillModal' tabindex='-1' aria-labelledby='updateBillModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/bill_controller.php'>
    <div class='modal-header'>
      <h5 class='modal-title' id='updateBillModalLabel'>修改帳單</h5>
    </div>
    <div class='modal-body'>
      <div class='text-center mb-3'>
        <div class='form-outline mb-4'>
          <input id='id' required readonly type='text' name='bill_id' class='form-control' />
          <label class='form-label'>帳單編號</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='year' required readonly type='text' name='year' class='form-control' />
          <label class='form-label'>年</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='account' required readonly type='text' name='account' class='form-control' />
          <label class='form-label'>帳號</label>
        </div>
        
        <select id='type' class='form-select mb-4' name='type' required>
          <option value=''>類別</option>";
          for($i = 0; $i<5; $i++){
            echo "<option value=$i"; 
            if($type == $i) echo " selected"; 
            echo ">".$bill_types[$i]."</option>";
          }
        echo "</select>
        <div class='form-outline mb-4'>
          <input id='title' required type='text' name='title'' class='form-control' />
          <label class='form-label'>名稱</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='fee' required type='text' name='fee' class='form-control' />
          <label class='form-label' >費用</label>
        </div>
        <select id='state' class='form-select mb-4' name='state' required>
          <option value=''>狀態</option>";
          for($i = 0; $i<2; $i++){
            echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$bill_states[$i]."</option>";
          }
        echo "</select>
        
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

<!--Delete  Modal -->
<div class='modal fade' id='deleteBillModal' tabindex='-1' aria-labelledby='deleteBillModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <form method='post' action='./controller/bill_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteBillModalLabel'>刪除帳單</h5>
        </div>
        <div class='modal-body'>您確認要刪除此帳單嗎？</div>
        <div class='modal-footer'>
          <input id='id' required type='hidden' name='bill_id' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

function put_bill(a, b, c, d, e, f, g){ 
  var elms = document.querySelectorAll("[id='id']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='year']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b

  var elms = document.querySelectorAll("[id='account']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=c

  var elms = document.querySelectorAll("[id='type']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=d

  var elms = document.querySelectorAll("[id='title']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=e

  var elms = document.querySelectorAll("[id='fee']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=f

  var elms = document.querySelectorAll("[id='state']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=g

}


</script>