<style>
  #carouselExampleIndicators {
    width: 100%;
    height: 500px;
    overflow: hidden;
  }
</style>
<!-- carousel start -->
<?php
// 順位第一的輪播圖「數字」
$max_rank = $Carousel->max('rank');
// 順位第一的輪播圖
$first = $Carousel->all(" order by `rank` desc limit 1");
// 輪播圖數量
$all_car = $Carousel->count(['sh' => 1]);
// 第一張之後的所有輪播圖
$cars = $Carousel->q("select * from `carousel` where `rank`<$max_rank && `sh`=1 order by `rank` desc");
?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="height: auto;">
  <!-- 輪播圖按鈕 -->
  <div class="carousel-indicators" style="gap: 3px;">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 5px;height:5px;border-radius:50%"></button>
    <?php
    for ($i = 1; $i <= $all_car - 1; $i++) {
    ?>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i; ?>" aria-label="Slide <?= $i + 1; ?>" style="width: 5px;height:5px;border-radius:50%"></button>
    <?php } ?>
  </div>
  <!-- 輪播圖 -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <?php
      foreach ($first as $fir) {
      ?>
        <a href="<?= $fir['link']; ?>">
          <img src="../img/<?= $fir['img']; ?>" class="d-block w-100" alt="...">
        </a>
      <?php } ?>
    </div>
    <?php
    foreach ($cars as $car) {
    ?>
      <div class="carousel-item">
        <a href="<?= $car['link']; ?>">
          <img src="../img/<?= $car['img']; ?>" class="d-block w-100" alt="...">
        </a>
      </div>
    <?php } ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- carousel end -->

<div class="mt-5">
  <div style="font-weight: bold;font-size:20px">最新商品</div>
  <hr>
  <div class="d-flex" style="flex-wrap:wrap;gap:2%">
    <?php
    $products = $Product->all(['sh' => 1], " order by `rank` desc limit 12");
    foreach ($products as $product) {
    ?>
      <style>
        .card:hover {
          box-shadow: 0px 0px 10px gray;
          cursor: pointer;
        }

        .card-img-top {
          width: 100%;
          height: 200px;
          background-size: cover;
          background-position: center;
        }
      </style>
      <div class="card mb-2" style="width: 15%;position:relative;z-index:1;border:none;">
        <div class="card-img-top" style="background-image: url(./img/<?= $product['img']; ?>);" onclick="location.href='?do=product_item&id=<?= $product['id']; ?>'"></div>
        <div class="card-body">
          <div style="font-weight: bold;"><?= $product['name']; ?></div>
          <div style="color:#218500;font-weight:bold">NT$<?= number_format($product['price']); ?></div>
        </div>
        <div style="position: absolute;bottom:10px;right:10px;font-size:20px;z-index:999;">
          <a data-bs-toggle="modal" data-bs-target="#p<?= $product['no']; ?>">
            <span class="material-symbols-outlined">
              shopping_cart
            </span>
          </a>

        </div>
      </div>

      <!-- Modal -->
      <style>
        .modal-header {
          border: none;
        }

        .content {
          display: flex;
          justify-content: space-between;
          align-items: start;
        }

        .modal-body {
          display: flex;
        }

        .text {
          display: flex;
          flex-direction: column;
          justify-content: space-around;
        }
      </style>
      <div class="modal fade" id="p<?= $product['no']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
          <div class="modal-content">
            <div class="content">
              <div class="modal-body">
                <div style="width: auto;height:200px;overflow:hidden">
                  <img src="./img/<?= $product['img']; ?>" class="card-img-top" style="height:100%;width:auto">
                </div>
                <div class="text mx-2">
                  <div style="font-weight:bold">
                    <?= $product['name']; ?>
                  </div>
                  <div style="font-weight:bold">
                    <?= $product['price']; ?>
                  </div>
                </div>
              </div>
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <div>
                <input type="button" data-id="<?= $product['id']; ?>" class="less" value="-">
                <input type="text" name="total" id="total<?= $product['id']; ?>" value="1" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');checkTotal()" style="width: 100px;">
                <input type="button" data-id="<?= $product['id']; ?>" class="more" value="+">
              </div>
              <button class="buyBtn" type="button" onclick="fast_buycart(<?= $product['id']; ?>)">加入購物車</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>
</div>

<script>
  $(".more").on("click", function() {
    let id = $(this).data("id");
    let value = parseInt($("#total" + id).val());
    if ((value + 1) <= 24) {
      value++;
      $("#total" + id).val(value);
    } else {
      alert("本商品最多可購買24件");
    }
  })
  $(".less").on("click", function() {
    let id = $(this).data("id");
    let value = parseInt($("#total" + id).val());
    if ((value - 1 >= 1)) {
      value--;
      $("#total" + id).val(value);
    }
  })

  function checkTotal() {
    let id = $(this).data("id");
    if ($("#total" + id).val() > 24 || $("#total" + id).val() < 1) {
      $("#total" + id).val(1);
    }
  }

  function fast_buycart(id) {
    let total = parseInt($("#total" + id).val());
    <?php
    if (!isset($_SESSION['member'])) {
      echo "location.href = '?do=login'";
    } else {
    ?>
      $.post("./api/fast_buycart.php", {
        id,
        total
      }, () => {
        location.reload();
      });
    <?php } ?>
  }
</script>