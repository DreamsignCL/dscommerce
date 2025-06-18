jQuery(document).ready(function($) {
    $('.upload_image_button').each(function() {
        const button = $(this);

        button.on('click', function(e) {
            e.preventDefault();

            const inputField = $(this).prev('input');

            const customUploader = wp.media({
                title: 'Selecciona o sube una imagen',
                button: {
                    text: 'Usar esta imagen'
                },
                multiple: false
            });

            customUploader.on('select', function() {
                const attachment = customUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
            });

            customUploader.open();
        });
    });
});
