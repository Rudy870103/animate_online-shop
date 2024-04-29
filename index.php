<?php include_once "./api/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniMate online shop</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-1.9.1min.js"></script>
    <script src="./js/js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

    <header>
        <div class="top">
            <!-- navbar start -->
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">AniMate online shop</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                            <?php
                            $bigs = $Type->all(['big_id' => 0]);
                            foreach ($bigs as $big) {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $big['name']; ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="?do=product&type=<?= $big['id']; ?>">全部商品</a></li>
                                        <?php
                                        $mids = $Type->all(['big_id' => $big['id']]);
                                        foreach ($mids as $mid) {
                                        ?>
                                            <li><a class="dropdown-item" href="?do=product&type=<?= $mid['id']; ?>"><?= $mid['name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                        <div>
                            <div class="mb-2" style="text-align: right;">
                                <?php
                                if (isset($_SESSION['member'])) {
                                    if ($_SESSION['member'] == 'admin') {
                                        echo "<a href='back.php' class='mx-1'>管理後臺</a>|";
                                        echo "<a href='Javascript:logout()' class='mx-1'>管理登出</a>";
                                    } else {
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                            $buycartTotal = "(". count($_SESSION['cart']) . ")";
                                        } else {
                                            $buycartTotal = '';
                                        }
                                ?>
                                        <button onclick="location.href='?do=buycart'" class='mx-1 myBtn'><i class="fa-solid fa-cart-shopping"></i>購物車<?= $buycartTotal; ?></button>
                                        <button onclick="location.href='?do=member'" class='mx-1 myBtn'><i class="fa-solid fa-user"></i>會員中心</button>
                                        <button onclick="logout()" class='mx-1 delBtn'><i class="fa-solid fa-right-from-bracket"></i>會員登出</button>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <button class='myBtn' onclick="location.href='?do=login'"><i class='fa-solid fa-user'></i> 登入</button>
                                <?php } ?>
                            </div>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="請輸入關鍵字" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- navbar end -->
        </div>
    </header>

    <main class="container">
        <?php
        $do = $_GET['do'] ?? 'main';
        $file = "./front/{$do}.php";

        if (file_exists($file)) {
            include $file;
        } else {
            include "./front/main.php";
        }
        ?>
    </main>


    <footer>

    </footer>

</body>

</html>

<script>
    function logout() {
        if (confirm("即將登出")) {
            location.href = './api/logout.php';
        }
    }
</script>