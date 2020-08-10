<?php 
$pro = product_list_one('id',isset($_GET['id']) ? $_GET['id'] : '');
$gallery = gallery_list(isset($_GET['id']) ? $_GET['id'] : '');
$product_list = product_list_category($pro['id_category'], $pro['id'],0,4);
update_view($pro['id']);
if (isset($_POST['btnGui'])) {
    extract($_REQUEST);
    #reply
    if ($_SESSION['member']['role'] == 1 || $_SESSION['member']['role'] == 2) {
        insert_comment($content,$pro['id'],'',$_SESSION['member']['id'],0,true,$value);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    } elseif($_SESSION['member']['role'] == 3){
        insert_comment($content,$pro['id'],'',$_SESSION['member']['id'],0,false,$value);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    }else {
        insert_comment($content,$pro['id'],$_SESSION['customer']['id'],'',0,false,$value);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    }
}
#comment
if (isset($_POST['btnSave'])) {
    extract($_REQUEST);
    #reply
    if ($_SESSION['member']['role'] == 1 || $_SESSION['member']['role'] == 2) {
        insert_comment($content,$pro['id'],'',$_SESSION['member']['id'],0,true,0);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    } elseif($_SESSION['member']['role'] == 3){
        insert_comment($content,$pro['id'],'',$_SESSION['member']['id'],0,false,0);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    }else {
        insert_comment($content,$pro['id'],$_SESSION['customer']['id'],'',0,false,0);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }
    }
}
?>
 <!-- bradcam_area_start -->
 <div class="bradcam_area breadcam_bg overlay">
 	<h3>Chi tiết sản phẩm</h3>
 </div>
 <!-- bradcam_area_end -->

