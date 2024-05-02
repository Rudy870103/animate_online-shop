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
    <style>
        #topBtn {
            font-size: 2px;
            display: none;
            position: fixed;
            bottom: 10%;
            right: 2%;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgb(0, 106, 255, 0.8);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
        }

        #topBtn:hover {
            background-color: #555;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 79%;
            z-index: 999;
            background-color: rgb(248, 248, 248, 0.9) !important;
        }
    </style>
    <!-- go to top button -->
    <button onclick="topFunction()" id="topBtn" title="Go to top">
        Top
    </button>

    <script>
        // Get the button
        let mybutton = document.getElementById("topBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- go to top button end -->

    <header>
        <div class="top">
            <!-- navbar start -->
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container" style="padding:0">
                    <a class="navbar-brand" href="index.php"><img src="./img/logo_hori.png" title="AniMate online shop" style="width: 200px;"></a>
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
                                            $buycartTotal = "(" . count($_SESSION['cart']) . ")";
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
                            <div class="d-flex" role="search">
                                <input class="form-control me-2" type="search" id="search" placeholder="請輸入關鍵字" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit" onclick="search()">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- navbar end -->
        </div>
    </header>

    <main class="container" style="min-height: 100vh;">
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
    <style>
        footer .container {
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>

    <footer>
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <div>
                        <img src="./img/logo.png" style="width:150px">
                    </div>
                    <div>
                        <img src="./img/animate.png" style="width:150px;">
                    </div>
                </div>
                <div class="d-flex justify-content-between" style="width:40%">
                    <div>
                        關於AniMate shop
                    </div>
                    <div>
                        顧客權益
                    </div>
                    <div>
                        其他服務
                    </div>
                    <div>
                        企業合作
                    </div>
                </div>
            </div>
            <div style="text-align: end;">
                0917893235 | favoriteinfinite@gmail.com | © AniMate All rights reserved.
                <a href="https://www.instagram.com/rudy_chenboru/" target="_blank">
                    <i class="fa-brands fa-square-instagram" style="color: white;font-size:30px;"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>

<script>
    function logout() {
        if (confirm("即將登出")) {
            location.href = './api/logout.php';
        }
    }


    function search() {
        let search = $("#search").val();
        location.href = `?do=search&search_for=${search}`;
    }
</script>