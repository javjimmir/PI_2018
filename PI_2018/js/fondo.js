
$(document).ready(function () {

    /*Fondo dinámico */
    var d = new Date();
    var n = d.getMonth();

if(n>10 && n<2){
    // invierno
            $(document.body).css('background-image', 'url(http://www.hdbilder.eu/p/get_photo/544286/2560/1440)');
}else if(n>=2 && n<5){
    // primavera
             $(document.body).css('background-image', 'url(http://www.thetravelboss.com/images/gallery/img_1515493479.jpg)');
}else if(n>=5 && n<8){
    // verano
             $(document.body).css('background-image', 'url(https://www.sunsportsmaine.com/wp-content/uploads/2017/12/GoPro-Hero-Session-Floaty-3.jpg)');
}else if(n>=8 && n<11){
    // otoño 
             $(document.body).css('background-image', 'url(https://hdwallsource.com/img/2014/9/downhill-wallpaper-hd-35545-36355-hd-wallpapers.jpg)');
}
});
