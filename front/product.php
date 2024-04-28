<?php
$type = $_GET['type'];
if ($type != 0) {
    $t = $Type->find($type);
    if ($t['big_id'] == 0) {
        $products = $Product->all(['big' => $type, 'sh' => 1], " order by `rank` desc");
        $nav = $t['name'];
    } else {
        $products = $Product->all(['mid' => $type, 'sh' => 1], " order by `rank` desc");
        $nav = $Type->find($t['big_id'])['name'] . ">" . $t['name'];
    }
} else {
    $products = $Product->all(['sh' => 1], " order by `rank` desc");
    $nav = "全部商品";
}
?>
<style>
    .card:hover {
        box-shadow: 0px 0px 10px gray;
        cursor: pointer;
    }
</style>
<fieldset style="padding-top: 150px;">
    <legend><?= $nav; ?></legend>
    <div class="d-flex" style="gap: 1%;">
        <?php
        foreach ($products as $product) {
        ?>
            <div class="card" style="width: 18rem;position:relative;z-index:1">
                <img src="./img/<?= $product['img']; ?>" class="card-img-top" onclick="location.href='?do=product_item&id=<?= $product['id']; ?>'">
                <div class="card-body">
                    <div>名稱<?= $product['name']; ?></div>
                    <div>價格<?= $product['price']; ?></div>
                </div>
                <div style="position: absolute;bottom:10px;right:10px;font-size:20px;z-index:999;">
                    <a data-bs-toggle="modal" data-bs-target="#p<?= $product['no']; ?>">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </a>

                </div>
            </div>

            <!-- Modal -->
            <style>
                .modal-header {
                    border: none;
                }

                .content {
                    display: flex;
                    justify-content: space-between;
                    align-items: start;
                }

                .modal-body {
                    display: flex;
                }

                .text {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-around;
                }
            </style>
            <div class="modal fade" id="p<?= $product['no']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                    <div class="modal-content">
                        <div class="content">
                            <div class="modal-body">
                                <div style="width: auto;height:200px;overflow:hidden">
                                    <img src="./img/<?= $product['img']; ?>" class="card-img-top" style="height:100%;width:auto">
                                </div>
                                <div class="text mx-2">
                                    <div style="font-weight:bold">
                                        <?= $product['name']; ?>
                                    </div>
                                    <div style="font-weight:bold">
                                        <?= $product['price']; ?>
                                    </div>
                                </div>
                                <div>
                                    <input type="button" class="less" value="-">
                                    <input type="text" name="total" id="total" value="1" pattern="[0-9]*" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal()" style="width: 100px;">
                                    <input type="button" class="more" value="+">
                                </div>
                            </div>
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="fast_buycart(<?=$product['id'];?>)">加入購物車</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</fieldset>

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

    function fast_buycart(id) {
        let total = $("#total").val();
        <?php
        if(!isset($_SESSION['member'])){
            echo "location.href = '?do=login'";
        }else{
        ?>
        $.post("./api/fast_buycart.php",{id,total},()=>{
            location.reload();
        });
        <?php } ?>
    }
</script>