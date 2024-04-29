<?php
$product = $Product->find($_GET['id']);
?>
<style>
    td.title {
        text-align: end;
        height: 50px;
    }
</style>

<h1>商品修改<span style="display: block;font-size:16px;margin-top:10px">Product</span></h1>
<form action="../api/save_product.php" method="post" enctype="multipart/form-data">
    <div class="p-2 col-6 box mx-auto">
        <table style="width: 100%;">
            <tr>
                <td class="title">商品編號 |</td>
                <td class="px-2"><span class="p-2" style="background-color: yellow"><?=$product['no'];?></span></td>
            </tr>
            <tr>
                <td class="title">所屬大分類 |</td>
                <td class="px-2"><select name="big" id="big"></select></td>
            </tr>
            <tr>
                <td class="title">所屬中分類 |</td>
                <td class="px-2"><select name="mid" id="mid"></select></td>
            </tr>
            <tr>
                <td class="title">商品名稱 |</td>
                <td class="px-2"><input type="text" name="name" value="<?= $product['name']; ?>"></td>
            </tr>
            <tr>
                <td class="title">價格 |</td>
                <td class="px-2"><input type="text" name="price" value="<?= $product['price']; ?>"></td>
            </tr>
            <tr>
                <td class="title">規格 |</td>
                <td class="px-2"><input type="text" name="spec" value="<?= $product['spec']; ?>"></td>
            </tr>
            <tr>
                <td class="title">庫存 |</td>
                <td class="px-2"><input type="text" name="stock" value="<?= $product['stock']; ?>"></td>
            </tr>
            <tr>
                <td class="title">商品簡介 |</td>
                <td class="px-2"><textarea name="intro" id="intro" style="width:60%;height:80px"><?= $product['intro']; ?></textarea></td>
            </tr>
            <tr>
                <td class="title">商品圖片 |</td>
                <td class="px-2"><input type="file" name="img" id="img"></td>
            </tr>
        </table>

        <div class="mt-3 text-center">
            <input type="hidden" name="id" value="<?=$product['id'];?>">
            <input type="submit" value="修改">
            <input type="reset" value="重置">
        </div>
    </div>
</form>

<script>
    getTypes('big', 0);

    $("#big").on("change", function() {
        getTypes('mid', $("#big").val());
    })

    function getTypes(type, big_id) {
        $.post("./api/get_types.php", {
            type,
            big_id
        }, (types) => {
            $(`#${type}`).html(types);

            if (type == 'big') {
                // 載入此商品原本的大分類
                $("#big option[value='<?=$product['big'];?>']").prop('selected',true);
                getTypes('mid', $("#big").val());
            }else{
                // 載入此商品原本的中分類
                $("#mid option[value='<?=$product['mid'];?>']").prop('selected',true);
            }
        })
    }
</script>