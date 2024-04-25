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
  最新商品
</div>