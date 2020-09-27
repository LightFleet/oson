$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// function stickRoomsBlock(){
//     if(window.innerWidth > 770){
//         if(window.scrollY >= 565){
//             $('.form-search-rooms')[0].classList.add('form-search-rooms__fixed');
//             $('.nav-enquiry').css('margin-bottom', '100px');
//         }
//         if(window.scrollY >= 1750 || window.scrollY < 565){
//             $('.form-search-rooms')[0].classList.remove('form-search-rooms__fixed');
//             $('.nav-enquiry').css('margin-bottom', '0');
//         }
//     }
//     else{
//         if(window.scrollY >= 700){
//             $('.form-search-rooms')[0].classList.add('form-search-rooms__fixed');
//             $('.nav-enquiry').css('margin-bottom', '222px');
//         }
//         if(window.scrollY >= 1600 || window.scrollY < 565){
//             $('.form-search-rooms')[0].classList.remove('form-search-rooms__fixed');
//             $('.nav-enquiry').css('margin-bottom', '0');
//         }
//     }
// }

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if(results){
        return results[1] || 0;
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}
function getTomorrow(){
    var tomorrow = new Date();
    tomorrow.setDate(new Date().getDate()+1);
    tomorrow = formatDate(tomorrow);
    return tomorrow;
}
function getToday(){
    var today = formatDate(new Date());
    return today;
}

$(document).ready(function (  )
{

    $('.bravo-form-login input[name="password"]').hide();

    $('.bravo-form-login .form-ajax').click(function ( e )
    {
        e.preventDefault();
        var login = $('.bravo-form-login input[name="email"]').val();
        $.ajax({
            url: 'https://oson.travel/handleLogin',
            type: 'get',
            data: {
                login: login
            },
            complete: function ( res )
            {
                $('.error-email').hide();

                let response = $.parseJSON(res.responseText);
                if(response.status == 'ok'){
                    // +380952554609 VTglqBEl
                    //               VTglqBEl
                    if(response.phone = 'yes'){
                        var userEmail = response.email;
                        $('.bravo-form-login input[name="email"]').val(userEmail);
                    }
                    $('.bravo-form-login input[name="email"]').val(userEmail);
                    $('.bravo-form-login input[name="email"]').hide(300);
                    $('.bravo-form-login input[name="password"]').show(300);
                    $('.form-ajax').hide(300);
                    $('.form-submit').show(300);
                }
            }
        });
    })

    $(".btn_hotel_buy_btn").each(function (  )
    {
        if(!location.href.includes('start') || !location.href.includes('end')){
            let oldUrl = $(this).attr('href');
            let newUrl = oldUrl + '&start=' + getToday() + '&end=' + getTomorrow();
            $(this).attr("href", newUrl);
        }
    });

    if($(".bravo_content .container .row .col-md-12.col-lg-3 .bravo_single_book_wrap").length){
        $(".bravo_content .container .row .col-md-12.col-lg-3 .bravo_single_book_wrap").css('max-height', (window.innerHeight - 100) + 'px');
    }
    if(window.innerWidth < 700){
        if($(".bravo_content .container .row .col-md-12.col-lg-3 .bravo_single_book_wrap").length){
            $(".bravo_content .container .row .col-md-12.col-lg-3 .bravo_single_book_wrap").css('max-height', (window.innerHeight) + 'px');
        }
    }
   if($.urlParam('quickbuy') == 'true'){

       if(location.href.includes('/hotel')){
           setTimeout(function()
           {
               $([document.documentElement, document.body]).animate({
                   scrollTop: $("#hotel-rooms").offset().top - 75
               }, 1000);
           }, 2000);
       }
       $([document.documentElement, document.body]).animate({
           scrollTop: $(".g-header").offset().top - 40
       }, 1000);

       if(window.innerWidth < 700){
           $('.bravo_single_book_wrap').modal().show()
           $('.bravo_single_book_wrap').css('z-index', 9999);
           $('.bravo_single_book_wrap').css('position', 'fixed');
       }
       if($('#bravo_car_book_app .ion-ios-add-circle-outline').length){
           $('#bravo_car_book_app .ion-ios-add-circle-outline').click();
       }
   }
    $(".bravo-button-book-mobile").click(function () {
        $('.bravo_single_book_wrap.show').modal('show');
        $([document.documentElement, document.body]).animate({
            scrollTop: $(".bravo_single_book_wrap").offset().top
        }, 1000);
    });
    $('.modal-backdrop').click(function(event){

        let newLocation = location.href.replace('?quickbuy=true&', '?');
        window.location.replace(newLocation);
    });

});

$("#gotoForm__mobi").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#hotel-rooms").offset().top - 75
    }, 1000);
});

$("#gotoForm").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#hotel-rooms").offset().top - 75
    }, 1000);
});

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

$(document).on('click', '#confirmCode', function (e) {

    e.preventDefault();
    var code = $('#phone-confirmation').val();

    if(code == sessionStorage.getItem('codeSms')){
        $.ajax({
            url: 'changePass',
            type: 'get',
            data: {
                phone: sessionStorage.getItem('phone')
            },
            complete: function (  )
            {
                // location.href = 'https://oson.travel';
            }
        });
    }
});

