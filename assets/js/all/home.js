document.addEventListener('DOMContentLoaded', function () {
   const homeForm = document.getElementById('homeForm');

   homeForm.addEventListener('submit', function (event) {
      event.preventDefault();

      let formData = new FormData(homeForm);
      formData.append('action', 'register_ajax_callback');
      formData.append('_ajax_nonce', ajax.ajaxNonce);
      fetch(ajax.ajaxUrl, {
         method: 'POST',
         body: formData,
      })
         .then((response) => response.json())
         .then((data) => {
            if (data.hasOwnProperty('data')) {
               var mensagem = data.data.message;
               var dataResponse = document.getElementById('dataResponse');
               if (dataResponse) {
                  dataResponse.innerHTML = mensagem;
                  dataResponse.classList.remove('hidden');
                  dataResponse.classList.add('block')
                  setTimeout(function () {
                     dataResponse.classList.add('hidden');
                     dataResponse.classList.remove('block')
                  }, 5000);
               }
            }
            if (data.hasOwnProperty('success')) {
               if (data.success === true) {
                  var homeForm = document.getElementById('homeForm');

                  if (homeForm) {
                     homeForm.reset();
                  }
               }
            }
         })
         .catch((error) => {
            console.error('Ocorreu um erro:', error);
         });
   });
});
