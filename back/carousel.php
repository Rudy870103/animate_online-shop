<style>
    .member {
        width: 80%;
    }

    table {
        width: 100%;
    }

    tr {
        border: 1px solid black;
    }

    td {
        height: 50px;
    }
</style>
<h1>輪播圖管理<span style="display: block;font-size:16px;margin-top:10px">Carousel</span></h1>
<div>
    <button onclick="location.href='?do=add_carousel'">新增輪播圖</button>
</div>
<div class="p-5 mx-auto text-center member">
    <table class="box">
        <tr>
            <th>輪播圖</th>
            <th>連結</th>
            <th>操作</th>
        </tr>
        <?php
        $rows = $Carousel->all(" order by `rank` desc");
        foreach ($rows as $idx => $row) {
        ?>
            <tr>
                <td><img src="../img/<?= $row['img']; ?>" style="width: 200px;"></td>
                <td><input type="text" name="link" value="<?= $row['link']; ?>"></td>
                <td>
                    <button class='show-btn login-btn' data-id="<?= $row['id']; ?>"><?= ($row['sh'] == 1) ? '隱蔵' : '顯示'; ?></button>
                    <button class="edit login-btn" onclick="location.href='?do=edit_carousel&id=<?=$row['id'];?>'">編輯</button>
                    <button class="del login-btn" data-id="<?= $row['id']; ?>">刪除</button>
                    <div class="mt-1">
                        <button class='sw-btn login-btn' data-id="<?= $row['id']; ?>" data-sw="<?= ($idx !== 0) ? $rows[$idx - 1]['id'] : $row['id']; ?>">前移
                        </button>
                        <button class='sw-btn login-btn' data-id="<?= $row['id']; ?>" data-sw="<?= ((count($rows) - 1) != $idx) ? $rows[$idx + 1]['id'] : $row['id']; ?>">後移
                        </button>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    $(".show-btn").on("click", function() {
        let id = $(this).data('id');
        $.post("./api/show.php", {
            id
        }, () => {
            location.reload()
        })
    })


    $(".del").on("click", function() {
        if (confirm("確定刪除該輪播圖?")) {
            $.post("./api/del.php", {
                table: 'Carousel',
                id: $(this).data('id')
            }, () => {
                location.reload();
            })
        }
    })

    $(".sw-btn").on("click", function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = 'carousel'
        $.post("./api/sw.php", {
            id,
            sw,
            table
        }, () => {
            location.reload()
        })
    })
</script>