<style>
    .nav button {
        color: black;
        font-weight: bold;
    }

    .nav-pills {
        padding-right: 20px;
    }

    .nav-pills .nav-link.active {
        background-color: #218500;
    }

    h4 {
        padding-left: 5px;
        margin-bottom: 30px;
        border-left: 5px solid black;
    }

    td {
        padding: 10px;
    }

    td input {
        width: 100%;
    }
</style>

<!-- nav -->
<!-- nav button start -->
<div class="d-flex align-items-start mx-auto" style="padding-top:150px">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-pills-member-tab" data-bs-toggle="pill" data-bs-target="#v-pills-member" type="button" role="tab" aria-controls="v-pills-member" aria-selected="true">會員專區</button>
        <button class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order" type="button" role="tab" aria-controls="v-pills-order" aria-selected="false">訂單查詢</button>
    </div>
    <!-- nav button end -->

    <!-- nav content start -->
    <div class="tab-content mx-auto" id="v-pills-tabContent" style="width:70%">
        <!-- 會員專區 -->
        <div class="tab-pane fade show active" id="v-pills-member" role="tabpanel" aria-labelledby="v-pills-member-tab" tabindex="0">
            <h4>會員基本資料</h4>
            <form action="../api/front_save_mem.php" method="post">
                <div class="box mx-auto p-3">
                    <?php
                    if (isset($_SESSION['member'])) {
                        $mem = $Member->find(['acc' => $_SESSION['member']]);
                    }
                    ?>
                    <table style="width:100%">
                        <tr>
                            <td>
                                <div>帳號</div>
                                <div>
                                    <input type="text" name="acc" value="<?= $mem['acc']; ?>">
                                </div>
                            </td>
                            <td>
                                <div>密碼</div>
                                <div>
                                    <input type="text" name="pw" value="<?= $mem['pw']; ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>姓名</div>
                                <div>
                                    <input type="text" name="name" value="<?= $mem['name']; ?>">
                                </div>
                            </td>
                            <td>
                                <div>手機</div>
                                <div>
                                    <input type="text" name="tel" value="<?= $mem['tel']; ?>" style="background-color: #d0d0d0;" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>地址</div>
                                <div>
                                    <input type="text" name="addr" value="<?= $mem['addr']; ?>">
                                </div>
                            </td>
                            <td>
                                <div>信箱</div>
                                <div>
                                    <input type="text" name="email" value="<?= $mem['email']; ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-end">
                                <div>註冊日期</div>
                                <div><?= $mem['regdate']; ?></div>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <input type="hidden" name="id" value="<?= $mem['id']; ?>">
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <input class="buyBtn" style="width: 20%;" type="reset" value="重置">
                    <input class="buyBtn" style="width: 20%;" type="submit" value="更新">
                </div>
            </form>
        </div>


        <!-- 訂單列表 -->
        <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab" tabindex="0">
            <h4>訂單列表</h4>
            <table class="box text-center" style="width: 100%;">
                <tr>
                    <th class="color border border-dark">訂單編號</th>
                    <th class="border border-dark">金額</th>
                    <th class="color border border-dark">下單日期</th>
                </tr>
                <?php
                $rows = $Orders->all(['tel' => $mem['tel']]," order by `orderdate` desc");
                foreach ($rows as $row) {
                ?>
                    <tr>
                        <td class="color border border-dark"><a href="?do=order_info&id=<?= $row['id']; ?>"><?= $row['no']; ?></a></td>
                        <td class="border border-dark"><?= $row['total']; ?></td>
                        <td class="color border border-dark"><?= $row['orderdate']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <!-- nav content end -->
    </div>