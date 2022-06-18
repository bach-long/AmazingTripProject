<style>
    /* Footer Start here */
    footer, footer a {
        color: var(--white);
        position: relative;
    }

    .copyright-area {
        border-top: 1px solid var(--white);
        padding: 20px 10px 0 10px;
    }

    .copyright-area ul li i {
        font-size: 18px;
        margin-left: 10px;
    }
    .footer-background {
        background-image: url("./assets/img/footer-background.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        filter: brightness(0.35);
        position:absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        max-width: 100%;
        max-height: 100%;
        z-index: -1;
    }
    /* Footer End here */
</style>

<footer class="p-3">
    <section class="footer-background"> </section>
    <div class="foot-content ms-5 me-5 p-5">
        <div class="d-sm-flex justify-content-between ps-5 pe-5">
            <div class="ms-5 ps-5">
                <p>A web application development <br> for the project development <br> special course.</p>
                <a href="#"><img class="nav-logo" src="./assets/img/Ver1.png" alt="Logo"></a>
            </div>
            <div class="me-5 pe-5">
                <h6>Contact us</h6>
                <ul class="list-unstyled contact-list">
                    <li><a href="#">成長 Team</a></li>
                    <li><a href="#">Email: abc@gmail.com</a></li>
                    <li><a href="#">Facebook: ABC</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="d-sm-flex justify-content-between align-items-center copyright-area">
        <p class="copyright m-0">
            <span class="copyright-icon"><i class="fa-solid fa-copyright"></i></span> Copyright AmazingTrip - By 成長 Team
        </p>
        <ul class="list-unstyled contact-list-icon d-flex align-items-center m-0">
            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
        </ul>
    </div>
</footer>