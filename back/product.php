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
<div class="types">
    商品分類
    <div>
        新增大分類
        <input type="text" name="big" id="big">
        <button onclick="addType('big')">新增</button>
    </div>
    <div>
        新增中分類
        <select name="bigs" id="bigs"></select>
        <input type="text" name="mid" id="mid">
        <button onclick="addType('mid')">新增</button>
    </div>
</div>

<div class="types-items">
    <table>
        <?php
        $bigs = $Type->all(['big_id' => 0]);
        foreach ($bigs as $big) {
        ?>
            <tr>
                <td><?= $big['name']; ?></td>
                <td>
                    <button onclick="edit(this,<?= $big['id']; ?>)">編輯</button>
                    <button class="del" data-id="<?=$big['id'];?>">刪除</button>
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
                            <button onclick="edit(this,<?= $big['id']; ?>)">編輯</button>
                            <button class="del" data-id="<?=$mid['id'];?>">刪除</button>
                        </td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </table>
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

    function edit(dom,id){
        let text=$(dom).parent().prev().text();
        let name=prompt("請輸入要修改的類別名稱",text);

        if(name!=null){
            $.post("./api/save_type.php",{name,id},()=>{
                $(dom).parent().prev().text(name);
            })
        }
    }

    $(".del").on("click", function() {
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