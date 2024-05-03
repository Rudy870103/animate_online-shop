<?php include_once "db.php";
$row = $Product->find(['no' => $_GET['no']]);
if (empty($row)) {
    echo "查無此商品";
} else {

?>
    <table class="text-center" style="width:100%">
        <tr>
            <th class="color">商品編號</th>
            <th>商品圖片</th>
            <th class="color">商品名稱</th>
            <th>庫存</th>
            <th class="color">規格</th>
            <th>操作</th>
        </tr>
        <tr>
            <td class="color"><?= $row['no']; ?></td>
            <td><img src="../img/<?= $row['img']; ?>" style="width: 100px;"></td>
            <td class="color"><?= $row['name']; ?></td>
            <td><?= $row['stock']; ?></td>
            <td class="color"><?= $row['spec']; ?></td>
            <td>
                <button class="myBtn" onclick="location.href='?do=edit_product&id=<?= $row['id']; ?>'">編輯</button>
                <button class='show-btn login-btn showBtn' data-id="<?= $row['id']; ?>"><?= ($row['sh'] == 1) ? '下架' : '上架'; ?></button>
                <button class="del-product delBtn" data-id="<?= $row['id']; ?>">刪除</button>
                </button>
            </td>
        </tr>
    </table>
<?php } ?>

<script>
    $(".del-product").on("click", function() {
        if (confirm("確定刪除該商品?")) {
            $.post("./api/del.php", {
                table: 'Product',
                id: $(this).data('id')
            }, () => {
                location.reload();
            })
        }
    })

    $(".show-btn").on("click", function() {
        let id = $(this).data('id');
        $.post("./api/show.php", {
            table: 'Product',
            id
        }, () => {
            $(this).text(($(this).text() == '下架') ? "上架" : "下架");
        })
    })
</script>