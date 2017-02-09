(function() {
    var streaming = false,
        video = document.querySelector('#video'),
        canvas = document.querySelector('#canvas'),
        b64_img = document.querySelector('#b64_img'),
        width = 800,
        height = 600;

    navigator.getMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);


})();




uploadbutton = document.querySelector('#uploadbutton');
upload_form = document.querySelector('#upload_form');
upload_img = document.querySelector('#upload_img');
b64_img = document.querySelector('#b64_img');
width = 800;
height = 600;

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


// navigator.getMedia = ( navigator.getUserMedia ||
// navigator.webkitGetUserMedia ||
// navigator.mozGetUserMedia ||
// navigator.msGetUserMedia);
//
// navigator.getMedia(
//     {
//         video: true,
//         audio: false
//     },
//     function(stream) {
//         if (navigator.mozGetUserMedia) {
//             video.mozSrcObject = stream;
//         } else {
//             var vendorURL = window.URL || window.webkitURL;
//             video.src = vendorURL.createObjectURL(stream);
//         }
//         video.play();
//     },
//     function(err) {
//         console.log("An error occured! " + err);
//     }
// );
//
// video.addEventListener('canplay', function(ev){
//     if (!streaming) {
//         height = video.videoHeight / (video.videoWidth/width);
//         video.setAttribute('width', width);
//         video.setAttribute('height', height);
//         canvas.setAttribute('width', width);
//         canvas.setAttribute('height', height);
//         streaming = true;
//     }
// }, false);



upload_img.addEventListener('click', function(ev){

    upload_img.onchange = function (e) {
        // e.preventDefault();

        var file = this.files[0];
        var url = URL.createObjectURL(file);
        var img = new Image(640, 480);

        document.getElementById('img-preview').setAttribute('src', url);
        b64_img.setAttribute("value", img);
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


    var nbr_cadres = 5;
    var i;
    for (i = 1; i <= 5; i++)
    {
        document.getElementById('cadre_' + i).addEventListener('click', function () {
            // this.style.border = '1px solid red';
            document.getElementById('apercu').setAttribute('src', this.src);
            document.getElementById('id_cadre2').setAttribute('value', this.alt);
            console.log('cadre_' + this.alt + ' Clicked');
            uploadbutton.disabled = false;
        });
    }

function resize_scroll_div() {
    document.getElementById('camera_right').style.height = document.getElementById('camera_left').clientHeight;
}

resize_scroll_div();

window.addEventListener('resize', resize_scroll_div);
