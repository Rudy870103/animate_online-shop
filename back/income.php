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
<h1>營收統計<span style="display: block;font-size:16px;margin-top:10px">Income</span></h1>
<div class="p-5 mx-auto text-center member">
    <table class="box">
        <tr>
            <th>月份</th>
            <th class="color">月營收</th>
            <th>上個月增減(%)</th>
            <th class="color">總營收</th>
        </tr>
        <?php
        $monthSum = 0;
        $totalSum = 0;
        $prevSum=0;
        for ($m = 1; $m <= 12; $m++) {
            $rows = $Orders->q("select * from `orders` where MONTH(orderdate)=$m"); //叫出每個月的所有訂單
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $monthSum += $row['total']; //月營收
                }
                $totalSum += $monthSum; //總營收
                if($prevSum!=0){
                    $increase=($monthSum-$prevSum)/$prevSum*100;
                }else{
                    $increase='';
                }
                $prevSum=$monthSum;
        ?>
                <tr>
                    <td><?= $m . "月"; ?></td>
                    <td class="color"><?= $monthSum; ?></td>
                    <td><?= round(floatval($increase),2) ;?>%</td>
                    <td class="color"><?= $totalSum; ?></td>
                </tr>
        <?php
                $monthSum = 0;
            }
        }
        ?>
    </table>
</div>

<script>
    $(".del").on("click", function() {
        if (confirm("確定刪除該筆資料?")) {
            $.post("./api/del.php", {
                table: 'Orders',
                id: $(this).data('id')
            }, () => {
                location.reload();
            })
        }
    })
</script>