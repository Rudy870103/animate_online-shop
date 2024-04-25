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
            <div class="card" style="width: 18rem;" onclick="location.href='?do=product_item&id=<?= $product['id']; ?>'">
                <img src="./img/<?= $product['img']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div>名稱<?= $product['name']; ?></div>
                    <div>價格<?= $product['price']; ?></div>
                </div>
            </div>
        <?php } ?>

    </div>
</fieldset>