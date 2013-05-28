function ImageCrop(target, wrap, modal) {
  this.target = target;
  this.wrap   = wrap;
  this.modal  = modal;
  // Recupera o objeto img de dentro do modal, nao do jeito mais elegante...
  this.modalWrap = document.getElementById(modal.id).
    getElementsByTagName('div').item(1).
    getElementsByTagName('img').item(0);
  this.setCropListener();
}
        
ImageCrop.prototype.setCropListener = function() {
  var modal = this.modal;
  var modalWrap = this.modalWrap;
  var self = this;

  this.target.addEventListener('change', function(e) {
    var file   = e.currentTarget.files[0];
    var reader = new FileReader();
    
    reader.onload = (function(imageFile) {
        return function(evt) {
            modalWrap.src = evt.target.result;
            $('#' + modal.id).modal();
        };
    })(file);
    reader.readAsDataURL(file);
    //self.initJcrop();
  }, false);
}

/**
 * Seta coordenadas no DOM
 * É necessário ter os inputs no documento
 */
ImageCrop.prototype.setCoords = function(coords) {
  jQuery('#x').val(coords.x);
  jQuery('#y').val(coords.y);
  jQuery('#x2').val(coords.x2);
  jQuery('#y2').val(coords.y2);
  jQuery('#w').val(coords.w);
  jQuery('#h').val(coords.h);
}

ImageCrop.prototype.initJcrop = function() {
  var modal  = this.modal;
  var modalWrap = this.modalWrap;
  $.Jcrop(modal, {
    onChange: ImageCrop.prototype.setCoords,
    onSelect: ImageCrop.prototype.setCoords,
    /**
     * Passa o tamanho natural (ou real) da imagem para que as coordenadas sejam passadas de acordo
     * 
     * @see http://deepliquid.com/content/Jcrop_Sizing_Issues.html
     */
    trueSize: [modalWrap.naturalWidth, modalWrap.naturalHeight]
  });
}