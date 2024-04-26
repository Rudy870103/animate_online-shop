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
                            <li class="nav-item">
                                <a class="nav-link" href="?do=carousel">
                                    輪播圖管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?do=member">
                                    會員管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?do=types">
                                    商品分類管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?do=product">
                                    商品管理
                                </a>
                            </li>
                        </ul>
                        <div class="mb-2" style="text-align: right;">
                            <a href="Javascript:logout()">管理登出</a>
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
        $file = "./back/{$do}.php";

        if (file_exists($file)) {
            include $file;
        } else {
            include "./back/main.php";
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