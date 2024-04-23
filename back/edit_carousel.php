<?php
$row=$Carousel->find($_GET['id']);
?>
<h1>修改輪播圖<span style="display: block;font-size:16px;margin-top:10px">Carousel</span></h1>
<form action="../api/save_carousel.php" method="post" enctype="multipart/form-data">
    <div class="p-2 col-4 box mx-auto">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: end;height:50px;width:50%">輪播圖</td>
                <td><input type="file" name="img" id="img"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px;width:50%">連結</td>
                <td><input type="text" name="link" value="<?=$row['link'];?>"></td>
            </tr>
        </table>
    
        <div class="mt-3 text-center">
            <input type="hidden" name="id" value="<?=$row['id'];?>">
            <input type="submit" value="修改">
            <input type="reset" value="重置">
        </div>
    </div>
</form>