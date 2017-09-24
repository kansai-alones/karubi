    $(window).on('load', function () {
        $('.selectpicker').selectpicker({
            'selectedText': 'cat'
        });
    });

    $(function(){
        $('#changeSelect').change(function() {
            if ($('#changeSelect option:selected').val() == 1) {
                $('#school').css('display','block');
                $('#company').css('display','none');
            }
            else if($('#changeSelect option:selected').val() == 2) {
                $('#school').css('display','none');
                $('#company').css('display','block');
            }
            else {
                $('#company').css('display','block');
                $('#school').css('display','none');
            }
        });
    });