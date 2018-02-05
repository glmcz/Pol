$(document).ready(function(){
    
    var pathArray = window.location.pathname.split( '/' );
    var secondLevelLocation = pathArray[1];
    /*
    
    if(secondLevelLocation == 'ru' || secondLevelLocation == 'ua' || secondLevelLocation == 'en'){
        
        langlink = window.location.pathname.substr(3);
        
        $("ul.language-menu li.lang-ru a").attr("href", "http://"+window.location.host+langlink);
        $("ul.language-menu li.lang-ua a").attr("href", "http://"+window.location.host+"/ua"+langlink);
        $("ul.language-menu li.lang-en a").attr("href", "http://"+window.location.host+"/en"+langlink);
        
    }else{
        
        $("ul.language-menu li.lang-ru a").attr("href", "http://"+window.location.host+window.location.pathname);
        $("ul.language-menu li.lang-ua a").attr("href", "http://"+window.location.host+"/ua"+window.location.pathname);
        $("ul.language-menu li.lang-en a").attr("href", "http://"+window.location.host+"/en"+window.location.pathname);
        
    }
    */
    // Добавить в Избранное
    $('.make_default a').on("click", function() {
        
        title=document.title; 
        url=document.location; 
        try { 
            // Internet Explorer 
            window.external.AddFavorite(url, title); 
        } 
        catch (e) { 
            try { 
                // Mozilla 
                window.sidebar.addPanel(title, url, ""); 
            } 
            catch (e) { 
                // Opera и Firefox 23+ 
                if (typeof(opera)=="object" || window.sidebar) { 
                    this.rel="sidebar"; 
                    this.title=title; 
                    this.url=url; 
                    this.href=url; 
                    return true; 
                } 
                else { 
                // Unknown 
                    alert('Нажмите Ctrl-D чтобы добавить страницу в закладки'); 
                } 
            } 
        } 
        return false; 
        
    });
    
    $('.allatra_search_tip a').on('click', function(e){
        
       var searchtext = $(this).text(); 
       $('.allatra_search input[name = search]').val(searchtext);
        
    });
    
    $('input#captcha').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });
    
    $(".allatra_bar .nav.navbar-nav li a, .top-menu li a").each(function() {
		if (this.href == window.location) {
            $(this).parent('li').addClass("active");
            $(this).parentsUntil("li.open").addClass("active");
		};
	});
    
    var tmp1=$(window).scrollTop()-50;
    var tmp2=$(window).scrollTop()+50;
    
    mainmenu_wrapper = $('#mainmenu').position().top;
    
    if ($(this).scrollTop() >= mainmenu_wrapper) {        // If page is scrolled more than 200px
        $('#mainmenu').addClass('fixed');    // Fade in the arrow
    } else {
        $('#mainmenu').removeClass('fixed');   // Else fade out the arrow
    }
    
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 200) {        // If page is scrolled more than 200px
            $('.to_top').addClass('active');    // Fade in the arrow
        } else {
            $('.to_top').removeClass('active');   // Else fade out the arrow
        }

        if ($(this).scrollTop() >= mainmenu_wrapper) {        // If page is scrolled more than 200px
            $('#mainmenu').addClass('fixed');    // Fade in the arrow
            
            if($(window).scrollTop()>=tmp2){
                tmp1=$(window).scrollTop()-50;
                tmp2=$(window).scrollTop()+50;
                $('#mainmenu').fadeOut(100);
            }else if($(window).scrollTop()<=tmp1){
                tmp1=$(window).scrollTop()-50;
                tmp2=$(window).scrollTop()+50;
                $('#mainmenu').fadeIn(100);
            }
            
        } else {
            $('#mainmenu').removeClass('fixed');   // Else fade out the arrow
        }

    });
    
    $(".to_top").on("click",function(){
       $("html, body").animate( { scrollTop: 0 }, 'slow' ); 
       return false;
    });
    
    $("#comment_form .material_rating.big .rating_stars").hover(function(){
        //alert();
    });
    
    $("#comment_form .material_rating.big .rating_stars").on("click",function(){
        //alert();
    });
    
    if(secondLevelLocation == 'ru'){
        
        $('#mini-calendar').load(base_url + 'calendar'); 
        
    }else if(secondLevelLocation == 'ua'){
        
        $('#mini-calendar').load(base_url + 'ua/calendar'); 
        
    }else if(secondLevelLocation == 'en'){
        
        $('#mini-calendar').load(base_url + 'en/calendar'); 
        
    }else{
        
        $('#mini-calendar').load(base_url + 'calendar'); 
        
    }
    
    $('body').on('click', '#prev-month', function(){ 
        //alert($(this).attr('href'));
        $('#mini-calendar, #just-calendar').load($(this).attr('href')); 
        return false;
    }); 
    
    $('body').on('click', '#next-month', function(){
        //alert($(this).attr('href'));
        $('#mini-calendar, #just-calendar').load($(this).attr('href'));
        return false;
    }); 
    
});