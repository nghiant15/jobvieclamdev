$(document).ready(function () {
    if ($('.bs-picker').length) {
        $(".bs-picker").datetimepicker({
            language: 'en',
            container: 'body',
            format: 'dd/mm/yyyy',
        });
    }
    if ($('.bs-datetimepicker').length) {
        $(".bs-datetimepicker").datetimepicker({
            language: 'en',
        });
    }
    if ($('.daterange').length){
        $('.daterange').daterangepicker({
            autoUpdateInput: false,
            timePicker: false,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        $('.daterange').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
    }
  
    $('#atcFilters').on('click', function(){
        $('.filters-job-wrapper').slideToggle();
    });
    $('[data-toggle="tooltip"]').tooltip();
    var cvLang = $('select#cv_language').val();
    var cvFontsize = $('input[type=radio][name=fontSize]').val();
    applyCVFontsize(cvFontsize);
    applyCVLangue(cvLang);
    viewMoreFilter();
    swiperSlider();
    setPaddingBody();
    multiSelect();
    activeCoverCV();
    formCVTemplate();
    atcApplyJob();
    jobExperienceChange();
    reviewApplication();
    actionSubMenu();
    $(".currency-mask").formatCurrency({
        roundToDecimalPlace: 0, 
        symbol: ''
    });
    $(".currency-mask").on("change", function () {
        $(".currency-mask").formatCurrency({
            roundToDecimalPlace: 0, 

            symbol: ''
        });
    });
});
$(window).resize(function () {
    setPaddingBody();
});

function jobExperienceChange() {
    $('body').on('change', '#job_experience_id', function (){
        $('.numberExperience').html(this.value);
    })
  
}

// Function cho CV TEMPLATE
function formCVTemplate() {
    
    $('select#cv_language').on('change', function () {
        $('#cv_lang').val(this.value);
        applyCVLangue(this.value)
       
    });
    $('input[type=radio][name=fontSize]').change(function () {
        $('#cv_font_size').val(this.value);
        applyCVFontsize(this.value);
    });
    $('body').on('click', '.btn-choose-template', function () {
        $('#cv_template').val($(this).attr('data-template'));
        $('.templateNumber').html($(this).attr('data-template'));
        console.log($('#cv_lang').val());
        applyCVLangue($('#cv_lang').val());
        applyCVFontsize($('#cv_font_size').val());
    })
}

function applyCVLangue(lang){
   console.log(lang);
    switch (lang) {
        case 'en':
            console.log('eng');
            setTimeout(() => {
                $('.cvTemplateEnglish').show();
                $('.cvTemplateVietNam').hide();
            }, 1);
            break;
        case 'vi':
            $('.cvTemplateEnglish').hide();
            $('.cvTemplateVietNam').show();
            break;
        default:
            $('.cvTemplateEnglish').hide();
            $('.cvTemplateVietNam').show();
            break;
    }
}

function applyCVFontsize(size){
    $('.cv-template-wrapper').removeClass('fontCVsize12').removeClass('fontCVsize14').removeClass('fontCVsize16');
    switch (size) {
        case '12':
            $('.cv-template-wrapper').addClass('fontCVsize12');
            break;
        case '14':
            $('.cv-template-wrapper').addClass('fontCVsize14');
            break;
        case '16':
            $('.cv-template-wrapper').addClass('fontCVsize16');
            break;
        default:
            $('.cv-template-wrapper').addClass('fontCVsize12');
            break;
    }
}


function atcApplyJob() {
    $('input[type=radio][name=your_resume]').change(function () {
        if (this.value == 0){
            $('.form-check-cv').show();
            $('.form-check-upload').hide();
            $('#cv_id').attr('name','cv_id');
        } else if (this.value == 1){
            $('.form-check-cv').hide();
            $('.form-check-upload').show();
            $('#cv_id').removeAttr('name');
        }
    });

    $('#chksendletter').click(function () {
        if ($(this).prop("checked") == true) {
            $('.group-textarea').show();
        }
        else if ($(this).prop("checked") == false) {
            $('.group-textarea').hide();
        }
    });
}

$(document).on('change', '#customFile', function (event) {
    var fileName = event.target.files[0].name;
    $('#custom-file-name').html(fileName);
});

function activeCoverCV() {
    $('input#flexSwitchCVCover').change(function () {
        if (this.checked) {
            $('.showImgCover').show();
        } else {
            $('.showImgCover').hide();
        }
    });
}

function multiSelect(){
    if ($('.multiselect').length){
        $('select.multiselect').multiselect({
            search: true,
            selectAll: true,
        });
    }
    if ($(".chosen-select-max-three").length) {
        console.log('abcd');
        $(".chosen-select-max-three").chosen({ max_selected_options: 3 });
    }
}

function setPaddingBody(){
    var h = $('#main-nav').height();
    $('body.default-page').css('padding-top', '76px')
}

function viewMoreFilter() {
    $('.btn-viewmore').on('click', function () {
        var _filter = $(this).attr('data-filter');
        var _parent = $(this).parents('element-filter');
    })
}

function reviewApplication() {
    $('body').on('click', '.btn-cv-application', function () {
        $('.btn-cv-application').removeClass('active');
        $(this).addClass('active');
        var dataValue = $(this).attr('data-value');
        $('#review-application-status').val(dataValue);
    })

    
    $('body').on('click', '#btn-copy-link-review-application', function () {
        $('#myInput').select();
        document.execCommand("copy");
        $(this).html('Đã sao chép');
    })


}

function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    console.log(sampleTextarea.value);
    document.body.removeChild(sampleTextarea);
}


function swiperSlider() {
    if ($('.employer-customer .swiper-container-multirow').length) {
        var swiperEmployerCustomer = new Swiper('.employer-customer .swiper-container-multirow', {
            slidesPerView: 2,
            grid: {
                rows: 2,
            },
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 6,
                },
            },
        });
    }

    if ($('.all-product-customer-reviews .swiper-container').length) {
        var swiperProductCustomerReviews = new Swiper('.all-product-customer-reviews .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        });
    }
    if ($('.all-product-banner .swiper-container').length) {
        var swiperProductBanner = new Swiper('.all-product-banner .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }
    if ($('.partnerSlider').length){
        var partnerSlider = new Swiper('.partnerSlider', {
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: false,
            navigation: false,
            autoplay: true,
            loop: true,
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    }
    if ($('.swiper-blogs-slider').length){
        var partnerSlider = new Swiper('.swiper-blogs-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: false,
            navigation: false,
            autoplay: true,
            loop: true,
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    grabCursor: true,
                },
                567: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    grabCursor: false,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    grabCursor: false,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    grabCursor: false,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    grabCursor: false,
                },
            },
        });
    }
    if ($('.swiper-suggestions').length){
        var mySwiperSuggestions = new Swiper('.swiper-suggestions', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: false,
            navigation: false,
            autoplay: true,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })
    }

    if ($('.alljobs_swiper').length) {
        var allJobsSwiper = new Swiper(".alljobs_swiper", {
            autoplay: {
                delay: 5000,
            },
            loop: true,
            speed: 1000,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + (index + 1) + "</span>";
                },
            },
        });
    }
    if ($('.slider-hero-banner').length) {
        var sliderHeroBanner = new Swiper(".slider-hero-banner", {
            autoplay: {
                delay: 4000,
            },
            loop: true,
            speed: 1000,
           
        });
    }
}

function actionSubMenu(){
    $('.btn-show-sub-menu').on('click', function () {
        let ref = $(this).attr('data-ref');
        let target = $(this).attr('data-target');
        if (target == 'true'){
            $(this).attr('data-target', 'false');
            $("[data-ref='" + ref + "']").slideUp(300);
        } else if (target == 'false'){
            $(this).attr('data-target', 'true');
            $("[data-ref='" + ref + "']").slideDown(300); 
        }
    })
}