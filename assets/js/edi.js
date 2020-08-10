
(function() {
    "use strict";

    $("html").niceScroll({styler:"fb",cursorcolor:"#79b1ff", cursorwidth: '6', cursorborderradius: '0px', background: '#193b6a', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".left-side").niceScroll({styler:"fb",cursorcolor:"#79b1ff", cursorwidth: '3', cursorborderradius: '0px', background: '#193b6a', spacebarenabled:false, cursorborder: '0'});


    $(".left-side").getNiceScroll();
    if ($('body').hasClass('left-side-collapsed')) {
        $(".left-side").getNiceScroll().hide();
    }



    // Toggle Left Menu
    jQuery('.menu-list > a').click(function() {

        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if(!jQuery('body').hasClass('left-side-collapsed')) {
            if(sub.is(':visible')) {
                sub.slideUp(200, function(){
                    parent.removeClass('nav-active');
                    //jQuery('.main-content').css({height: ''});
                    mainContentHeightAdjust();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function(){
                    mainContentHeightAdjust();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        jQuery('.menu-list').each(function() {
            var t = jQuery(this);
            if(t.hasClass('nav-active')) {
                t.find('> ul').slideUp(200, function(){
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function mainContentHeightAdjust() {
        // Adjust main content height
        var docHeight = jQuery(document).height();
        if(docHeight > jQuery('.main-content').height())
            jQuery('.main-content').height(docHeight);
    }

    //  class add mouse hover
    jQuery('.custom-nav > li').hover(function(){
        jQuery(this).addClass('nav-hover');
    }, function(){
        jQuery(this).removeClass('nav-hover');
    });


    // Menu Toggle
    jQuery('.toggle-btn').click(function(){
        $(".left-side").getNiceScroll().hide();

        if ($('body').hasClass('left-side-collapsed')) {
            $(".left-side").getNiceScroll().hide();
        }
        var body = jQuery('body');
        var bodyposition = body.css('position');

        if(bodyposition != 'relative') {

            if(!body.hasClass('left-side-collapsed')) {
                body.addClass('left-side-collapsed');
                jQuery('.custom-nav ul').attr('style','');

                jQuery(this).addClass('menu-collapsed');

            } else {
                body.removeClass('left-side-collapsed chat-view');
                jQuery('.custom-nav li.active ul').css({display: 'block'});

                jQuery(this).removeClass('menu-collapsed');

            }
        } else {

            if(body.hasClass('left-side-show'))
                body.removeClass('left-side-show');
            else
                body.addClass('left-side-show');

            mainContentHeightAdjust();
        }

    });


    searchform_reposition();

    jQuery(window).resize(function(){

        if(jQuery('body').css('position') == 'relative') {

            jQuery('body').removeClass('left-side-collapsed');

        } else {

            jQuery('body').css({left: '', marginRight: ''});
        }

        searchform_reposition();

    });

    function searchform_reposition() {
        if(jQuery('.searchform').css('position') == 'relative') {
            jQuery('.searchform').insertBefore('.left-side-inner .logged-user');
        } else {
            jQuery('.searchform').insertBefore('.menu-right');
        }
    }

    // panel collapsible
    $('.panel .tools .fa').click(function () {
        var el = $(this).parents(".panel").children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200); }
    });

    $('.todo-check label').click(function () {
        $(this).parents('li').children('.todo-title').toggleClass('line-through');
    });

    $(document).on('click', '.todo-remove', function () {
        $(this).closest("li").remove();
        return false;
    });

    $("#sortable-todo").sortable();


    // panel close
    $('.panel .tools .fa-times').click(function () {
        $(this).parents(".panel").parent().remove();
    });



    // tool tips
    $('.tooltips').tooltip();

    // popovers
    $('.popovers').popover();

    $('.notifTextOpen').click(function(){
        $('#notifText').fadeIn();
    });
    $('.notifTextClose').click(function(){
        $('#notifText').fadeOut();
    });

    $('.radio').click(function(){
        $(this).find('input').iCheck('check');
    });

    $('.checkbox').click(function(){
        //$(this).find('input').iCheck('check');
        if ($(this).find('input').attr("checked")=="checked") {
            $(this).find('input').iCheck('uncheck');
        }else{
            $(this).find('input').iCheck('check');
        }
    });

    $('input').on("ifClicked",function(event){
        clickToShow = $(this).attr("class");
    });

    $("input").keydown(function(event){
        if(event.keyCode == 13) {
            if($(this).attr("class")!="tags"){
                event.preventDefault();
                return false;
            }
            else{ return true;}
        }
    });

    $('.subCatOpen').click(function(){
        $('#subCat').fadeIn();
    });
    $('.subCatClose').click(function(){
        $('#subCat').fadeOut();
    });
    $(".price").maskMoney({thousands:'.',precision:0});

    $('#bukumuYear').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });


    $(".delImage").click(function(){
        $(".formDelImage").toggle();
    });


    $(".showImgLarge").click(function(){
        $('.imgLarge').fadeIn();
    });

    $(".imgLargeClose").click(function(){
        $('.imgLarge').fadeOut();
    });

    //-------------------------------------------------//

    $( "select#filterCat" ).change(function(e) {
        //alert("filter filter");
        var filterCat     = $( "select#filterCat option:selected" ).val();
        //var filterSubCat  = $("select#filterSubCat option:selected").val();

        //alert("filterSubCat");exit();
        // $(".filtersubcat").hide();
        // $("#arrCat"+filterCat).show();

        //alert("#arrCat"+filterCat);
        //alert(filterCat);
        if (filterCat != "all") {
            //$("#subCat").show();
            $("#_subCat").addClass("col-md-6");
            $(".filtersubcat").hide();
            $("#arrCat"+filterCat).show();
            $("#filterKey").removeClass("col-md-6");
            $("#filterKey").addClass("col-md-6");
            $("#filterCat").removeClass("col-md-6");
            $("#filterCat").addClass("col-md-6");
            //$("#_filterProduct").removeAttr("disabled",true);
        }else{
            //$("#_subCat").hide();
            $(".filtersubcat").hide();
            $("#arrCat"+filterCat).hide();
            $("#_subCat").removeClass("col-md-6");
            $("#filterKey").removeClass("col-md-6");
            $("#filterKey").addClass("col-md-6");
            $("#filterCat").removeClass("col-md-6");
            $("#filterCat").addClass("col-md-6");
            //$("#_filterProduct").attr("disabled",true);

        }


    })
        .change();

    $("select#filterSubCat").change(function(e){
        //alert($("select#filterSubCat option:selected").val());
        var filterSubCat = $("select#filterSubCat option:selected").val();
        //alert("filterSubcat"); exit();
        if (filterSubCat != "all") {
            //alert("aaaa");
            $("#_filterProduct").removeAttr("disabled",true);
        }else{
            //alert("bbbb");
            $("#_filterProduct").attr("disabled",true);
        }

    })
        .change();


    $('form#product').find('select[name=productCat]').change(function (e) {
        var catModel = $(this).find('option:selected').data('model').toLowerCase();
        if (catModel === "airline"){
            $('form#product').find("div#panel-unused-airline").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-idr").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-percent").removeClass('hidden');
            $('form#product').find("div#panel-product-fee").find("input[name=productFee]").maskMoney({precision:0});
        }else{
            $('form#product').find("div#panel-unused-airline").removeClass("hidden");
            $('form#product').find("div#panel-product-fee").find("span#prefix-idr").removeClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-percent").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("input[name=productFee]").maskMoney({thousands:'.',precision:0});
        }
    }).change();

    //-------------------------------------------------//

    $( "select#filterCat" ).change(function(e) {
        //alert("filter filter");
        var filterCat     = $( "select#filterCat option:selected" ).val();
        //var filterSubCat  = $("select#filterSubCat option:selected").val();

        //alert("filterSubCat");exit();
        // $(".filtersubcat").hide();
        // $("#arrCat"+filterCat).show();

        //alert("#arrCat"+filterCat);
        //alert(filterCat);
        if (filterCat != "all") {
            //$("#subCat").show();
            $("#_subCat").addClass("col-md-6");
            $(".filtersubcat").hide();
            $("#arrCat"+filterCat).show();
            $("#filterKey").removeClass("col-md-6");
            $("#filterKey").addClass("col-md-6");
            $("#filterCat").removeClass("col-md-6");
            $("#filterCat").addClass("col-md-6");
            //$("#_filterProduct").removeAttr("disabled",true);
        }else{
            //$("#_subCat").hide();
            $(".filtersubcat").hide();
            $("#arrCat"+filterCat).hide();
            $("#_subCat").removeClass("col-md-6");
            $("#filterKey").removeClass("col-md-6");
            $("#filterKey").addClass("col-md-2");
            $("#filterCat").removeClass("col-md-6");
            $("#filterCat").addClass("col-md-6");
            //$("#_filterProduct").attr("disabled",true);

        }


    })
        .change();

    $("select#filterSubCat").change(function(e){
        //alert($("select#filterSubCat option:selected").val());
        var filterSubCat = $("select#filterSubCat option:selected").val();
        //alert("filterSubcat"); exit();
        if (filterSubCat != "all") {
            //alert("aaaa");
            $("#_filterProduct").removeAttr("disabled",true);
        }else{
            //alert("bbbb");
            $("#_filterProduct").attr("disabled",true);
        }

    })
        .change();


    $('form#product').find('select[name=productCat]').change(function (e) {
        var catModel = $(this).find('option:selected').data('model').toLowerCase();
        if (catModel === "airline"){
            $('form#product').find("div#panel-unused-airline").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-idr").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-percent").removeClass('hidden');
            $('form#product').find("div#panel-product-fee").find("input[name=productFee]").maskMoney({precision:0});
        }else{
            $('form#product').find("div#panel-unused-airline").removeClass("hidden");
            $('form#product').find("div#panel-product-fee").find("span#prefix-idr").removeClass('hidden');
            $('form#product').find("div#panel-product-fee").find("span#prefix-percent").addClass('hidden');
            $('form#product').find("div#panel-product-fee").find("input[name=productFee]").maskMoney({thousands:'.',precision:0});
        }
    }).change();

})(jQuery);