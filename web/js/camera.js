(function() {

    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        resetbutton  = document.querySelector('#resetbutton'),
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

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
        resetbutton.style.display="block";
        startbutton.style.display="none";
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

    resetbutton.addEventListener('click', function(ev){
        ev.preventDefault();
        canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        photo.setAttribute("src", ' ');
        resetbutton.style.display="none";
        startbutton.style.display="block";
    });

    var nbr_cadres = 3;
    var i;
    for (i = 1; i <= 3; i++)
    {
        document.getElementById('cadre_' + i).addEventListener('click', function () {
            // this.style.border = '1px solid red';
            document.getElementById('apercu').setAttribute('src', this.src);
            console.log('cadre_' + this.alt + ' Cliked');
        });
    }

})();