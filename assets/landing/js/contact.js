$(document).ready(function(){
    
    (function($) {
        "use strict";

    
    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value)
    }, "type the correct answer -_-");

    // validate contactForm form
    $(function() {
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                phone: {
                    required: true,
                    minlength: 9
                },
                number: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                name: {
                    required: "come on, you have a name, don't you?",
                    minlength: "your name must consist of at least 2 characters"
                },
                phone: {
                    required: "come on, you have a phone number, don't you?",
                    minlength: "your number must consist of at least 9 characters"
                },
                email: {
                    required: "no email, no registration"
                }
            },
            submitHandler: function(form) {
                var url = $('.url').val(),
                    loader = url + 'assets/landing/img/loader.svg'

                $('.button-contactForm').html(`Please Wait... <img height="50px" src="${ loader }">`)
                $('.button-contactForm').prop('disabled', true)
                $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:$(form).attr('action'),
                    dataType: 'json', // Specify that you expect a JSON response
                    success: function(data) {
                        $('.response').html(data.message)
                        $('.response').removeClass('alert-success')
                        $('.response').removeClass('alert-danger')
                        if(data.status)
                        {
                            $('.response').addClass('alert-success')
                        }
                        else
                        {
                            $('.response').addClass('alert-danger')
                        }

                        $('#contactForm :input').attr('disabled', 'disabled');
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#success').fadeIn()
                            $('.modal').modal('hide');
		                	$('#success').modal('show');
                        })

                        $('.button-contactForm').html(`Create <i class="flaticon-right-arrow"></i>`)
                        $(form)[0].reset();
                        $('.button-contactForm').prop('disabled', false)
                    },
                    error: function() {
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn()
                            $('.modal').modal('hide');
		                	$('#error').modal('show');
                        })
                        $('.button-contactForm').prop('disabled', false)
                    }
                })
            }
        })
    })
        
 })(jQuery)
})