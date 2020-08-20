// after page loaded, check the template
window.onload = function () {
    if(pagenow === 'page'){
        if(jQuery('#inspector-select-control-0').val() !== 'template-portfolio.php'){
            // if garelly include, add display none;
            jQuery('.edit-post-layout__metaboxes:has("#gallery")').attr('style','display:none');
                
        }           
    } 
};


