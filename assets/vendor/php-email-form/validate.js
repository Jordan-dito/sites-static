/**
* PHP Email Form Validation - v3.11
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );

      if ( recaptcha ) {
        if(typeof grecaptcha !== "undefined" ) {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, {action: 'php_email_form_submit'})
              .then(token => {
                formData.set('recaptcha-response', token);
                php_email_form_submit(thisForm, action, formData);
              })
            } catch(error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
        }
      } else {
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => {
      if( response.ok ) {
        return response.text();
      } else {
        // Manejar error de respuesta HTTP directamente
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.error-message').innerHTML = `HTTP Error: ${response.status} ${response.statusText}`;
        thisForm.querySelector('.error-message').classList.add('d-block');
        return null;
      }
    })
    .then(data => {
      if (!data) return; // Si hubo error HTTP, no procesar
      
      // Limpiar todos los mensajes antes de mostrar uno nuevo
      clearAllMessages(thisForm);
      
      // Intentar parsear como JSON
      try {
        const response = JSON.parse(data);
        if (response.status === 'success') {
          // Mostrar mensaje de éxito
          thisForm.querySelector('.sent-message').innerHTML = response.message;
          thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.reset(); 
        } else if (response.status === 'error') {
          // Mostrar error directamente
          thisForm.querySelector('.error-message').innerHTML = response.message;
          thisForm.querySelector('.error-message').classList.add('d-block');
        } else {
          // Respuesta JSON sin status válido
          thisForm.querySelector('.error-message').innerHTML = 'Invalid response format';
          thisForm.querySelector('.error-message').classList.add('d-block');
        }
      } catch (e) {
        // Si no es JSON válido, usar el comportamiento original
        if (data.trim() == 'OK') {
          thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.reset(); 
        } else {
          // Mostrar el error directamente
          thisForm.querySelector('.error-message').innerHTML = data || 'Form submission failed';
          thisForm.querySelector('.error-message').classList.add('d-block');
        }
      }
    })
    .catch((error) => {
      // Solo manejar errores de red o parsing críticos
      thisForm.querySelector('.loading').classList.remove('d-block');
      thisForm.querySelector('.error-message').innerHTML = 'Network error. Please try again.';
      thisForm.querySelector('.error-message').classList.add('d-block');
    });
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error.message || error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

  function clearAllMessages(thisForm) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').classList.remove('d-block');
    thisForm.querySelector('.sent-message').classList.remove('d-block');
  }

})();
