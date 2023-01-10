$(document).ready(function(){
	
	$(".regras").click(function() {
	
		$("#regras_inline").fadeIn(800, function() {
			$(this).show();
		});
	
	});
	
	$(".regras_aceito").click(function() {
	
		$('#termos').attr('checked', true);
		$("#regras_inline").fadeOut(400, function() {
			$(this).hide();
		});
		
		
	});
	
	$("#regras_close").click(function() {
	
		$("#regras_inline").fadeOut(400, function() {
			$(this).hide();
		});
		
		
	});
	
	
	$(".regras_nao").click(function() {
	
		$("#regras_inline").fadeOut(400, function() {
			$(this).hide();
		});
		window.location='index.php';
		
		
	});
	
	
	$("#regresh_codigo").live('click', function() {
		var timestamp = new Date().getTime();
		$("#codigo_seguranca").attr('src','configs/img.php?'+timestamp);
		$('#codigo').addClass("text").removeClass('text_error');
		$("#codigo_error").hide();
		erro = false;	
		$('#codigo').focus();	
	});

	$('#codigo').blur(function() {
		
		if( $(this).val() == '' ) {
			$("#codigo_ok").hide();
			$(this).removeClass("text_ok").addClass("text_error");
			$(this).removeClass("text").addClass("text_error");
			$("#codigo_error").show();
			$("#codigo_error").html('<strong>Enter the confirmation code!</strong>');
			erro = true;
			return false;
		}else{		
			$(this).removeClass("text").addClass("text_ok");
			$("#codigo_error").hide();
			erro = false;
		}
		
	})	
	
})