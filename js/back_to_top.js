// id é "btn_top"

let btn = document.getElementById('btn_top');

window.onscroll = function(){
    scrollFunction();
};

function scrollFunction() {
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20){
        btn.style.display = 'block';
    }else{
        btn.style.display = 'none';
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}