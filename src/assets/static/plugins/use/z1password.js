



function applyz1password(){
    $('input[data-provide="z1password"]').each(function() {
        var itemName=$(this).attr('name')
        var itemKey=$(this).attr('rsa-key-public')
        $(document).on('beforeSubmit', 'form', function () {
            var targer = $('input[name="'+itemName+'"]')
            
            var encrypt = new JSEncrypt();
            encrypt.setPublicKey(itemKey);
            var encrypted = encrypt.encrypt(targer.val());
            targer.val(encrypted)
        });
    });
}

applyz1password();