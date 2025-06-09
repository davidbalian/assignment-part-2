                <?php get_sidebar(); ?>
            </div>
        </div>

        <footer class="site-footer bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <?php if (is_active_sidebar('footer-about')) : ?>
                            <?php dynamic_sidebar('footer-about'); ?>
                        <?php else : ?>
                            <h5>About Us</h5>
                            <p>We are a creative agency providing innovative solutions for your business. Our team is passionate about design and technology.</p>
                            <h6 class="mt-4">Our Social</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="text-white fs-4"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-white fs-4"><i class="bi bi-github"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <?php if (is_active_sidebar('footer-news')) : ?>
                            <?php dynamic_sidebar('footer-news'); ?>
                        <?php else : ?>
                            <h5>Recent News</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div><strong>New Office Opening</strong></div>
                                    <div><small class="text-secondary" style="opacity:0.6;">June 22, 2023</small></div>
                                    <hr class="my-2" style="opacity:0.2;">
                                </li>
                                <li class="mb-3">
                                    <div><strong>Website Redesign Launched</strong></div>
                                    <div><small class="text-secondary" style="opacity:0.6;">May 14, 2023</small></div>
                                    <hr class="my-2" style="opacity:0.2;">
                                </li>
                                <li>
                                    <div><strong>Team Retreat in Bali</strong></div>
                                    <div><small class="text-secondary" style="opacity:0.6;">February 10, 2023</small></div>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <?php if (is_active_sidebar('footer-menu')) : ?>
                            <?php dynamic_sidebar('footer-menu'); ?>
                        <?php else : ?>
                            <h5>Custom Footer Menu</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div><a href="#" class="text-white text-decoration-none">How can we help you, Number?</a></div>
                                    <hr class="my-2" style="opacity:0.2;">
                                </li>
                                <li class="mb-3">
                                    <div><a href="#" class="text-white text-decoration-none">We have Mission & Vision, bro</a></div>
                                    <hr class="my-2" style="opacity:0.2;">
                                </li>
                                <li class="mb-3">
                                    <div><a href="#" class="text-white text-decoration-none">Take a look at our Portfolio</a></div>
                                    <hr class="my-2" style="opacity:0.2;">
                                </li>
                                <li>
                                    <div><a href="#" class="text-white text-decoration-none">Get a quote on your new project</a></div>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <?php if (is_active_sidebar('footer-newsletter')) : ?>
                            <?php dynamic_sidebar('footer-newsletter'); ?>
                        <?php else : ?>
                            <h5>Sign Up for Newsletter</h5>
                            <p>Sign up for our monthly newsletter and stay informed on new services and projects. There will be some freebies along the way. We do not spam!</p>
                            <form class="d-flex footer-newsletter-form">
                                <input type="email" class="form-control me-0" placeholder="Email Address">
                                <button class="btn btn-newsletter d-flex align-items-center justify-content-center" type="submit"><i class="bi bi-chevron-right"></i></button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
