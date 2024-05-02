<?php
$order = $Orders->find($_GET['id']);
$order['product'] = unserialize($order['product']);
?>
<h1>訂單內容<span style="display: block;font-size:16px;margin-top:10px">訂單編號 : <?= $order['no']; ?></span></h1>

<div class="mb-3 mx-auto border p-3" style="width: 50%;">
    <div class="text-center mb-3" style="font-size: 20px;font-weight:bold;color:#218500">收件人資料</div>
    <hr>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: end;width:50%">收件人 |&nbsp;</td>
            <td><?= $order['name']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;width:50%">電話 |&nbsp;</td>
            <td><?= $order['tel']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;width:50%">信箱 |&nbsp;</td>
            <td><?= $order['email']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;width:50%">地址 |&nbsp;</td>
            <td><?= $order['addr']; ?></td>
        </tr>
        <tr>
            <td style="text-align: end;width:50%">訂購日期 |&nbsp;</td>
            <td><?= $order['orderdate']; ?></td>
        </tr>
    </table>
</div>
<div class="mx-auto border p-3" style="width: 50%;">
    <div class="text-center" style="font-size: 20px;font-weight:bold;color:#218500">購物明細</div>
    <hr>
    <table class="text-center mt-3" style="width: 100%;">
        <tr>
            <th style="width: 20%;"></th>
            <th>品名</th>
            <th>單價</th>
            <th>數量</th>
            <th>小計</th>
        </tr>
        <?php
        foreach ($order['product'] as $id => $total) {
            $row = $Product->find($id);
        ?>
            <tr>
                <td><img src="./img/<?= $row['img']; ?>" style="width: 100px;"></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['price']; ?></td>
                <td><?= $total; ?></td>
                <td><?= $row['price'] * $total; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <hr>
    <div style="text-align: end;">總額 <span style="font-weight:bold;color:red">NT$<?= $order['total']; ?></span></div>
</div>

<div class="text-center mt-3">
    <button class="myBtn" onclick="location.href='?do=member'">確定</button>
</div>