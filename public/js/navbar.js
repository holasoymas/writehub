document.addEventListener('DOMContentLoaded', () => {

    const $navbarBurgers = Array.from(document.querySelectorAll('.navbar-burger'));

    if ($navbarBurgers.length > 0) {

        $navbarBurgers.forEach(el => {

            el.addEventListener('click', () => {

                const target = el.dataset.target;

                const $target = document.getElementById(target);

                el.classList.toggle('is-active');

                $target.classList.toggle('is-active');
            });
        });
    }
});
