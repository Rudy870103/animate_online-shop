<?php
$mem=$Member->find($_GET['id']);
?>
<h1>會員修改<span style="display: block;font-size:16px;margin-top:10px">Edit</span></h1>
<form action="../api/save_mem.php" method="post">
    <div class="p-5 col-4 box mx-auto text-center">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: end;height:50px">帳號 |</td>
                <td><input type="text" name="acc" value="<?=$mem['acc'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">密碼 |</td>
                <td><input type="text" name="pw" value="<?=$mem['pw'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">姓名 |</td>
                <td><input type="text" name="name" value="<?=$mem['name'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">手機 |</td>
                <td><input type="text" name="tel" value="<?=$mem['tel'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">地址 |</td>
                <td><input type="text" name="addr" value="<?=$mem['addr'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">信箱 |</td>
                <td><input type="text" name="email" value="<?=$mem['email'];?>"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px">註冊日期 |</td>
                <td><input type="text" name="regdate" value="<?=$mem['regdate'];?>" readonly></td>
            </tr>
        </table>
    
        <div class="mt-3">
            <input type="hidden" name="id" value="<?=$mem['id'];?>">
            <input type="submit" value="修改">
            <input type="reset" value="重置">
        </div>
    </div>
</form>