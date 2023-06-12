<!-- Announcement -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">公告資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addAnnouncementModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">標題</th>
              <th scope="col">內容</th>
              <th scope="col">帳號</th>
              <th scope="col">時間</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              $result = announcement_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['announcement_id'];
                  $title = $info['title'];
                  $content = $info['content'];
                  $account = $info['account'];
                  $datetime = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $title . "</td>".
                    "<td>" . $content . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $datetime . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateAnnouncementModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteAnnouncementModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateAnnouncementModal$id' tabindex='-1' aria-labelledby='updateAnnouncementModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/announcement_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateAnnouncementModalLabel'>修改公告</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='announcement_id' class='form-control' />
                            <label class='form-label'>公告編號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$title' required type='text' name='title' class='form-control' />
                            <label class='form-label'>內容</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$content' required type='text' name='content' class='form-control' />
                            <label class='form-label'>內容</label>
                          </div>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
                      </div>
                    </div>
                    </form>
                    </div>
                  </div>";
                  

                  // Delete  Modal
                  echo "
                  <div class='modal fade' id='deleteAnnouncementModal$id' tabindex='-1' aria-labelledby='deleteAnnouncementModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/announcement_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteAnnouncementModalLabel'>刪除公告</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此公告嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='announcement_id' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";
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
<div class='modal fade' id='addAnnouncementModal' tabindex='-1' aria-labelledby='addAnnouncementModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>新增公告</h5>
      </div>
      <form method='post' action='./controller/announcement_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='account' required>
              <option value=''>帳號</option>
              <?php
                $res = system_admin_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['account'].">".$info['account']."</option>";
                  }
                }
              ?>
            </select>
            <div class='form-outline mb-4'>
              <input required type='text' name='title' class='form-control' />
              <label class='form-label'>標題</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='content' class='form-control' />
              <label class='form-label'>內容</label>
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

