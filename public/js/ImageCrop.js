function ImageCrop(target, wrap, modal) {
    this.target = target;
    this.wrap   = wrap;
    this.modal  = modal;
    // Recupera o objeto img de dentro do modal, nao do jeito mais elegante...
    this.modalWrap = document.getElementById(modal.id).
      getElementsByTagName('div').item(1).
      getElementsByTagName('img').item(0);

    this.setCropListener = function() {
      var self   = this;
      this.target.addEventListener('change', function(e) {
        var file   = e.currentTarget.files[0];
        var reader = new FileReader();
        
        reader.onload = (function(imageFile){
          return function(evt) {
            self.modalWrap.src = evt.target.result;
          };
        })(file);
        reader.readAsDataURL(file);
        $('#'+self.modal.id).modal();
      }, false);

      $('#'+self.modal.id).bind('shown', function() {
        self.initJcrop();
      });

      $('#'+self.modal.id).bind('hidden', function() {
        self.eraseCoords();
      });
    }

    this.setCoords = function(coords) {
      jQuery('#x').val(coords.x);
      jQuery('#y').val(coords.y);
      jQuery('#x2').val(coords.x2);
      jQuery('#y2').val(coords.y2);
      jQuery('#w').val(coords.w);
      jQuery('#h').val(coords.h);
    }

    this.eraseCoords = function() {
      jQuery('#x').val('');
      jQuery('#y').val('');
      jQuery('#x2').val('');
      jQuery('#y2').val('');
      jQuery('#w').val('');
      jQuery('#h').val('');
    }

    this.initJcrop = function() {
      $.Jcrop(this.modalWrap, {
        onChange: this.setCoords,
        onSelect: this.setCoords,
        /**
         * Passa o tamanho natural (ou real) da imagem para que as coordenadas sejam passadas de acordo
         * 
         * @see http://deepliquid.com/content/Jcrop_Sizing_Issues.html
         */
        trueSize: [this.modalWrap.naturalWidth, this.modalWrap.naturalHeight]
      });
    }

    this.setCropListener();
}