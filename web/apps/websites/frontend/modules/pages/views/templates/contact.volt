<!-- banner start -->
<!-- ================ -->
<div class="banner dark-translucent-bg fixed-bg"
    style="background-image:url('<?php echo FRONTEND_URL ?>/assets/frontend/images/page-about-banner-1.jpg'); background-position: 50% 27%;">
    <!-- breadcrumb start -->
    <!-- ================ -->
    {{ partial('breadcrumb') }}
    <!-- breadcrumb end -->
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-8 text-center pv-20">
                <h1 class="page-title text-center">Contact Us</h1>
                <div class="separator"></div>
                <p class="lead text-center">It would be great to hear from you! Just drop us a line and ask for anything
                    with which you think we could be helpful. We are looking forward to hearing from you!</p>
                <ul class="list-inline mb-20 text-center">
                    <li class="list-inline-item"><i class="text-default fa fa-map-marker pr-2"></i>One infinity loop,
                        54100</li>
                    <li class="list-inline-item"><a href="#" class="link-dark"><i
                                class="text-default fa fa-phone pl-10 pr-2"></i>+00 1234567890</a></li>
                    <li class="list-inline-item"><a href="mailto:youremail@domain.com" class="link-dark"><i
                                class="text-default fa fa-envelope-o pl-10 pr-2"></i>youremail@domain.com</a></li>
                </ul>
                <div class="separator"></div>
                <ul class="social-links circle animated-effect-1 margin-clear text-center space-bottom">
                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="googleplus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li class="xing"><a href="#"><i class="fa fa-xing"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12 space-bottom">
                <h2 class="title">Drop Us a Line</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet quisquam.</p>
                        <div class="contact-form">
                            <form class="margin-clear">
                                <div class="form-group has-feedback">
                                    <label for="name">Name*</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" required>
                                    <i class="fa fa-user form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" id="email"
                                        aria-describedby="emailHelperText" placeholder="Enter email" required>
                                    <i class="fa fa-envelope form-control-feedback"></i>
                                    <small id="emailHelperText" class="form-text text-muted mt-2">Lorem ipsum dolor sit
                                        amet, consectetur adipisicing elit.</small>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="subject">Subject*</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                                    <i class="fa fa-navicon form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="message">Message*</label>
                                    <textarea class="form-control" rows="6" id="message" placeholder="Message"
                                        required></textarea>
                                    <i class="fa fa-pencil form-control-feedback"></i>
                                </div>
                                <input type="submit" value="Submit" class="submit-button btn btn-lg btn-default">
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="map-canvas"></div>
                    </div>
                </div>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->

<!-- section start -->
<!-- ================ -->
<section class="section pv-40 fixed-bg background-img-1 dark-translucent-bg" style="background-position:50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="call-to-action text-center">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-8">
                            <h2 class="title">Subscribe to Our Newsletter</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus error pariatur
                                deserunt laudantium nam, mollitia quas nihil inventore, quibusdam?</p>
                            <div class="separator"></div>
                            <form class="form-inline margin-clear d-flex justify-content-center">
                                <div class="form-group has-feedback">
                                    <label class="sr-only" for="subscribe2">Email address</label>
                                    <input type="email" class="form-control form-control-lg" id="subscribe2"
                                        placeholder="Enter email" required="">
                                    <i class="fa fa-envelope form-control-feedback"></i>
                                </div>
                                <button type="submit"
                                    class="btn btn-lg btn-gray-transparent btn-animated margin-clear ml-3">Submit <i
                                        class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->