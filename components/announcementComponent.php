<?php
  session_start();
?>

<!--Title-->
<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
    <h4 class="mb-0">公告</h4>
    <?php 
        if($_SESSION["permission"] == 1 || $_SESSION["permission"] ==0){
            echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addNewsModal'><i class='fa fa-add me-1'></i> 新增</button>";
        }
    ?>
    </div>
</div>

<!-- 顯示所有公告顯示 -->
<?php
    $result = announcement_read_all($conn);
    
    while($info=mysqli_fetch_array($result)){
        
        $id = $info['announcement_id'];
        $title = $info['title'];
        $content = $info['content'];
        $account = $info['account'];
        $date = mb_split(" ",$info['datetime']);
        $time = mb_split(":",$date[1]);
        
        echo "
        <div class='card m-2'>
            <div class='card-header'>$date[0] $time[0]:$time[1]</div>
                <div class='card-body'>
                    <h5>$title</h5>
                    <p>$content</p>";
                    # 判斷是不是本人和身分是否為學生 , 都符合的人不能編輯其他使用者的公告
                    if($_SESSION["permission"] == 1 || $_SESSION["permission"] ==0){
                        echo "<div class='d-flex'>
                                <button type='button' class='btn btn-tertiary me-2' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateNewsModal$id'>編輯</button>
                                <button type='button' class='btn btn-tertiary' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteNewsModal$id'>刪除</button>
                            </div>";
                    }
                echo "</div>
        </div>";

        // Update News Modal
        echo "
            <div class='modal fade' id='updateNewsModal$id' tabindex='-1' aria-labelledby='updateNewsModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>

                <form method='post' action='./controller/announcement_controller.php'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='updateNewsModalLabel'>修改公告</h5>
                </div>
                <div class='modal-body'>
                    <div class='form-outline mb-2'>
                        <input value='$title' required type='text' name='title' class='form-control' />
                        <label class='form-label'>標題</label>
                    </div>
                    <div class='form-outline'>
                    <textarea name='content' class='form-control border'  rows='4' required>$content</textarea>
                    <!-- <label class='form-label'>内容</label> -->
                    <input type='hidden' name='account' value='$account'>
                    <input type='hidden' name='announcement_id' value='$id'>
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

            
            // Delete News Modal
            echo "
            <div class='modal fade' id='deleteNewsModal$id' tabindex='-1' aria-labelledby='deleteNewsModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' id='deleteNewsModalLabel'>刪除公告</h5>
                    </div>
                    <div class='modal-body'>您確認要刪除公告嗎？</div>
                    <div class='modal-footer'>
                        <form method='post' action='./controller/announcement_controller.php'>
                            <input type='hidden' name='announcement_id' value='$id'>
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>";
    };?>
<!-- Add News Modal -->
<div class='modal fade' id='addNewsModal' tabindex='-1' aria-labelledby='addNewsModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='addNewsModalLabel'>新增公告</h5>
                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
            </div>
            <form method='post' action="./controller/announcement_controller.php">
                <div class='modal-body'>
                    <div class='form-outline mb-2'>
                        <input required type='text' name='title' class='form-control' />
                        <label class='form-label'>標題</label>
                    </div>
                    <div class='form-outline'>
                        <textarea name='content' class='form-control border' rows='4'
                            required></textarea>
                        <label class='form-label'>内容</label>
                    </div>
                    <input name="account" value='<?php echo $_SESSION['account'] ?>' type="hidden" >
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                    <button type='submit' class='btn btn-primary' name='create' value='create'>確認</button>
                </div>
            </form>
        </div>
    </div>
</div>