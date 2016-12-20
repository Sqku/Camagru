$(function() {
    $('#file input[type="file"]').change(function() {
        $("#preview").each(function(e){
            this.remove();
        });
        var file = $(this);
        var reader = new FileReader;
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
                var width = 140;
                var height = 90
                var canvas = $('<canvas id="preview"></canvas>').attr({ width: width, height: height });
                file.after(canvas);
                var context = canvas[0].getContext('2d');
                context.drawImage(img, 0, 0, width, height);
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file[0].files[0]);
    });
});

    var nbr_cadres = 3;
    var i;
    for (i = 1; i <= 3; i++)
    {
        document.getElementById('cadre_' + i).addEventListener('click', function () {
            // this.style.border = '1px solid red';
            document.getElementById('apercu').setAttribute('src', this.src);
            document.getElementById('id_cadre').setAttribute('value', this.alt);
            document.getElementById('id_cadre2').setAttribute('value', this.alt);
            console.log('cadre_' + this.alt + ' Clicked');
            savebutton.disabled = false;
        });
    }

})();