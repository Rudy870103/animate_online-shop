<h1>新增輪播圖<span style="display: block;font-size:16px;margin-top:10px">Carousel</span></h1>
<form action="../api/save_carousel.php" method="post" enctype="multipart/form-data">
    <div class="p-2 col-4 box mx-auto">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: end;height:50px;width:50%">輪播圖</td>
                <td><input type="file" name="img" id="img"></td>
            </tr>
            <tr>
                <td style="text-align: end;height:50px;width:50%">連結</td>
                <td><input type="text" name="link" id="link"></td>
            </tr>
        </table>
    
        <div class="mt-3 text-center">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </div>
</form>