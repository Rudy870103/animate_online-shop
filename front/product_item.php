<?php
$item = $Product->find($_GET['id']);
?>
<style>
    .less,
    .more {
        cursor: pointer;
    }

    .less:hover,
    .more:hover {
        box-shadow: 0px 0px 5px;
    }
</style>
<div class="row mt-5">
    <div class="col-6">
        <img src="./img/<?= $item['img']; ?>" alt="">
    </div>
    <div class="col-6">
        <div class="mb-2" style="font-size: 30px;font-weight:bold">
            <?= $item['name']; ?>
        </div>
        <div class="mb-2">NT$<?= $item['price']; ?></div>
        <div class="mb-2"><?= $item['spec']; ?></div>
        <div class="mb-2"><?= $item['intro']; ?></div>
    </div>
    <div>
        <div>
            <input type="button" class="less" value="-">
            <input type="text" name="total" id="total" value="1" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal()">
            <input type="button" class="more" value="+">
        </div>
        <div>
            <input type="button" value="加入購物車">
            <input type="button" value="立即結帳" onclick="buycart(<?= $item['id']; ?>)">
        </div>
    </div>
</div>

<script>
    let a = 1;
    $(".more").on("click", function() {
        if ((a + 1) <= 24) {
            a++;
            $("#total").val(a);
        } else {
            alert("本商品最多可購買24件");
        }
    })
    $(".less").on("click", function() {
        if ((a - 1 >= 1)) {
            a--;
            $("#total").val(a);
        }
    })

    function checkTotal() {
        if ($("#total").val() > 24 || $("#total").val() < 1) {
            $("#total").val(1);
        }
    }

    function buycart(id) {
        let total = $("#total").val();
        <?php
        if(!isset($_SESSION['member'])){
            echo "location.href = '?do=login'";
        }else{
        ?>
        location.href = `?do=buycart&id=${id}&total=${total}`;
        <?php } ?>
    }
</script>