$(document).on('click', '#sendCode', function (e) {

    e.preventDefault();

    var to = $('#phone').val();
    var randomCode = getRandomInt(999999);

    sessionStorage.setItem('codeSms', randomCode);
    sessionStorage.setItem('phone', to);

    $.ajax({
        url: 'sendSms',
        type: 'get',
        data: {
            to: to,
            message: randomCode
        },
        complete: function (  )
        {
            $('#phone-confirmation').show(300);
            $('.card-body > form:first-child').hide(300);
            $('h4').hide(300);
            $('label[for="phone"]').hide(300);
            $('label[for="phone-confirmation"]').show(300);
            $('#phone').hide(300);
            $('#sendCode').hide(300);
            $('#confirmCode').show(300);
        }
    });
});

$(window).scroll(function (  )
{
    if($('.form-search-rooms').length){
        if(window.scrollY >= $('.form-search-rooms').offset().top){
            $('.gotoForm-btn').show(300);
        }
        else{
            $('.gotoForm-btn').hide(300);
        }
    }

    //

    // if(window.scrollY >= $('.fotorama__nav-wrap').offset().top){
    //     $('.facilities-1').hide(300);
    //     $('.hotel-service').hide(300);
    // } else{
    //     $('.facilities-1').show(300);
    //     $('.hotel-service').show(300);
    // }

    if($('.advances-block').length){
        if($('.advances-block').is(':visible')){
            showHideAdvancesBlock();
        }
    }
    if(window.innerWidth > 700){
        if($('.col-lg-3 .bravo_single_book_wrap').length){
            if($('.bravo_single_book_wrap').offset().top > 3531){
                $('.bravo_single_book_wrap').css('position', 'relative');
                $('.bravo_single_book_wrap').offset({top: 3530});
            } else{
                $('.bravo_single_book_wrap').css('position', 'sticky');
                $('.bravo_single_book_wrap').css('top', '80px');
            }
        }
    }
    if(window.innerWidth < 700){
        if($('.bravo_form_search_map')){
            if($('.bravo_form_search_map').is(':visible')){
                showHideMobileFilter();
            }
        }
    }
})

$(document).ready(function (  )
{
    if($(".bravo_form_search_map .filter-price").length){
        var input_price = $(".bravo_form_search_map .filter-price");
        var min = input_price.data("min");
        var max = input_price.data("max");
        var from = input_price.data("from");
        var to = input_price.data("to");
        var symbol = input_price.data("symbol");
        input_price.ionRangeSlider({
            type: "double",
            grid: true,
            min: min,
            max: max,
            from: from,
            to: to,
            prefix: symbol
        });
    }
});

function showHideAdvancesBlock(){
    if($('.advances-block').is(':visible')){
        $('.advances-block').hide(300);
        return;
    }
    if($('.advances-block').is(':hidden')){
        $('.advances-block').show(300);
    }
}

function showHideMobileFilter(){
    if($('.bravo_form_search_map').is(':visible')){
        $('.bravo_form_search_map').hide(300);
        return;
    }
    if($('.bravo_form_search_map').is(':hidden')){
        $('.bravo_form_search_map').show(300);
    }
}

$('.bravo-featured-item .owl-carousel').owlCarousel({
    autoplay: true,
    nav: true,
    margin:10,
    loop: true,
    responsiveClass:true,
    responsive:{
        0:{
            center: true,
            autoWidth: true,
            items:1,
            nav:true
        },
        400:{
            items:2,
            autoWidth: true,
            center: false
        },
    }
});
window.bravo_format_money =  function($money) {

    if (!$money) {
        //return bookingCore.free_text;
    }
    //if (typeof bookingCore.booking_currency_precision && bookingCore.booking_currency_precision) {
    //    $money = Math.round($money).toFixed(bookingCore.booking_currency_precision);
    //}

    $money            = bravo_number_format($money/bookingCore.currency_rate, bookingCore.booking_decimals, bookingCore.decimal_separator, bookingCore.thousand_separator);
    var $symbol       = bookingCore.currency_symbol;
    var $money_string = '';

    switch (bookingCore.currency_position) {
        case "right":
            $money_string = $money + $symbol;
            break;
        case "left_space":
            $money_string = $symbol + " " + $money;
            break;

        case "right_space":
            $money_string = $money + " " + $symbol;
            break;
        case "left":
        default:
            $money_string = $symbol + $money;
            break;
    }

    return $money_string;
}

window.bravo_number_format = function (number, decimals, dec_point, thousands_sep) {


    number         = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n          = !isFinite(+number) ? 0 : +number,
        prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s          = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

window.bravo_handle_error_response = function(e){
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            break;
    }
};

// Form validation
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});

var bookingCoreApp ={
    showSuccess:function (configs){
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.success;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showError:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.warning;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showAjaxError:function (e) {
        var json = e.responseJSON;
        if(typeof json !='undefined'){
            if(typeof json.errors !='undefined'){
                var html = '';
                _.forEach(json.errors,function (val) {
                    html+=val+'<br>';
                });

                return this.showError(html);
            }
            if(json.message){
                return this.showError(json.message);
            }
        }
        if(e.responseText){
            return this.showError(e.responseText);
        }
    },
    showAjaxMessage:function (json) {
        if(json.message)
        {
            if(json.status){
                this.showSuccess(json);
            }else{
                this.showError(json);
            }
        }
    },
    showConfirm:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }
        args.buttons = {
            confirm: {
                label: '<i class="fa fa-check"></i> '+i18n.confirm,
            },
            cancel: {
                label: '<i class="fa fa-times"></i> '+i18n.cancel,
            }
        };
        args.centerVertical = true;
        bootbox.confirm(args);
    }
};
