jQuery(document).ready(function ($) {
   function custom_media_upload(button_class) {
      var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
      $('body').on('click', button_class, function (e) {
         var button_id = '#' + $(this).attr('id');
         var send_attachment_bkp = wp.media.editor.send.attachment;
         var button = $(button_id);
         _custom_media = true;
         wp.media.editor.send.attachment = function (props, attachment) {
            if (_custom_media) {
               $('.custom_media_image').attr('src', attachment.url);
               $('.custom_media_url').val(attachment.url);
            } else {
               return _orig_send_attachment.apply(button_id, [props, attachment]);
            }
         }
         wp.media.editor.open(button);
         return false;
      });
   }
   custom_media_upload('.custom_media_upload');
   $('body').on('click', '.custom_media_remove', function () {
      $('.custom_media_image').attr('src', '');
      $('.custom_media_url').val('');
   });
});
