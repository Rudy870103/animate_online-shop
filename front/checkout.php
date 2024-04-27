<h1>結帳頁<span style="display: block;font-size:16px;margin-top:10px">Checkout</span></h1>
<form action="./api/checkout.php" method="post">
    <?php
    $buyer=$Member->find(['acc'=>$_SESSION['member']]);
    ?>
    <fieldset>
        <legend>收件人資料</legend>
        <table>
            <tr>
                <td>
                    <div>姓名</div>
                    <div><input type="text" name="name" value="<?=$buyer['name'];?>"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>電話</div>
                    <div><input type="number" name="tel" value="<?=$buyer['tel'];?>"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>信箱</div>
                    <div><input type="text" name="email" value="<?=$buyer['email'];?>"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>地址</div>
                    <div><input type="text" name="addr" value="<?=$buyer['addr'];?>"></div>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <fieldset>
        <legend>購物車明細</legend>
        <table>
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
            <tr>
                <td>總額<?= $sum; ?></td>
            </tr>
        </table>
    </fieldset>
    
    <div>
        <input type="hidden" name="total" value="<?=$sum;?>">
        <input type="submit" value="送出訂單">
        <input type="button" value="返回修改訂單" onclick="location.href='?do=buycart'">
    </div>
</form>