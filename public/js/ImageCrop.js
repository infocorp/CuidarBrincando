function ImageCrop(target, wrap) {
    this.target = target;
    this.wrap   = wrap;

    this.setCropListener = function() {
      var self   = this;
      this.target.addEventListener('change', function(e) {
        var file   = e.currentTarget.files[0];
        var reader = new FileReader();
        
        reader.onload = (function(imageFile){
          return function(evt) {
            self.wrap.src = evt.target.result;
          };
        })(file);
        reader.readAsDataURL(file);
      }, false);
    }

    this.setCoords = function(coords) {
      jQuery('#x').val(coords.x);
      jQuery('#y').val(coords.y);
      jQuery('#x2').val(coords.x2);
      jQuery('#y2').val(coords.y2);
      jQuery('#w').val(coords.w);
      jQuery('#h').val(coords.h);
    }

    this.initJcrop = function() {
      $.Jcrop(this.wrap, {
        onChange: this.setCoords,
        onSelect: this.setCoords,
        /**
         * Passa o tamanho natural (ou real) da imagem para que as coordenadas sejam passadas de acordo
         * 
         * @see http://deepliquid.com/content/Jcrop_Sizing_Issues.html
         */
        trueSize: [this.target.naturalWidth, this.target.naturalHeight]
      });
    }
}