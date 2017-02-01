menu_js = document.querySelector('#menu_js');
site_cache = document.querySelector('#site_cache');
body = document.querySelector('body');

menu_js.addEventListener('click', function(e){
    e.preventDefault();
    body.classList.toggle('sidebar');
})


site_cache.addEventListener('click', function (e){
        body.classList.remove('sidebar');
})
