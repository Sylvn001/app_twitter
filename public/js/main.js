//Change image preview according src file are changed
$("#file-input").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#view-img').attr('src', e.target.result);
            $('#img-container').removeClass("d-none")
        }
        reader.readAsDataURL(this.files[0]);
    }
});

$('#cancel-img').click(function (e) { 
     $('#img-container').addClass("d-none")
     $('#view-img').attr('src', ''); 
});


$("#perfil-img-profile-input").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#view-img-profile-form').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});

$("#image-banner-profile-input").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-banner-profile').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
