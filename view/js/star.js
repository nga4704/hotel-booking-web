document.addEventListener("DOMContentLoaded", function() {
    var ratingDivs = document.querySelectorAll('.rating');

    ratingDivs.forEach(function(ratingDiv) {
        var rating = parseFloat(ratingDiv.getAttribute('data-rating'));
        var fullStars = Math.floor(rating);
        var hasHalfStar = rating % 1 !== 0;
        var emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);

        var starsHTML = '';
       
        for (var i = 0; i < fullStars; i++) {
            starsHTML += '<i class="icon_star"></i>';
        }
        if (hasHalfStar) {
            starsHTML += '<i class="icon_star-half_alt"></i>';
        }
        for (var j = 0; j < emptyStars; j++) {
            starsHTML += '<i class="icon_star_alt"></i>';
        }

        ratingDiv.innerHTML = starsHTML;
    });
});

