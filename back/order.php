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
<h1>訂單管理<span style="display: block;font-size:16px;margin-top:10px">Order</span></h1>
<div class="p-5 mx-auto text-center member">
    <table class="box">
        <tr>
            <th class="color">訂單編號</th>
            <th>金額</th>
            <th class="color">會員帳號</th>
            <th>姓名</th>
            <th class="color">下單日期</th>
            <th>操作</th>
        </tr>
        <?php
        $rows=$Orders->all(" order by `id` desc");
        foreach($rows as $row){
        ?>
        <tr>
            <td class="color"><a href="?do=order_info&id=<?=$row['id'];?>"><?=$row['no'];?></a></td>
            <td><?=$row['total'];?></td>
            <td class="color"><?=$row['acc'];?></td>
            <td><?=$row['name'];?></td>
            <td class="color"><?=$row['orderdate'];?></td>
            <td>
                <button class="del delBtn" data-id="<?=$row['id'];?>">刪除</button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
  $(".del").on("click",function(){
    if(confirm("確定刪除該筆資料?")){
        $.post("./api/del.php",{table:'Orders',id:$(this).data('id')},()=>{
            location.reload();
        })
    }
})
</script>