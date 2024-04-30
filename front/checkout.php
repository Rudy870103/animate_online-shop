<h1>結帳頁<span style="display: block;font-size:16px;margin-top:10px">Checkout</span></h1>
<form action="./api/checkout.php" method="post">
    <?php
    $buyer = $Member->find(['acc' => $_SESSION['member']]);
    ?>
    <div class="mx-auto border p-3 mb-3" style="width: 50%;">
        <div class="text-center mb-3" style="font-size: 20px;font-weight:bold;color:#218500">收件人資料</div>
        <hr>
        <table style="width: 100%;">
            <tr>
                <td style="width: 40%;text-align:end">
                    姓名 | &nbsp;
                </td>
                <td>
                    <input type="text" name="name" value="<?= $buyer['name']; ?>">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;text-align:end">
                    電話 | &nbsp;
                </td>
                <td>
                    <input type="number" name="tel" value="<?= $buyer['tel']; ?>">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;text-align:end">
                    信箱 | &nbsp;
                </td>
                <td>
                    <input type="text" name="email" value="<?= $buyer['email']; ?>">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;text-align:end">
                    地址 | &nbsp;
                </td>
                <td>
                    <input type="text" name="addr" value="<?= $buyer['addr']; ?>">
                </td>
            </tr>
        </table>
    </div>

    <div class="mx-auto border p-3" style="width: 50%;">
        <div class="text-center" style="font-size: 20px;font-weight:bold;color:#218500">購物車明細</div>
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
            $sum = 0;
            foreach ($_SESSION['cart'] as $id => $total) {
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
                $sum += $row['price'] * $total;
            }
            ?>
        </table>
        <hr>
        <div style="text-align: end;">總額 <span style="font-weight:bold;color:red">NT$<?= $sum; ?></span></div>
    </div>

    <div class="mt-2 mx-auto d-flex justify-content-between" style="width: 50%;">
        <input type="hidden" name="total" value="<?= $sum; ?>">
        <div><input class="showBtn" type="button" value="返回修改訂單" onclick="location.href='?do=buycart'"></div>
        <div><input class="myBtn" type="submit" value="送出訂單"></div>
    </div>
</form>