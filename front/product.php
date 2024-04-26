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
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </a>

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 30vh;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">加入購物車</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</fieldset>