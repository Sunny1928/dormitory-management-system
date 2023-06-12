<!-- Room -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍房間資料</h4>
    <?php
    if( $_SESSION["permission"] == 0 )
      echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRoomModal'><i class='fa fa-add me-1'></i>新增</button>";
    ?>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">房號</th>
              <th scope="col">費用</th>
              <th scope="col">人數</th>
              <th scope="col">清潔狀態</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              $result = room_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['room_number'];
                  $fee = $info['fee'];
                  $num_of_people = $info['num_of_people'];
                  $clean_state = $info['clean_state'];
                  $dormitory_id = $info['dormitory_id'];
                  $dormitory_name = $info['name'];
                  
                  echo "<tr>" .
                    "<td>" . $dormitory_name . "</td>".
                    "<td>" . $id . "</td>".
                    "<td>" . $fee . "</td>".
                    "<td>" . $num_of_people . "</td>".
                    "<td class='".$state_classes_clean[$clean_state]."'>" . $clean_states[$clean_state] . "</td>";
                  if( $_SESSION["permission"] == 0 ){
                    echo "<td>
                      <button onclick=\"put_room('$dormitory_id','$dormitory_name','$id','$fee','$num_of_people','$clean_state')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRoomModal'><i class='fa fa-pencil'></i></button>
                      <button onclick=\"put_room('$dormitory_id','$dormitory_name','$id','$fee','$num_of_people','$clean_state')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRoomModal'><i class='fa fa-trash'></i></button>
                    </td>";
                  }else if($_SESSION["permission"] == 1){
                    echo "<td> <button "; if($clean_state != 0) echo " disabled ";
                    echo "onclick=\"put_room('$dormitory_id','$dormitory_name','$id','$fee','$num_of_people','1')\" class='message-btn btn ms-2 btn-outline-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#confirmRoomModal'><i class='fa fa-circle-info'></i></button></td>";
                  } 
                  echo  "</tr>";
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
<div class='modal fade' id='addRoomModal' tabindex='-1' aria-labelledby='addRoomModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/room_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='dormitory_id' required>
              <option value=''>宿舍大樓編號</option>
              <?php
                $res = dormitory_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['dormitor_id'].">".$info['name'].''."</option>";
                  }
                }
              ?>
            </select>
            <div class='form-outline mb-4'>
              <input required type='text' name='room_number' id='roomNumber' class='form-control' />
              <label class='form-label' for='roomNumber'>房號</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='fee' id='fee' class='form-control' />
              <label class='form-label' for='fee'>費用</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='num_of_people' id='numOfPeople' class='form-control' />
              <label class='form-label' for='numOfPeople'>人數</label>
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
<div class='modal fade' id='updateRoomModal' tabindex='-1' aria-labelledby='updateRoomModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/room_controller.php'>
    <div class='modal-header'>
      <h5 class='modal-title' id='updateRoomModalLabel'>修改宿舍</h5>
    </div>
    <div class='modal-body'>
      <div class='text-center mb-3'>
        <div class='form-outline mb-4'>
          <input id='dormitory_id' required type='hidden' name='dormitory_id' class='form-control' />
          <input id='dormitory_name' readonly required type='text' name='name' class='form-control' />
          <label class='form-label' >宿舍大樓編號</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='id' readonly required type='text' name='room_number' class='form-control' />
          <label class='form-label'>房號</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='fee' required type='text' name='fee' class='form-control' />
          <label class='form-label'>費用</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='num_of_people' required type='text' name='num_of_people' class='form-control' />
          <label class='form-label'>人數</label>
        </div>
        <select id='clean_state' class='form-select mb-4' name='clean_state' required>
          <option value=''>清潔狀態</option>";
          for($i = 0; $i<2; $i++){
            echo "<option value=$i"; if($clean_state ==$i) echo " selected"; echo ">".$clean_states[$i]."</option>";
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

<!-- Delete  Modal -->
<div class='modal fade' id='deleteRoomModal' tabindex='-1' aria-labelledby='deleteRoomModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
    <form method='post' action='./controller/room_controller.php'>
    <div class='modal-header'>
          <h5 class='modal-title' id='deleteRoomModalLabel'>刪除宿舍</h5>
        </div>
        <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
        <div class='modal-footer'>
          <input id='id' required type='hidden' name='room_number' class='form-control' />
          <input id='dormitory_id' required type='hidden' name='dormitory_id' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!-- Confirm Modal  -->
<div class='modal fade' id='confirmRoomModal' tabindex='-1' aria-labelledby='confirmRoomModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <form method='post' action='./controller/room_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='confirmRoomModalLabel'>房間清理</h5>
        </div>
        <div class='modal-body'>您確認清理完畢了嗎？</div>
        <div class='modal-footer'>
          <input id='dormitory_id'  required type='hidden' name='dormitory_id' class='form-control' />
          <input id='dormitory_name'  required type='hidden' name='dormitory_name' class='form-control' />
          <input id='id'  required type='hidden' name='room_number' class='form-control' />
          <input id='fee'  required type='hidden' name='fee' class='form-control' />
          <input id='num_of_people'  required type='hidden' name='num_of_people' class='form-control' />
          <input id='clean_state'  required type='hidden' name='clean_state' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function put_room(a, b, c, d, e, f){
  var elms = document.querySelectorAll("[id='dormitory_id']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='dormitory_name']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b

  var elms = document.querySelectorAll("[id='id']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=c

  var elms = document.querySelectorAll("[id='fee']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=d

  var elms = document.querySelectorAll("[id='num_of_people']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=e
  
  var elms = document.querySelectorAll("[id='clean_state']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=f
}
</script>