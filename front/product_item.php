<?php
$item = $Product->find($_GET['id']);
?>
<style>
    .less {
        color: #218500;
    }

    .less:hover {
        background-color: #aae796;
    }

    .more {
        color: red;
    }

    .more:hover {
        background-color: #ff9595;
    }

    .less,
    .more {
        cursor: pointer;
    }
</style>
<div class="d-flex mt-5 mx-auto" style="width: 80%;">
    <div class="mx-auto" style="width: 40%;overflow:hidden">
        <img src="./img/<?= $item['img']; ?>" style="width: 100%;">
    </div>
    <div class="mx-auto" style="width: 40%;">
        <div class="mb-3" style="font-size: 25px;font-weight:bold">
            <?= $item['name']; ?>
        </div>
        <div class="mb-5" style="font-size: 28px;font-weight:bold;color:#218500">NT$<?= number_format($item['price']); ?></div>
        <div>
            <div>數量</div>
            <div class="mb-3 d-flex border" style="width:200px">
                <div><input style="width:50px;font-size:20px;height:50px;border:none" type="button" class="less text-center" value="-"></div>
                <div><input style="width:100px;font-size:20px;text-align:center;height:50px;border:none" type="text" name="total" id="total" value="1" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal()"></div>
                <div><input style="width:50px;font-size:20px;height:50px;border:none" type="button" class="more text-center" value="+"></div>
            </div>
            <div>
                <input class="buyBtn2 mb-1" style="width: 100%;" type="button" onclick="fast_buycart(<?= $item['id']; ?>)" value="加入購物車">
                <input class="buyBtn" style="width: 100%;" type="button" value="立即結帳" onclick="buycart(<?= $item['id']; ?>)">
            </div>
        </div>
        <hr>
        <div class="mb-3" style="font-weight: bold;">商品介紹</div>
        <ul>
            <li>
                <div class="mb-2">商品編號 : <?= $item['no']; ?></div>
            </li>
            <li>
                <div class="mb-2">規格 : <?= $item['spec']; ?></div>
            </li>
            <li>
                <div class="mb-2"><?= $item['intro']; ?></div>
            </li>
        </ul>
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
        if (!isset($_SESSION['member'])) {
            echo "location.href = '?do=login'";
        } else {
        ?>
            location.href = `?do=buycart&id=${id}&total=${total}`;
        <?php } ?>
    }

    function fast_buycart(id) {
        let total = $("#total").val();
        <?php
        if (!isset($_SESSION['member'])) {
            echo "location.href = '?do=login'";
        } else {
        ?>
            $.post("./api/fast_buycart.php", {
                id,
                total
            }, () => {
                location.reload();
            });
        <?php } ?>
    }
</script>