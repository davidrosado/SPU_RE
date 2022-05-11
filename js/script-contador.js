	// add an action
	acf.addAction('prepare', function(){
		var contador = acf.get('contador');
	});

	console.log(contador)

	document.addEventListener( 'wpcf7submit', function( event ) {	
	  var inputs = event.detail.inputs
	 
	  for ( var i = 0; i < inputs.length; i++ ) {
	    if ( 'NOMBRES_PROSPECTO' == inputs[i].name ) {
	      alert( inputs[i].value );
	      break;
	    }
	  }

	  /*ejecutar acá la función php */
	}, false );
