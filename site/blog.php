<?php
$blog_new = list_limit_new(0, 5);
$gallery = library_list_limit(0, 10);

$num_row = count_row('news');
	$current_page = isset($_GET['p']) ? $_GET['p'] : 0;
	$limit = 4;
	//tổng số trang
	$total_page = ceil($num_row / $limit);
	// Giới hạn current_page trong khoảng 1 đến total_page
	if ($current_page > $total_page) {
		$current_page = $total_page;
	} else if ($current_page < 1) {
		$current_page = 1;
	}
	// Tìm Start
	$start = ($current_page - 1) * $limit;
	$blog =  list_limit_new($start, $limit);
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Bài viết</h3>
</div>
<!-- bradcam_area_end -->
<?php include_once "layout/noti.php"; ?>

<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <?php foreach ($blog as $b) : ?>
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="images/sliders/<?= $b['images'] ?>" alt="">
                                <a href="<?= ROOT ?>?page=blog-detail&id=<?= $b['id'] ?>" class="blog_item_date">
                                    <?php
                                    $time = $b['created_at'];
                                    $d = strtotime("$time"); ?>
                                    <h3><?= date("d", $d) ?></h3>
                                    <p><?= date("F", $d) ?></p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="<?= ROOT ?>?page=blog-detail&id=<?= $b['id'] ?>">
                                    <h2><?= $b['title'] ?></h2>
                                </a>
                                <p><?= substr($b['content'], 0, 520) . $str = (strlen($b['content']) > 520 ? '...' : '') ?></p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> <?= $b['member'] ?></a></li>
                                    <li><a href="#"><i class="fa fa-eye mr-1" aria-hidden="true"></i> <?= $b['views'] ?></a></li>
                                </ul>
                            </div>
                        </article>
                    <?php endforeach; ?>
                   <!-- phan trang -->
 					<nav class="blog-pagination justify-content-center d-flex">
 						<ul class="pagination">
 							<?php if ($current_page > 1 && $total_page > 1) : ?>
 								<li class="page-item">
 									<a href="<?= ROOT ?>?page=blog&p=<?= ($current_page - 1) ?>" class="page-link" aria-label="Previous">
 										<i class="ti-angle-left"></i>
 									</a>
 								</li>
 							<?php endif; ?>
 							<?php
								for ($i = 1; $i <= $total_page; $i++) : ?>
 								<!-- // Nếu là trang hiện tại thì hiển thị active
                    // ngược lại hiển thị thẻ a -->
 								<?php if ($i == $current_page) : ?>
 									<li class="page-item active">
 										<a href="<?= ROOT ?>?page=blog&p=<?= $i ?>" class="page-link"><?= $i ?></a>
 									</li>
 								<?php else : ?>
 									<li class="page-item">
 										<a href="<?= ROOT ?>?page=blog&p=<?= $i ?>" class="page-link"><?= $i ?></a>
 									</li>
 								<?php endif; ?>
 							<?php endfor;  ?>
 							<?php if ($current_page < $total_page && $total_page > 1) : ?>
 								<li class="page-item">
 									<a href="<?= ROOT ?>?page=blog&p=<?= ($current_page + 1) ?>" class="page-link" aria-label="Next">
 										<i class="ti-angle-right"></i>
 									</a>
 								</li>
 							<?php endif; ?>
 						</ul>
 					</nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="<?= ROOT ?>?page=search_blog" class="needs-validation" method="POST" novalidate>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm bài viết" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="ti-search"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập từ khóa tìm kiếm
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Tìm kiếm</button>
                        </form>
                    </aside>
                    <!-- bài viết mới nhất -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài viết mới nhất</h3>
                        <?php foreach ($blog_new as $bl) : ?>
                            <div class="media post_item">
                                <a href="<?= ROOT ?>?page=blog-detail&id=<?= $bl['id'] ?>"><img src="images/sliders/<?= $bl['images'] ?>" alt="post" width="80" height="80"></a>
                                <div class="media-body">
                                    <a href="<?= ROOT ?>?page=blog-detail&id=<?= $bl['id'] ?>">
                                        <h3><?= substr($bl['title'], 0, 24) . $str = (strlen($bl['title']) > 24 ? '...' : '') ?></h3>
                                    </a>
                                    <?php
                                    $day = $bl['created_at'];
                                    $date = strtotime("$day"); ?>
                                    <p><?= date("F j, Y", $date) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </aside>
                    <!-- Mẫu tóc  -->
                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Thư viện </h4>
                        <ul class="instagram_row flex-wrap">
                            <?php foreach ($gallery as $g) : ?>
                                <li>
                                    <a href="<?= ROOT ?>?page=blog-detail&id=<?= $g['link'] ?>">
                                        <img class="img-fluid" src="images/sliders/<?= $g['images'] ?>" alt="">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->