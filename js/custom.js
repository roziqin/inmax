$('a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
function openfilter() {

        var people = $('.advance-search');
        var el = document.getElementById(filter);
        $.each(people, function(index, el) {
            var _this = $(el);
            if (_this.hasClass('open')) {
                _this.removeClass('open');
                $("#filter span").text("Tampilkan Filter");

                $("#filter").addClass('custom');
                $("#ket").val('');

            } else {
                _this.addClass('open');
                $("#filter span").text("Sembunyikan Filter");
                $("#filter").removeClass('custom');
                $("#ket").val('harga');

            }
        });

}
$(window).scroll( function() {
    /*
    var value = $(this).scrollTop();

    if ( value > 100){

        $(".fixheader").css("top",0);

    }else{

        $(".fixheader").css("top",-150);

    }
*/

});
