/**
 * Created by ngtanphat on 31/7/2017.
 */
$(function () {
    addActiveClass();
});

function addActiveClass(){
    var navBtn = $('.nav-btn');
    $(navBtn).find('a').removeClass('active');
    var module = getUrlParam(window.location.href, "m");
    if (module === "grammar"){
        $(navBtn).find('a[href*=grammar]').addClass('active');
    } else {
        $(navBtn).find('a:first-child').addClass('active');
    }
}

function getUrlParam(url, name){
    var result = new RegExp(name + '=' + '(.+?)(&|$)').exec(url);
    if (result === null){
        return false;
    }
    return result[1];
}