<?php
if (isset($_GET['id']) && isset($_GET['total'])) {
    $_SESSION['cart'][$_GET['id']] = $_GET['total'];
}

if (empty($_SESSION['cart'])) {
    echo "<h3>購物車目前是空的</h3>";
} else {
?>
    <h1>購物車<span style="display: block;font-size:16px;margin-top:10px">Cart</span></h1>

    <form action="./api/buycart.php" method="post">
        <?php
        foreach ($_SESSION['cart'] as $id => $total) {
            $item = $Product->find($id);
        ?>
            <style>
                .close i {
                    cursor: pointer;
                }

                .buycart-item {
                    width: 50%;
                    border-radius: 10px;
                    box-shadow: 0px 0px 3px gray;
                }
            </style>
            <div class="mt-2 buycart-item mx-auto p-2 d-flex">
                <div>
                    <img src="./img/<?= $item['img']; ?>" style="width: 150px;margin-right:10px">
                </div>
                <div class="d-flex" style="flex-direction: column;justify-content:space-between;width:100%;">
                    <div class="d-flex" style="justify-content:space-between;font-weight:bold">
                        <div><?= $item['name']; ?> NT$<?= $item['price']; ?></div>
                        <div class="close">
                            <i class="fa-solid fa-xmark fa-fw" onclick="removeItem(<?= $item['id']; ?>)"></i>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content:space-between">
                        <div class="item-price<?= $item['id']; ?>" style="font-weight:bold;color:#218500">NT$<?= $item['price'] * $total; ?></div>
                        <div>
                            <input type="button" class="less" value="-" data-id="<?= $item['id']; ?>">
                            <input type="text" name="total<?= $item['id']; ?>" id="total<?= $item['id']; ?>" value="<?= $total; ?>" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal(<?= $item['id']; ?>)">
                            <input type="button" class="more" value="+" data-id="<?= $item['id']; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="price<?= $item['id']; ?>" id="price<?= $item['id']; ?>" value="<?= $item['price']; ?>">
                    <input type="hidden" name="id[]" value="<?= $item['id']; ?>">
                </div>
            </div>
        <?php
        } ?>
        <div class="mx-auto mt-2" style="width: 50%;text-align:end;font-size:20px">
            <input class="showBtn p-2" type="button" onclick="location.href='index.php'" value="繼續選購">
            <input class="myBtn p-2" type="submit" value="前往結帳">
        </div>
    </form>
<?php } ?>

<script>
    $(".more").on("click", function() {
        let id = $(this).data("id");
        let input = $("#total" + id);
        let value = parseInt(input.val());
        let price = parseInt($("#price" + id).val());
        if ((value + 1) <= 24) {
            input.val(value + 1);
            $(".item-price" + id).text(price * parseInt(value + 1));
        } else {
            alert("本商品最多可購買24件");
        }
    });

    $(".less").on("click", function() {
        let id = $(this).data("id");
        let input = $("#total" + id);
        let value = parseInt(input.val());
        let price = parseInt($("#price" + id).val());

        if ((value - 1 >= 1)) {

            input.val(value - 1);
            $(".item-price" + id).text(price * parseInt(value - 1));

        }
    });

    function checkTotal(id) {
        let input = $("#total" + id);
        let value = parseInt(input.val());
        if (value > 24 || value < 1) {
            input.val(1);
        }
    }

    function updateTotal() {
        let id = $(this).data("id");
        let input = $("#total" + id);
        let value = parseInt(input.val());
    }

    function removeItem(id) {
        $.post("./api/del_item.php", {
            id
        }, function() {
            location.href = 'index.php?do=buycart';
        })
    }
</script>