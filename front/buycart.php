<?php
if (isset($_GET['id']) && isset($_GET['total'])) {
    $_SESSION['cart'][$_GET['id']] = $_GET['total'];
}

if (empty($_SESSION['cart'])) {
    echo "<h3>購物車目前是空的</h3>";
} else {
?>
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
                    border: 1px solid gray;
                }
            </style>
            <div class="row mt-5 buycart-item">
                <div class="col">
                    <img src="./img/<?= $item['img']; ?>" style="width: 200px;">
                </div>
                <div class="col">
                    <div><?= $item['name']; ?></div>
                    <div class="item-price<?= $item['id']; ?>"><?= $item['price'] * $total; ?></div>
                    <input type="hidden" name="price<?= $item['id']; ?>" id="price<?= $item['id']; ?>" value="<?= $item['price']; ?>">
                    <input type="hidden" name="id[]" value="<?=$item['id'];?>">
                </div>
                <div class="col">
                    <input type="button" class="less" value="-" data-id="<?= $item['id']; ?>">
                    <input type="text" name="total<?= $item['id']; ?>" id="total<?= $item['id']; ?>" value="<?= $total; ?>" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal(<?= $item['id']; ?>)">
                    <input type="button" class="more" value="+" data-id="<?= $item['id']; ?>">
                </div>
                <div class="col close">
                    <i class="fa-solid fa-xmark fa-fw" onclick="removeItem(<?= $item['id']; ?>)"></i>
                </div>
            </div>
        <?php
        } ?>
        <div class="row col-3">
            <input type="button" onclick="location.href='index.php'" value="繼續選購">
            <input type="submit" value="前往結帳">
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