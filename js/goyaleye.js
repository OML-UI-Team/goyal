$(function(){
    $('.appointment-form').submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "php/save-appointment.php",
            dataType: "json",
            async: false,
            data: form.serialize(),
            success: function (data) {
                if(data.status == "success") {
                    var html = `<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Success!</strong> `+data.message+`
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>`;
                    $('.form-results').html(html);

                    window.location.href = "thank-you.php";
                }

                if(data.status == "error") {
                    var html = `<div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Error!</strong> `+data.message+`
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>`;
                    $('.form-results').html(html);
                }
            },
            error: function (textStatus, errorThrown) {
                    var html = `<div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Error!</strong> Somthing went wrong!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>`;
                    $('.form-results').html(html);
            }
        });

    });
    
    $('.contact-form').submit(function(event){
    	event.preventDefault();
	    var form = $(this);
	    $.ajax({
		type: "POST",
		url: "php/save-contact.php",
		dataType: "json",
		async: false,
		data: form.serialize(),
		success: function (data) {
		    console.log(data);

		    if(data.status == "success") {
		        $('.scss-msg').text(data.message);
		        $('.scss-div').fadeIn();
		        $('.err-div').fadeOut();
		        window.location.href = "thank-you.php";
		    }

		    if(data.status == "error") {
		        $('.err-msg').text(data.message);
		        $('.err-div').fadeIn();
		        $('.scss-div').fadeOut();
		    }
		},
		error: function (textStatus, errorThrown) {
		        $('.err-msg').text('Somthing went wrong!');
		        $('.err-div').fadeIn();
		        $('.scss-div').fadeOut();
		}
	    });

	});
});
