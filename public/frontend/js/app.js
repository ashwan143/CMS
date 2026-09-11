document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | AOS
    |--------------------------------------------------------------------------
    */

    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 700,
            once: true,
            offset: 80
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Header scroll effect
    |--------------------------------------------------------------------------
    */

    const header = document.querySelector(".site-header");

    window.addEventListener("scroll", function () {

        if (!header) {
            return;
        }

        if (window.scrollY > 30) {
            header.classList.add("header-scrolled");
        } else {
            header.classList.remove("header-scrolled");
        }

    });


    /*
    |--------------------------------------------------------------------------
    | Close mobile navigation after click
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll("#mainNavigation .nav-link")
        .forEach(function (link) {

            link.addEventListener("click", function () {

                const navigation =
                    document.getElementById("mainNavigation");

                if (
                    navigation &&
                    navigation.classList.contains("show")
                ) {

                    const collapse =
                        bootstrap.Collapse.getInstance(navigation);

                    if (collapse) {
                        collapse.hide();
                    }

                }

            });

        });

});
