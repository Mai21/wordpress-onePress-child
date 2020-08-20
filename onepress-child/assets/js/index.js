jQuery(function(){

    /* When page loaded */
    jQuery(document).ready(function(){
        // On the portfolio page, change the first button and the first carousel to active 
        jQuery('.photo-list li:first-child a').addClass('active');
        jQuery('#carousel-image_photo_portrait').removeClass('d-none');
    });

    /* sidebar gallery start */
    jQuery('.ac-gallery').attr("data-ride","carousel");
    jQuery('.ac-gallery').attr("id","carousel-ac-gallery");
    jQuery('.ac-gallery').removeClass("wp-block-gallery");
    jQuery('.ac-gallery').addClass("carousel slide");
    jQuery('.ac-gallery').addClass("carousel slide");

    jQuery('.ac-gallery').find('ul').addClass("carousel-inner");
    jQuery('.ac-gallery').find('ul').removeClass("blocks-gallery-grid");
    jQuery('.ac-gallery').find('li').each(function(n){
            if(n == 0){
                jQuery(this).addClass('carousel-item active');
            }else{
                jQuery(this).addClass('carousel-item');
            }
            jQuery(this).find('figure').addClass('mx-auto');
    });
    var move_element = jQuery('#replace-area').html();
    jQuery('.ac-gallery').append(move_element);
    jQuery('#replace-area').remove();
    /* sidebar gallery end */

    /* portfolio button starts*/
    jQuery('.button-set a').click(function(){
        const classes = jQuery(this).parent().attr('class');
        const el = classes.split(' ').filter(cls => cls.startsWith('button-'));
        changeVisible(el[0].replace('button-',''));
        return false;
    });
    
    /* when the button pressed change the sliders and list */
    var lists = ['photo','video','web','design'];
    function changeVisible(el){
        /* list area */
        jQuery('.' + el +'-list').removeClass('d-none');
        lists.forEach(element => {
            if(element != el){
                jQuery('.' + element +'-list').addClass('d-none');
            }
        });
        /* button area */
        jQuery('.button-' + el).addClass('active');
        lists.forEach(element => {
            if(element != el){
                jQuery('.button-' + element).removeClass('active');
            }
        });
        /* gallery area */
        jQuery('.gallery-' + el).removeClass('d-none');
        const active_element = jQuery('.' +  el + '-list a.active');
        if(el == 'design' || el == 'photo'){
            if(active_element.attr('href')){
                const active_link = active_element.attr('href');
                jQuery('.gallery-' + el  + ' div:not(' + active_link + ')').addClass('d-none');
                jQuery('.gallery-' + el  + ' div' + active_link).removeClass('d-none');
            }else{
                // first time
                jQuery('.gallery-' + el  + ' div:not(:first-child)').addClass('d-none');
                jQuery('.gallery-' + el  + ' div:first-child').removeClass('d-none');
                jQuery('.' +  el + '-list li:first-child a').addClass('active');
            }
        }else if(el == 'web'){
            if(active_element.attr('href')){
                var elements = [].slice.call(jQuery('.' +  el + '-list')) ;
                const index = jQuery('.' +  el + '-list a').index(active_element);
                jQuery('#carousel-image_'+el+' .carousel-indicators li').eq(index).trigger('click');
            }else{
                // first time
                jQuery('.' +  el + '-list li:first-child a').addClass('active');
            }
        }else{
            // video
            if(active_element.attr('href')){
                var elements = [].slice.call(jQuery('.' +  el + '-list')) ;
                const index = jQuery('.' +  el + '-list a').index(active_element);
                jQuery('#' + el +  '-gellery-list li').not(index).addClass('d-none');
                jQuery('#' + el +  '-gellery-list li').eq(index).removeClass('d-none');
            }else{
                // first time
                jQuery('.' +  el + '-list li:first-child a').addClass('active');
            }

        }
        lists.forEach(element => {
            if(element != el){
                jQuery('.gallery-' + element).addClass('d-none');
            }
        });
    }
    /* portfolio button ends */

    /* portfolio link starts*/
    jQuery('.design-list a').click(function(){
        const target = jQuery(this).attr('href');
        jQuery(target).removeClass('d-none');
        jQuery(this).parents('ul').find('a').removeClass('active');
        jQuery(this).addClass('active');
        const lists = ['image_design_card','image_design_bro','image_design_banner'];
        lists.forEach(element => {
            if('#carousel-' + element != target){
                jQuery('#carousel-' + element).addClass('d-none');
                jQuery('#carousel-' + element).removeClass('active');
            }
        });
        return false;
    });

    jQuery('.web-list a').click(function(){
        jQuery(this).parents('ul').find('a').removeClass('active');
        jQuery(this).addClass('active');
        const index = jQuery('.web-list a').index(this);
        jQuery('#carousel-image_web .carousel-indicators li').eq(index).trigger('click');
        return false;
    });

    jQuery('.photo-list a').click(function(){
        const target = jQuery(this).attr('href');
        jQuery(target).removeClass('d-none');
        jQuery(this).parents('ul').find('a').removeClass('active');
        jQuery(this).addClass('active');

        const lists = ['image_photo_portrait','image_photo_landscape','image_photo_table'];
        lists.forEach(element => {
            if('#carousel-' + element != target){
                jQuery('#carousel-' + element).addClass('d-none');
                jQuery('#carousel-' + element).removeClass('active');
            }
        });
        return false;
    });

    jQuery('.video-list a').click(function(){
        const target = jQuery(this).attr('href');
        jQuery(target).removeClass('d-none');
        jQuery(this).parents('ul').find('a').removeClass('active');
        jQuery(this).addClass('active');

        const index = jQuery('.video-list a').index(this);
        jQuery('#video-gallery-list li').removeClass('active');
        jQuery('#video-gallery-list li').eq(index).addClass('active');

        return false;
    });
    /* portfolio link ends */

    jQuery('#carousel-image_web').on('slide.bs.carousel', function (e) {
        var _e = jQuery(e.relatedTarget);
        var idx = _e.index();
        jQuery('.caption-list').find('p').removeClass('active');
        jQuery('.caption-list').find('p').eq(idx).addClass('active');

        jQuery('.web-list a').removeClass('active');
        jQuery('.web-list a').eq(idx).addClass('active');

    });
    jQuery('#carousel-thumb').on('slide.bs.carousel', function (e) {
        /*
            CC 2.0 License Iatek LLC 2018 - Attribution required
        */
        var _e = jQuery(e.relatedTarget);
        var idx = _e.index();
        var itemsPerSlide = 5;
        var totalItems = jQuery('.carousel-item').length;
        if(idx >= itemsPerSlide){
            jQuery('.carousel-indicators').find('li').eq(idx).removeClass('d-none');
            jQuery('.carousel-indicators').find('li').eq(idx-itemsPerSlide).addClass('d-none');
        }else{
            if (idx == 0){
                jQuery('.carousel-indicators').find('li').each( function( index, element ) {
                    if(index < itemsPerSlide){
                        jQuery('.carousel-indicators').find('li').eq(index).removeClass('d-none');
                    }else{
                        jQuery('.carousel-indicators').find('li').eq(index).addClass('d-none');
                    }
                });
            }else{
                if (e.direction=="right") {
                    var len = jQuery('.carousel-indicators').find('li').length;
                    jQuery('.carousel-indicators').find('li').eq(idx).removeClass('d-none');
                    jQuery('.carousel-indicators').find('li').eq(idx+itemsPerSlide).addClass('d-none');
                }       
            }
        }
    });
});


