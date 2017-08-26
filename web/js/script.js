$ = jQuery;


$(document).ready(function(){

    $('.collapsible').collapsible();

    $('.button-collapse').sideNav({
            menuWidth: 300,
            edge: 'right'
        }
    );
    $('#navbar li').click(function () {
        $('.item-navbar').removeClass('active');
        $(this).addClass('active');
    });

    $('#Collapse').click(function () {
        $("#header").css('left', '-500px');
        $("#navCollapse").css('left', '50px');
        $('#Content').addClass('headerFull');
    });

    $('#navCollapse').on('click', function () {
        $("#header").css('left', '0px');
        $("#navCollapse").css('left', '-500px');
        $('#Content').removeClass('headerFull');
    });


});



function countAnimation() {

    $('.count-animation').each(function () {
        var $this = $(this),
            $end = $this.attr('data');

        $({countNum: $this.text()}).animate({
                countNum: $end
            },

            {

                duration: 700,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                    $this.text(this.countNum);
                }
            });
    });
}
function verifPage() {

    if ($page === $nbPage) {
        $("#Next").addClass('hidden');
    }else if( $page === 1){
        $("#Prev").addClass('hidden');
    }
}