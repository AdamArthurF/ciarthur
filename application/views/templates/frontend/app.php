<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $this->config->item('assets_frontend') ?>style/images/favicon.png">

    <title>Snowlake</title>

    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/css/plugins.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/revolution/css/layers.css">
    <link rel="styleslaeet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/revolution/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/type/type.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/css/color/purple.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('assets_frontend') ?>style/css/font/font2.css">

    <!-- Google re-Captcha  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Pace -->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    <?= $this->load->view($style, '', true) ?>
</head>

<body>
    <div class="preloader-container">
        <svg class="preloader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
            <circle cx="170" cy="170" r="160" stroke="#E2007C" />
            <circle cx="170" cy="170" r="135" stroke="#404041" />
            <circle cx="170" cy="170" r="110" stroke="#E2007C" />
            <circle cx="170" cy="170" r="85" stroke="#404041" />
        </svg>
    </div>
    <div class="content-wrapper">
        <nav class="navbar absolute transparent inverse-text navbar-hover-opacity nav-uppercase navbar-expand-lg">
            <div class="container flex-row justify-content-center">
                <div class="navbar-brand"><a href="<?= base_url() ?>"><img src="#" srcset="<?= $this->config->item('assets_frontend') ?>style/images/logo.png 1x, <?= $this->config->item('assets_frontend') ?>style/images/logo@2x.png 2x" class="logo-dark" alt="" /><img src="#" srcset="<?= $this->config->item('assets_frontend') ?>style/images/logo-light.png 1x, <?= $this->config->item('assets_frontend') ?>style/images/logo-light@2x.png 2x" class="logo-light" alt="" /></a></div>
                <div class="navbar-other ml-auto order-lg-3">
                    <ul class="navbar-nav flex-row align-items-center" data-sm-skip="true">
                        <li class="nav-item">
                            <div class="navbar-hamburger d-lg-none d-xl-none ml-auto"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
                        </li>
                        <li class="dropdown search-dropdown position-static nav-item">
                            <a href="#" role="button" class="collapse-toggle" data-toggle="collapse" data-target=".search-dropdown-menu" aria-haspopup="true" aria-expanded="false"><i class="jam jam-search"></i></a>
                            <div class="dropdown-menu search-dropdown-menu w-100 collapse">
                                <div class="form-wrapper">
                                    <form class="inverse-text">
                                        <input type="text" class="form-control" placeholder="Search something">
                                    </form>
                                    <!-- /.search-form -->
                                    <i class="dropdown-close jam jam-close"></i>
                                </div>
                                <!-- /.form-wrapper -->
                            </div>
                        </li>
                        <li class="nav-item"><button class="plain" data-toggle="offcanvas-info"><i class="jam jam-info"></i></button></li>
                    </ul>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-other -->
                <div class="navbar-collapse offcanvas-nav">
                    <div class="offcanvas-header d-lg-none d-xl-none">
                        <a href="<?= base_url() ?>"><img src="#" srcset="<?= $this->config->item('assets_frontend') ?>style/images/logo-light.png 1x, <?= $this->config->item('assets_frontend') ?>style/images/logo-light@2x.png 2x" alt="" /></a>
                        <button class="plain offcanvas-close offcanvas-nav-close"><i class="jam jam-close"></i></button>
                    </div>
                    <?= $this->load->view('templates/frontend/navbar', '', true) ?>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="offcanvas-info inverse-text">
            <button class="plain offcanvas-close offcanvas-info-close"><i class="jam jam-close"></i></button>
            <a href="<?= base_url() ?>"><img src="#" srcset="<?= $this->config->item('assets_frontend') ?>style/images/logo-light.png 1x, <?= $this->config->item('assets_frontend') ?>style/images/logo-light@2x.png 2x" alt="" /></a>
            <div class="space30"></div>
            <p>Snowlake is a multi-concept and powerful site template contains rich layouts with possibility of unlimited combinations & beautiful elements.</p>
            <div class="space20"></div>
            <div class="widget">
                <h5 class="widget-title">Contact Info</h5>
                <address> Moonshine St. 14/05 <br /> Light City, London <div class="space20"></div>
                    <a href="mailto:first.last@email.com" class="nocolor">info@email.com</a><br /> +00 (123) 456 78 90
                </address>
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h3 class="widget-title">Learn More</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="nocolor">Our Story</a></li>
                    <li><a href="#" class="nocolor">Terms of Use</a></li>
                    <li><a href="#" class="nocolor">Privacy Policy</a></li>
                    <li><a href="#" class="nocolor">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h3 class="widget-title">Follow Us</h3>
                <ul class="social social-mute social-s ml-auto">
                    <li><a href="#"><i class="jam jam-twitter"></i></a></li>
                    <li><a href="#"><i class="jam jam-facebook"></i></a></li>
                    <li><a href="#"><i class="jam jam-instagram"></i></a></li>
                    <li><a href="#"><i class="jam jam-vimeo"></i></a></li>
                    <li><a href="#"><i class="jam jam-youtube"></i></a></li>
                </ul>
            </div>
            <!-- /.widget -->
        </div>

        <!-- Header -->
        <?= $this->load->view($header, '', true) ?>
        <!--  /.Header -->

        <!-- Main Page -->
        <?= $this->load->view($page, '', true) ?>
        <!-- /.Main Page -->

        <!-- Footer -->
        <?= $this->load->view('templates/frontend/footer', '', true) ?>
        <!-- /.Footer -->
    </div>
    <!-- /.content-wrapper -->
    <script src="<?= $this->config->item('assets_frontend') ?>style/js/jquery.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/js/popper.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/js/bootstrap.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/revolution/js/extensions/revolution.extension.video.min.js"></script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Form Validation Custom -->
    <script src="https://appt.demoo.id/tema/cuba/html/assets/js/form-validation-custom.js"></script>

    <!-- Bootstrap Custom File Input -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <!-- Cookie js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>

    <!-- SocketIO  -->
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>

    <script src="<?= $this->config->item('assets_frontend') ?>style/js/plugins.js"></script>
    <script src="<?= $this->config->item('assets_frontend') ?>style/js/scripts.js"></script>
    <script>
        let csrf, loading, socket;

        /** Set default AJAX headers */
        axios.defaults.headers.common = {
            "X-Requested-With": "XMLHttpRequest",
        };

        /**
         * Keperluan disable inspect element
         */
        // ================================================== //

        // Disable right click
        $(document).contextmenu(function(event) {
            event.preventDefault()
        })

        $(document).keydown(function(event) {
            // Disable F12
            if (event.keyCode == 123) return false;

            // Disable Ctrl + Shift + I
            if (event.ctrlKey && event.shiftKey && event.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }

            // Disable Ctrl + Shift + J
            if (event.ctrlKey && event.shiftKey && event.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }

            // Disable Ctrl + U
            if (event.ctrlKey && event.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        })

        /**
         * Keperluan socket.io pengaduan
         */
        // ================================================== //
        // socket = io("ws://223.27.152.101:2021")
        // socket = io("ws://localhost:3021/")

        /**
         * Keperluan generate csrf
         */
        // ================================================== //
        // csrf = () => {
        //     socket.emit('minta-csrf', {
        //         token: '<?= $this->encryption->encrypt(bin2hex('csrf')) ?>',
        //         url: "<?= base_url('csrf/generate') ?>",
        //         cookie: Cookies.get('ciarthur_csrf_cookie'),
        //         session: Cookies.get('ciarthur_session'),
        //     })

        //     return new Promise((resolve, reject) => {
        //         socket.on('terima-csrf', data => {
        //             resolve({
        //                 token_name: data.csrf_token_name,
        //                 hash: data.csrf_hash,
        //             })
        //         })
        //     })
        // }

        csrf = async () => {
            let formData = new FormData()
            // formData.append('key', '<?= $this->encryption->encrypt(bin2hex('csrf')) ?>')

            let res = await axios.post("<?= base_url('csrf/generate') ?>", formData, {
                headers: {
                    'Authorization': `Bearer <?= $this->encryption->encrypt(bin2hex('csrf')) ?>`
                }
            })
            return {
                token_name: res.data.csrf_token_name,
                hash: res.data.csrf_hash
            }
        }

        // Document ready
        $(() => {

            /**
             * Keperluan show preloader
             */
            // ================================================== //
            $('.preloader-container').fadeOut(500)

            /**
             * Keperluan resize Google Recaptchaa
             */
            // ================================================== //

            let width = $('.g-recaptcha').parent().width();
            if (width < 302) {
                let scale = width / 302;
                $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('transform-origin', '0 0');
                $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
            }

            /**
             * Keperluan show loading
             */
            // ================================================== //
            loading = () => {
                Swal.fire({
                    title: 'Loading...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
            }
        })
    </script>
    <?= $this->load->view($script, '', true) ?>
</body>

</html>