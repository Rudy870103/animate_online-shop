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

<h1>商品分類管理<span style="display: block;font-size:16px;margin-top:10px">Type</span></h1>

<div class="types d-flex mx-auto justify-content-center p-5" style="width:50%">

    <div class="add-types border border-dark p-2" style="width: 50%;height:300px">
        <div class="text-center" style="font-weight:bold">商品分類</div>
        <div>
            <div>新增大分類</div>
            <div>
                <input type="text" name="big" id="big">
                <button class="myBtn" onclick="addType('big')">新增</button>
            </div>
        </div>
        <hr>
        <div>
            <div>新增中分類</div>
            <div><select name="bigs" id="bigs"></select></div>
            <div>
                <input type="text" name="mid" id="mid">
                <button class="myBtn" onclick="addType('mid')">新增</button>
            </div>
        </div>
    </div>

    <div class="types-items" style="width: 50%;">
        <table class="text-center" style="width: 100%;">
            <?php
            $bigs = $Type->all(['big_id' => 0]);
            foreach ($bigs as $big) {
            ?>
                <tr style="background-color: #ff8f00;color:#ffff">
                    <td style="font-weight: bold;"><?= $big['name']; ?></td>
                    <td>
                        <button class="myBtn" onclick="edit(this,<?= $big['id']; ?>)">編輯</button>
                        <button class="del-type delBtn" data-id="<?= $big['id']; ?>">刪除</button>
                    </td>
                </tr>
                <?php
                if ($Type->count(['big_id' => $big['id']]) > 0) {
                    $mids = $Type->all(['big_id' => $big['id']]);
                    foreach ($mids as $mid) {
                ?>
                        <tr>
                            <td><?= $mid['name']; ?></td>
                            <td>
                                <button class="myBtn" onclick="edit(this,<?= $mid['id']; ?>)">編輯</button>
                                <button class="del-type delBtn" data-id="<?= $mid['id']; ?>">刪除</button>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
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

    function addType(type) {
        let data = {};

        switch (type) {
            case "big":
                data = {
                    name: $(`#${type}`).val(),
                    big_id: 0
                }
                break;
            case "mid":
                data = {
                    name: $(`#${type}`).val(),
                    big_id: $("#bigs").val()
                }
                break;
        }

        $.post("./api/save_type.php", data, () => {
            location.reload();
        })

    }

    function edit(dom, id) {
        let text = $(dom).parent().prev().text();
        let name = prompt("請輸入要修改的類別名稱", text);

        if (name != null) {
            $.post("./api/save_type.php", {
                name,
                id
            }, () => {
                $(dom).parent().prev().text(name);
            })
        }
    }



    $(".del-type").on("click", function() {
        if (confirm("確定刪除該類別?")) {
            $.post("./api/del.php", {
                table: 'Type',
                id: $(this).data('id')
            }, () => {
                location.reload();
            })
        }
    })
</script>