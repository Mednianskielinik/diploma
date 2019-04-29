// $('.dropdown-trigger').dropdown({ hover: false });

document.addEventListener('touchmove', null, {passive: true});
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
    var instance = M.Carousel.init({
        fullWidth: true
    });
});
