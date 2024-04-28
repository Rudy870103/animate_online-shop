<?php
$order = $Orders->find($_GET['id']);
$order['product'] = unserialize($order['product']);
?>
<h1>訂單內容<span style="display: block;font-size:16px;margin-top:10px">訂單編號:<?= $order['no']; ?></span></h1>

<div>
    <div>收件人:<?= $order['name']; ?></div>
    <div>電話:<?= $order['tel']; ?></div>
    <div>信箱:<?= $order['email']; ?></div>
    <div>地址:<?= $order['addr']; ?></div>
    <div>訂購日期:<?= $order['orderdate']; ?></div>
    <div>
        <?php
        foreach ($order['product'] as $id => $total) {
            $row = $Product->find($id);
        ?>
            <div><img src="./img/<?= $row['img']; ?>" style="width: 100px;"></div>
            <div><?= $row['name']; ?></div>
            <div><?= $row['price']; ?></div>
            <div><?= $total; ?></div>
            <div><?= $row['price'] * $total; ?></div>
        <?php } ?>
        <div><?= $order['total']; ?></div>
    </div>
    <div><button onclick="location.href='?do=order'">確定</button></div>
</div>