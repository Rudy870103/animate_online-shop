<style>
    .member{
        width: 80%;
    }
    table{
        width: 100%;
    }
    tr{
        border: 1px solid black;
    }
    td{
        height: 50px;
    }
</style>
<h1>會員管理<span style="display: block;font-size:16px;margin-top:10px">Member</span></h1>
<div class="p-5 mx-auto text-center member">
    <table class="box">
        <tr>
            <th>帳號</th>
            <th class="color">姓名</th>
            <th>電話</th>
            <th class="color">註冊日期</th>
            <th>操作</th>
        </tr>
        <?php
        $rows=$Member->all();
        foreach($rows as $row){
        ?>
        <tr>
            <td><?=$row['acc'];?></td>
            <td class="color"><?=$row['name'];?></td>
            <td><?=$row['tel'];?></td>
            <td class="color"><?=$row['regdate'];?></td>
            <td>
                <?php
                if($row['acc']=='admin'){
                ?>
                此為最高權限
                <?php
                }else{
                ?>
                <button class="myBtn" onclick="location.href='?do=edit_mem&id=<?=$row['id'];?>'">編輯</button>
                <button class="del delBtn" data-id="<?=$row['id'];?>">刪除</button>
                <?php } ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
  $(".del").on("click",function(){
    if(confirm("確定刪除該會員?")){
        $.post("./api/del.php",{table:'Member',id:$(this).data('id')},()=>{
            location.reload();
        })
    }
})
</script>