<div class="container section-padding">
    <main>
        <div class="row mt-3">
            <div class="col-md-12">
                <article>
                    <section class="section section-sm section-first bg-default">
                        <div class="container">
                            <div class="row row-50">
                                <div class="col-lg-6">
                                    <!-- Slider anh san pham -->
                                    <div class="slides">
                                        <ul class="pgwSlideshow">
                                            <?php foreach ($gallery as $gall) : ?>
                                                <li><img src="images/products/<?= $gall['images'] ?>" alt="">
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="single-product">
                                        <h4 class="font-weight-normal"><?= $pro['name'] ?></h4>
                                        <div class="group-md group-middle mt-3">
                                            <div class="single-product-price bg-light pt-3 pl-3 mb-3">
                                                <?php if ($pro['sale'] > 0) : ?>
                                                    <div class="old-price d-inline-block mr-4">
                                                        <del> <?=number_format($pro['price'],0,',','.').' đ'; ?></del>
                                                    </div>
                                                <?php endif; ?>
                                                <p class="list-price d-inline-block">  <?=number_format($price= $pro['price']-($pro['price']*$pro['sale']),0,',','.').' đ';?></p>
                                                <?php if ($pro['sale'] > 0) : ?>
                                                    <div class="sale d-inline-block ml-4">
                                                        <span class="percent">-<?= ($pro['sale'] * 100) . '%' ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="status">
                                            <p>Trạng thái: <?= ($pro['status'] == 1) ? 'Còn hàng' : 'Hết hàng' ?></p>
                                        </div>
                                        <div class="view">
                                            <p>Lượt xem: <?= $pro['views'] ?></p>
                                        </div>
                                      
                                        <form action="?page=cart&id=<?= $pro['id'] ?>" method="post">
                                            <div class="group-sm group-middle mt-3 d-inline-block">
                                                <div class="product-stepper d-inline-block mr-5">
                                                    <input class="form-input" type="number" name="qty" value="1" min="1" max="1000">
                                                </div>
                                                <div class="add-cart d-inline-block ml-5">
                                                    <button class="btn text-uppercase" name="add-to-cart">Thêm vào giỏ</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="mt-3">
                                            <span class="social-title">Chia sẻ</span>
                                            <div class="socials-share">
                                                <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo getCurURL(); ?>" target="_blank"><span class="fa fa-facebook-f"></span> Share</a>
                                                <a class="bg-twitter" href="https://twitter.com/share?text=<?php echo urlencode($pro['name']); ?>&url=<?php echo getCurURL(); ?>" target="_blank"><span class="fa fa-twitter"></span> Tweet</a>
                                                <a class="bg-email" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?= $pro['name'] ?>&body=<?php echo getCurURL(); ?>" target="_blank"><span class="fa fa-envelope"></span> Gmail</a>
                                                <a class="bg-pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?php echo getCurURL(); ?>&media=http://localhost/Ass_duanmau/images/products/<?= $pro['images'] ?>&description=<?= $pro['name'] ?>" target="_blank"><span class="fa fa-pinterest"></span> Pinterest</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bootstrap tabs-->
                            <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-5">
                                <!-- Nav tabs-->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item" role="presentation"><a class="nav-link active text-uppercase" href="#tabs-5-1" data-toggle="tab">Bình luận</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link text-uppercase" href="#tabs-5-2" data-toggle="tab">Thông tin chi tiết</a></li>
                                </ul>
                                <!-- Tab panes-->
                                <div class="tab-content mb-5">
                                    <div class="tab-pane fade show active p-3 border border-top-0" id="tabs-5-1">
                                     <!-- Binh luan  -->
                                     <div class="box-comment">
                                     <h5 class="mb-3">KHÁCH HÀNG NHẬN XÉT</h5>
                                            <?php
                                            comment_recursive(0, 1, $pro['id'], $listArray);
                                            ?>
                                            <?php if (!empty($listArray)) : ?>
                                               
                                                <?php foreach ($listArray as $key => $value) : ?>
                                                    
                                                    <?php if ($value['level'] == 1) : ?>
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <div class="box-comment-figure"><img src="images/users/<?= $value['c_images'] ?>" alt="" width="50" height="50" class="rounded-circle"></div>
                                                            </div>
                                                            <div class="col-10  mb-3">
                                                                <div class="comment">
                                                                    <p class="box-comment-author m-0 font-weight-bold"> <?= $value['name'] ?></p>
                                                                    <div class="box-comment-time font-italic">
                                                                        <time datetime="<?= $value['created_at'] ?>"><?= $value['created_at'] ?></time>
                                                                    </div>
                                                                    <p class="box-comment-text mb-0"><?= $value['content'] ?></p>
                                                                    <!-- Bị ẩn khi người dùng chưa đăng nhập  -->
                                                                    <?php if (isset($_SESSION['customer']['id'])) : ?>
                                                                        <button type="button" class="btn p-0 text-primary" data-toggle="collapse" data-target="#reply<?= $value['id'] ?>" aria-controls="reply<?= $value['id'] ?>">Trả
                                                                        lời</button>
                                                                        <form action="" class="collapse mt-3" id="reply<?= $value['id'] ?>" method="post">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="value" value="<?= $value['id'] ?>">
                                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nhận xét của bạn..." name="content" required></textarea>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary pl-5 pr-5" name="btnGui">Gửi</button>
                                                                            <button type="button" class="btn ml-5 pl-5 pr-5 btn-outline-primary" data-toggle="collapse" data-target="#reply<?= $value['id'] ?>" aria-controls="reply<?= $value['id'] ?>">Hủy
                                                                            bỏ</button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php else : ?>
                                                            <?php $padding = ($value['level'] - 1) * 90; ?>
                                                            <div class="row" style="padding-left:<?= $padding ?>px">
                                                                <div class="col-1">
                                                                    <div class="box-comment-figure"><img src="images/users/<?= $value['c_images'] ?>" alt="" width="50" height="50" class="rounded-circle"></div>
                                                                </div>
                                                                <div class="col-10 mb-3">
                                                                    <div class="comment">
                                                                        <p class="box-comment-author m-0 font-weight-bold"><?= $value['name'] ?></p>
                                                                        <div class="box-comment-time font-italic">
                                                                            <time datetime="<?= $value['created_at'] ?>"><?= $value['created_at'] ?></time>
                                                                        </div>
                                                                        <p class="box-comment-text mb-0"><?= $value['content'] ?></p>
                                                                        <!-- Bị ẩn khi người dùng chưa đăng nhập  -->
                                                                        <?php if (isset($_SESSION['customer']['id'])) : ?>
                                                                            <button type="button" class="btn p-0 text-primary" data-toggle="collapse" data-target="#reply<?= $value['id'] ?>" aria-controls="reply<?= $value['id'] ?>">Trả
                                                                            lời</button>
                                                                            <form action="" class="collapse mt-3" id="reply<?= $value['id'] ?>" method="post">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="value" value="<?= $value['id'] ?>">
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" placeholder="Nhận xét của bạn..." required></textarea>
                                                                                </div>
                                                                                <button type="submit" class="btn btn-primary pl-5 pr-5" name="btnGui">Gửi</button>
                                                                                <button type="button" class="btn ml-5 pl-5 pr-5 btn-outline-primary" data-toggle="collapse" data-target="#reply<?= $value['id'] ?>" aria-controls="reply<?= $value['id'] ?>">Hủy
                                                                                bỏ</button>
                                                                            </form>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                                <?php if (isset($_SESSION['customer']['id'])) : ?>
                                                    <button type="button" class="btn mt-5 mb-3" data-toggle="collapse" data-target="#comment" aria-controls="comment">Viết nhận xét của
                                                    bạn</button>
                                                    <!-- Bị ẩn khi khách hàng chưa đăng nhập -->
                                                    <form action="" method="post" class="collapse" id="comment">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" placeholder="Nhận xét của bạn..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" name="btnSave">Gửi nhận xét</button>
                                                        <button type="button" class="btn ml-5 pl-5 pr-5 btn-outline-primary" data-toggle="collapse" data-target="#comment" aria-controls="comment">Hủy
                                                        bỏ</button>

                                                    </form>
                                                    <?php else : ?>
                                                        <p class="ml-3"><strong>Bạn cần đăng nhập mới có thể bình luận</strong></p>
                                                    <?php endif; ?>
                                     </div>
                                    </div>
                                    <div class="tab-pane fade p-3 border border-top-0" id="tabs-5-2">
                                        <p class="text-justify"><?= $pro['description'] ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Slider sản phẩm liên quan -->
                    <section class="section section-sm section-last bg-default">
                        <div class="container">
                            <h4 class="text-uppercase text-center mb-5">sản phẩm liên quan</h4>
                            <div class="slider">
                                <div class="product-active">
                                    <?php foreach ($product_list as $pro_list) : ?>
                                        <div class="slider-item">
                                          <div class="product-item">
 									<div class="pi-pic">
 										<a href="<?=ROOT?>?page=product-detail&id=<?=$pro_list['id']?>">
                                         <img src="images/products/<?= $pro_list['images'] ?>" alt="<?= $pro_list['name'] ?>" width="270" height="303" title="<?= $pro_list['name'] ?>">
                                         </a>
 										<?php if ($pro_list['sale'] > 0) : ?>
 											<div class="sale pp-sale"><?= ($pro_list['sale'] * 100) . '%' ?></div>
 										<?php endif; ?>
 										<ul>
                                         <li class="w-icon active">
											 <form action="<?=ROOT?>?page=cart&id=<?=$pro_list['id']?>&qty=1" method="post">
												 <button class="btn" name="add-to-cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
												 </form>
											 </li>
 											<li class="quick-view"><a href="<?=ROOT?>?page=cart&id=<?=$pro_list['id']?>&qty=1&add-to-cart">Mua ngay</a></li>
 											<li class="w-icon"><a href="<?=ROOT?>?page=product-detail&id=<?=$pro_list['id']?>"><i class="fa fa-random"></i></a></li>
 										</ul>
 									</div>
 									<div class="pi-text">
 										<a href="<?=ROOT?>?page=product-detail&id=<?=$pro_list['id']?>">
 											<h5><?= substr($pro_list['name'], 0, 28) . $str = (strlen($pro_list['name']) > 28 ? '...' : '') ?></h5>
 										</a>
 										<div class="product-price">
                                             <?= number_format($pro_list['price'], 0, ',', '.') . 'đ' ?>
                                             <span><i class="fa fa-eye ml-3 mr-1" aria-hidden="true"></i><?=$pro_list['views']?></span>
 										</div>
 									</div>
 								</div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                           
                        </div>
                    </section>
                    <script>
                       
                    </script>
                </article>
            </div>
        </div>
    </main>
</div>