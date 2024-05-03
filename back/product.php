<style>
    .member {
        width: 80%;
    }

    tr {
        border: 1px solid black;
    }

    td, th {
        height: 50px;
        padding: 5px;
    }
</style>
<h1>商品管理<span style="display: block;font-size:16px;margin-top:10px">Product</span></h1>


<div style="width: 80%;margin:auto;">
    <div class="product">
        <button class="myBtn mb-2" onclick="location.href='?do=add_product'">+新增商品</button>
        <div style="display: block;float:right">請輸入商品編號 : <input type="text" name="search" id="search"></div>
        <table class="text-center allItem" style="width:100%">
            <tr>
                <th class="color">商品編號</th>
                <th>商品圖片</th>
                <th class="color">商品名稱</th>
                <th>庫存</th>
                <th class="color">規格</th>
                <th>操作</th>
            </tr>
            <?php
            $rows = $Product->all(" order by `rank` desc");
            foreach ($rows as $idx => $row) {
            ?>
                <tr>
                    <td class="color"><?= $row['no']; ?></td>
                    <td><img src="../img/<?= $row['img']; ?>" style="width: 100px;"></td>
                    <td class="color"><?= $row['name']; ?></td>
                    <td><?= $row['stock']; ?></td>
                    <td class="color"><?= $row['spec']; ?></td>
                    <td>
                        <button class="myBtn" onclick="location.href='?do=edit_product&id=<?=$row['id'];?>'">編輯</button>
                        <button class='show-btn login-btn showBtn' data-id="<?= $row['id']; ?>"><?= ($row['sh'] == 1) ? '下架' : '上架'; ?></button>
                        <button class="del-product delBtn" data-id="<?= $row['id']; ?>">刪除</button>
                        <button class='sw-btn login-btn' data-id="<?= $row['id']; ?>" data-sw="<?= ($idx !== 0) ? $rows[$idx - 1]['id'] : $row['id']; ?>">前移
                        </button>
                        <button class='sw-btn login-btn' data-id="<?= $row['id']; ?>" data-sw="<?= ((count($rows) - 1) != $idx) ? $rows[$idx + 1]['id'] : $row['id']; ?>">後移
                        </button>
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
            location.reload()
        })
    })

    $(".sw-btn").on("click", function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = 'product'
        $.post("./api/sw.php", {
            id,
            sw,
            table
        }, () => {
            location.reload()
        })
    })

    $("input[name='search']").on('change', function() {
        searchItem();
    });

    function searchItem(){
        let value=$("#search").val();

        $.ajax({
            url:"./api/search_item.php",
            method:"GET",
            data: {no:value},
            success: function(res){
                $(".allItem").html(res);
            }
        })
    }
</script>