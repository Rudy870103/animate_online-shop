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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    寶可夢
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">草系</a></li>
                                    <li><a class="dropdown-item" href="#">火系</a></li>
                                    <li><a class="dropdown-item" href="#">水系</a></li>
                                    <li><a class="dropdown-item" href="#">電系</a></li>
                                    <li><a class="dropdown-item" href="#">幽靈系</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    裝備
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">精靈球</a></li>
                                    <li><a class="dropdown-item" href="#">果實</a></li>
                                    <li><a class="dropdown-item" href="#">薰香誘餌</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    周邊商品
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">食品</a></li>
                                    <li><a class="dropdown-item" href="#">服飾</a></li>
                                    <li><a class="dropdown-item" href="#">文具</a></li>
                                    <li><a class="dropdown-item" href="#">日常用品</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div>
                            <div class="mb-2" style="text-align: right;">
                                <a href="">登入</a>
                                <a href="">購物車</a>
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