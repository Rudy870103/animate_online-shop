<style>
    .member {
        width: 80%;
    }

    tr {
        border: 1px solid black;
    }

    td {
        height: 50px;
    }
</style>
<h1>商品管理<span style="display: block;font-size:16px;margin-top:10px">Product</span></h1>


<div style="width: 80%;margin:auto;">
<div class="product">
                <button onclick="location.href='?do=add_product'">新增商品</button>
                <table>
                    <tr>
                        <td>編號</td>
                        <td>商品圖片</td>
                        <td>商品名稱</td>
                        <td>庫存</td>
                        <td>規格</td>
                        <td>操作</td>
                    </tr>
                    <?php
                    $rows = $Product->all(" order by `rank` desc");
                    foreach ($rows as $idx => $row) {
                    ?>
                        <tr>
                            <td><?= $row['no']; ?></td>
                            <td><img src="../img/<?= $row['img']; ?>" style="width: 100px;"></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['stock']; ?></td>
                            <td><?= $row['spec']; ?></td>
                            <td>
                                <button>修改</button>
                                <button class="del-product" data-id="<?= $row['id']; ?>">刪除</button>
                                <button class='show-btn login-btn' data-id="<?= $row['id']; ?>"><?= ($row['sh'] == 1) ? '下架' : '上架'; ?></button>
                                <button>前移</button>
                                <button>後移</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
</div>


<script>
    getTypes('big')

    function getTypes(type, big_id = 0) {
        $.get("./api/get_types.php", {
            type,
            big_id
        }, (types) => {
            $(`#${type}s`).html(types)
        })
    }

    

    function sw(id, sh) {
        $.post("./api/product_sw.php", {
            id,
            sh
        }, () => {
            location.reload();
        })
    }


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
            table:'Product',id
        }, () => {
            location.reload()
        })
    })
</script>