$(document).ready(function() {
    function getSlidesToShow() {
        // Lấy chiều rộng của cửa sổ
        var windowWidth = $(window).width();

        // Thiết lập số slide hiển thị dựa trên kích thước của cửa sổ
        if (windowWidth < 768) {
            return 1;
        } else if (windowWidth >= 768 && windowWidth < 992) {
            return 2;
        } else if (windowWidth >= 992 && windowWidth < 1200) {
            return 3;
        } else {
            return 4;
        }
    }

    // Sử dụng Slick Slider với số slide hiển thị được lấy từ function getSlidesToShow
    $('.hp-room-items').slick({
        slidesToShow: getSlidesToShow(),
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        prevArrow: '.slick-prev', // Chỉ định class hoặc id của nút prev
        nextArrow: '.slick-next',
    });

    // Sự kiện thay đổi kích thước cửa sổ
    $(window).resize(function() {
        // Khi kích thước cửa sổ thay đổi, cập nhật lại số slide hiển thị
        $('.hp-room-items').slick('slickSetOption', 'slidesToShow', getSlidesToShow(), true);
    });
});
