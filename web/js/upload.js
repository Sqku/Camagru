// var loadFile = function(event) {
//     var reader = new FileReader();
//     reader.onload = function(){
//         var output = document.getElementById('output');
//         output.src = reader.result;
//     };
//     reader.readAsDataURL(event.target.files[0]);
// };

uploadbutton = document.querySelector('#uploadbutton'),
upload_form = document.querySelector('#upload_form'),
upload_img = document.querySelector('#upload_img'),

// upload_img.onchange = function (e) {
//     e.preventDefault();
//
//     var file = this.files[0];
//     var url = URL.createObjectURL(file);
//     var img = new Image(640, 480);
//
//     document.getElementById('img-preview').setAttribute('src', url);
//     img.src = url;
//     img.setAttribute('crossOrigin', 'anonymous');
//     img.setAttribute('id', 'image');
// };

upload_img.addEventListener('click', function(ev){

    upload_img.onchange = function (e) {
        // e.preventDefault();

        var file = this.files[0];
        var url = URL.createObjectURL(file);
        var img = new Image(640, 480);

        document.getElementById('img-preview').setAttribute('src', url);
        img.src = url;
        img.setAttribute('crossOrigin', 'anonymous');
        img.setAttribute('id', 'image');
    };
    // ev.preventDefault();
    // canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    // photo.setAttribute("src", ' ');
    // b64_img.setAttribute("value", '');
    // resetbutton.style.display="none";
    // savebutton.style.display="none";
    // startbutton.style.display="block";
    uploadbutton.style.display="block";
    // upload_form.style.display="block";


});


    var nbr_cadres = 3;
    var i;
    for (i = 1; i <= 3; i++)
    {
        document.getElementById('cadre_' + i).addEventListener('click', function () {
            // this.style.border = '1px solid red';
            document.getElementById('apercu').setAttribute('src', this.src);
            document.getElementById('id_cadre2').setAttribute('value', this.alt);
            console.log('cadre_' + this.alt + ' Clicked');
            uploadbutton.disabled = false;
        });
    }


