$(document).ready(function(){

	var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
	var day = currentDate.getDate()
	var month = currentDate.getMonth() 
	var year = currentDate.getFullYear()
	var today = day + "/" + month + "/" + year;

	$('#date').datetimepicker({
		formatTime:'g:i A', 
		format: 'm/d/Y h:i A',
		startDate:'+' + today,
		allowTimes:["06:00 AM", "06:15 AM", "06:30 AM", "06:45 AM", "07:00 AM", "07:15 AM", "07:30 AM", "07:45 AM", "08:00 AM", "08:15 AM", "08:30 AM", "08:45 AM", "09:00 AM", "09:15 AM", "09:30 AM", "09:45 AM", "10:00 AM", "10:15 AM", "10:30 AM", "10:45 AM", "11:00 AM", "11:15 AM", "11:30 AM", "11:45 AM", "12:00 PM", "12:15 PM", "12:30 PM", "12:45 PM", "01:00 PM", "01:15 PM", "01:30 PM", "01:45 PM", "02:00 PM", "02:15 PM", "02:30 PM", "02:45 PM", "03:00 PM", "03:15 PM", "03:30 PM", "03:45 PM", "04:00 PM", "04:15 PM", "04:30 PM", "04:45 PM", "05:00 PM", "05:15 PM", "05:30 PM", "05:45 PM", "06:00 PM", "06:15 PM", "06:30 PM", "06:45 PM", "07:00 PM", "07:15 PM", "07:30 PM", "07:45 PM", "08:00 PM", "08:15 PM", "08:30 PM", "08:45 PM", "09:00 PM"],
		defaultSelect: false,
		// value: today " " +
	});
	$('#hours').customSelect();

	var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',
		state: 'short_name',
		postal_code: 'short_name'
	};

	var eMap = {
		street_number: 'a',
		route: 'v',
		locality: 'city',
		administrative_area_level_1: 'state',
		country: 'country',
		state: 'state',
		postal_code: 'zipcode'
	}

	autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'), { types: ['geocode'] });
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		console.log(place);
		
		for (var i = 0; i < place.address_components.length; i++) {
		    var addressType = place.address_components[i].types[0];
		    if (componentForm[addressType]) {
		      var val = place.address_components[i][componentForm[addressType]];
		      console.log("update: " + eMap[addressType] + " val: " + val);
		      $('#' + eMap[addressType]).val(val);
		    }
	  	}
	  	$('#address-line1').val(place.name);

		return false;
	});

	$("#request-wizard").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "none",
		autoFocus: true,
		enableKeyNavigation: false,
		enablePagination: false,
		enableFinishButton: false,
		// forceMoveForward: true
	});	

	$('#request-wizard .cancel').click(function() {
		resetForm();
		return false;
	})


	$('#address').focus(function() {
		$('#address').removeClass('invalid');
	});

	$('#date').focus(function() {
		$('#address').removeClass('invalid');
	});

	$("#phone").mask("(999) 999-9999");

	var provider_id = 0;
	var visible = false
	$('.hero').click(function() {
		if(visible) {
			resetForm();
		}
	})

	$('#request-wizard').click(function() {
		return false;
	})

	$('#request').click(function() {
		visible = true;

		// go back a maximum of three pages for subsequent attempts
		$("#request-wizard").steps('previous');
		$("#request-wizard").steps('previous');
		$("#request-wizard").steps('previous');

		// validate inputs
		var valid = true;
		if($('#address').val() == "") {
			valid = false;
			$('#address').addClass('invalid');
		} else {
			$('#address').removeClass('invalid');

		}

		if($('#date').val() == "") {
			valid = false;
			$('#date').addClass('invalid');
		} else {
			$('#date').removeClass('invalid');

		}

		if(!valid) return false;

		// switch to wizard view
		$(".text-wrapper").fadeOut(function() {
			$('#request-wizard .steps').hide();
			$("#request-wizard").fadeIn();
		});

		// TODO: perform ajax request for results and replace below
		$('.request-results').hide();
			
		$.post('api/search.php', {address: $('#address').val(), start: $('#date').val(), hours: $('#hours').val()}, function(data){

			// change display
			setTimeout(function() {
				$('.loading:first').fadeOut(function() {
					$("#request-wizard").prepend('<div class="step-list-header"><span class="step-1">Provider</span><span class="step-2">Details</span><span class="step-3">Confirmation</span>&nbsp;</div>');
					$('.results').html(data);
					$('.results .select').click(function() {
						provider_id = $(this).data('id');
						$("#request-wizard").steps('next');
						return false;
					})
					$('#request-wizard .steps').fadeIn();
					$('.request-results').fadeIn()
				});
			}, 2000);
		})
		return false;
	})
	
	$('#register').submit(function(e) {

		var data = {
			name: $(this).find('input[name="name"]').val(), 
			email: $(this).find('input[name="email"]').val(), 
			password: $(this).find('input[name="password"]').val(), 
			password2: $(this).find('input[name="password2"]').val(),
			type: $(this).find('select[name="type"]').val()
		};

		var valid = true;

		if(data.name == "" || !/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ ]+$/.test(data.name)) {
			$(this).find('input[name="name"]').addClass('invalid');
			valid = false;
		} else {
			$(this).find('input[name="name"]').removeClass('invalid');
		}
		
		if(data.email == "" || !/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(data.email)) {
			$(this).find('input[name="email"]').addClass('invalid');
			valid = false;
		} else {
			$(this).find('input[name="email"]').removeClass('invalid');
		} 

		if(data.password != data.password2) {
			$(this).find('input[name="password"]').addClass('invalid');
			$(this).find('input[name="password2"]').addClass('invalid');
		} else {
			$(this).find('input[name="password"]').removeClass('invalid');
			$(this).find('input[name="password2"]').removeClass('invalid');
		}

		if(valid) {
			$.post('api/register.php', data).done(function(data) {
				window.location.href = "index.php";
			}).fail(function(data){
				if(data.status == 409) {
					$('#register').find('input[name="email"]').addClass('invalid');
				} else {
					$('#register').find('input[name="password"]').addClass('invalid');
					$('#register').find('input[name="password2"]').addClass('invalid');	
				}
			})
		}
		e.preventDefault();
	})

	$('#login').submit(function(e) {
		console.log("trying as user");

		$.post('api/login.php', {email: $(this).find('input[name="email"]').val(), password: $(this).find('input[name="password"]').val(), type: 'user'}).done(function(data) {
			window.location.href = "index.php";
		}).fail(function(data){
			console.log("retrying as provider");
			$.post('api/login.php', {email: $('#login').find('input[name="email"]').val(), password: $('#login').find('input[name="password"]').val(), type: 'provider'}).done(function(data) {
				window.location.href = "schedule.php";
			}).fail(function(data){
				$('#login').find('input[name="email"]').addClass('invalid');
				$('#login').find('input[name="password"]').addClass('invalid');
			})
		})
		e.preventDefault();
	})

	$('.pay').click(function(e) {
		console.log("yes");
		var form = $('#payment-form');
		form.find('button.pay').prop('disabled', true);
		Stripe.card.createToken(form, stripeResponseHandler);
		return false;
  	});

  	function stripeResponseHandler(status, response) {
		var form = $('#payment-form');
		if (response.error) {
			// Show the errors on the form
			form.find('.payment-errors').text(response.error.message);
			form.find('button.pay').prop('disabled', false);
		} else {
			// response contains id and card, which contains additional card details
			var token = response.id;
			
			// Insert the token into the form so it gets submitted to the server
			form.append($('<input type="hidden" name="stripeToken" />').val(token));
			
			// create new request via ajax
			var formData = {
				name: $('input[name="name"]').val(),
				provider: provider_id,
				phone: $('input[name="phone"]').val(),
				start: $('input[name="date"]').val(),
				hours: $('select[name="hours"]').val(),
				address_line1: $('#address-line1').val(),
				address_line2: $('#address-line2').val(),
				address_city: $('#city').val(),
				address_state: $('#state').val(),
				address_zipcode: $('#zipcode').val(),
				comments: $('textarea[name="comments"]').val(),
				token: $('input[name="stripeToken"]').val()
			};

			$('#request-wizard').children().fadeOut().promise().done(function() {
			    var loading = $('<div style="display: none; margin-top: 160px;" class="loading"><span class="loading"></span>Processing payment...</div>');
				$('#request-wizard').append(loading);
				$(loading).fadeIn().delay(2000);

				$.post('api/request.php', formData).done(function(data) {
					// TODO: finish confirmation styling
					var e = $('<div style="display: none; margin-top: 120px;" class="loading"><i class="fa fa-check-circle-o" style="font-size: 80px; margin: 16px;"></i><p>Request submitted successfully.</p><p>You will be notified by email as soon as the provider responds.</p></div>');
					$('#request-wizard').append(e)
					$(loading).fadeOut(function() {
						$(e).fadeIn();
					});
				}).fail(function(data){
					console.log(data);
					// TODO: show error page, reset
				})
			});

		}
	};

	function resetForm() {

		$("#request-wizard").hide(0, function() {
			$('.loading:first').fadeIn();
			$('#request-wizard .steps').hide();
			$('.results').html("");
			$('.request-results').hide()
			$('.step-list-header').hide()
			$(".text-wrapper").fadeIn();
		});
		
		provider_id = 0;
		$('input[name="name"]').val("")
		$('input[name="phone"]').val("")
		$('input[name="date"]').val("")
		$('select[name="hours"]').val(0)
		$('#address-line1').val("")
		$('#address-line2').val("")
		$('#city').val("")
		$('#state').val("")
		$('#zipcode').val("")
		$('textarea[name="comments"]').val("")
		$('input[name="stripeToken"]').val("")
		visible = false
	}

	 $('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay'
			},
			defaultView: 'agendaWeek',
			editable: true,
			eventOverlap: false,
			eventStartEditable: false,
			eventDurationEditable: false,
			minTime: "06:00:00",
			maxTime: "23:00:00",
			events: [
				{
					title: 'Available',
					start: '2015-05-05T06:00:00',
					end: '2015-05-05T23:00:00'
				},
				{
					title: 'Available',
					start: '2015-05-06T06:00:00',
					end: '2015-05-06T23:00:00'
				}
			],
			eventDragStart: function( e, jsEvent, ui, view ) { 
				console.log(e);
			},
			dayClick: function(date, jsEvent, view) {
				var other = $('#calendar').fullCalendar('clientEvents', function(event) {
	                if(event.start <= date && event.end >= date) {
	                    return true;
	                }
	                return false;
	            });
	            console.log(other);
	            // if(other.length == 0) {
	            	var myEvent = {
						title:"Available",
						allDay: false,
						start: date,
						end: date.clone().add(2, 'hours')
					};
					var d_start_string = date.format('MMMM Do YYYY, h:mm:ss a');
					var d_end_string = date.clone().add(2, 'hours').format('MMMM Do YYYY, h:mm:ss a');
					$('#calendar').fullCalendar('renderEvent', myEvent);
					$.post('api/availability.php', {start: d_start_string, end: d_end_string});
	            // }
				
			},
			eventRender: function(event, element) {
			      element.bind('dblclick', function() {
			      	console.log(event);
		         	var d_start_string = event.start.format('MMMM Do YYYY, h:mm:ss a');
					var d_end_string = event.end.format('MMMM Do YYYY, h:mm:ss a');
					$('#calendar').fullCalendar('removeEvents', [event._id]);
					$.post('api/availability.php', {start: d_start_string, end: d_end_string, remove: true});
			      });
			   }
    })

	 $('button.login').click(function(e) {
	 	console.log("why");
	 	$.post('api/login.php', {email: $('#email').val(), password: $('#password').val(), type: 'user'}).done(function(data) {
	 		// TODO: show other field after populating data
	 		console.log(data);
	 		var data = JSON.parse(data);
	 		$('input[name="name"]').val(data.name);
	 		$('input[name="phone"]').val(data.phone);

	 		$('.auth').fadeOut(function(){
	 			$('.info').fadeIn();
	 		})
		}).fail(function(data){
			$('#email').addClass('invalid');
			$('#password').addClass('invalid');
		})
		e.preventDefault();
	 })

	 $('.validate-address').click(function() {
	 	// TODO: validate fields
	 	// TODO: save data for later?
	 	$("#request-wizard").steps('next');
	 })
});