<?php
$order = $Orders->find($_GET['id']);
$order['product'] = unserialize($order['product']);
?>
<h1>訂單內容<span style="display: block;font-size:16px;margin-top:10px">訂單編號 : <?= $order['no']; ?></span></h1>

<div class="mx-auto border p-3" style="width: 30%;">
    <table class="mb-2">
        <tr>
            <td style="text-align: end;">收件人 |</td>
            <td><?= $order['name']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;">電話 |</td>
            <td><?= $order['tel']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;">信箱 |</td>
            <td><?= $order['email']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;">地址 |</td>
            <td><?= $order['addr']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;">訂購日期 |</td>
            <td><?= $order['orderdate']; ?></td>
        </tr>
    </table>

    <div>
        <?php
        foreach ($order['product'] as $id => $total) {
            $row = $Product->find($id);
        ?>
            <div class="d-flex border p-2">
                <div><img src="./img/<?= $row['img']; ?>" style="width: 100px;"></div>
                <div class="d-flex" style="flex-direction: column;justify-content:space-between">
                    <div>
                        <?= $row['name']; ?>
                    </div>
                    <div class="d-flex" style="justify-content:space-between;width:100%">
                        <div style="width: 90px;">$<?= $row['price']; ?></div>
                        <div style="width: 90px;"><?= $total; ?></div>
                        <div style="width: 90px;">$<?= $row['price'] * $total; ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="mt-3 p-2" style="text-align: end;">
        <div class="mb-2">總金額 <span style="color: red;font-weight:bold">$<?= $order['total']; ?></span></div>
        <div><button onclick="location.href='?do=order'">確定</button></div>
    </div>
</div>