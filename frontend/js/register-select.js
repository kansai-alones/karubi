    $(window).on('load', function () {
        $('.selectpicker').selectpicker({
            'selectedText': 'cat'
        });
    });

    $(function(){
        $('#changeSelect').change(function() {
            if ($('#changeSelect option:selected').val() == 'school') {
                $('#school').css('display','block');
                $('#company').css('display','none');
            }
            else if($('#changeSelect option:selected').val() == 'company') {
                $('#school').css('display','none');
                $('#company').css('display','block');
            }
            else {
                $('#company').css('display','block');
                $('#school').css('display','none');
            }
        });
    });