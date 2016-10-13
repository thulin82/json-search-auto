 $(document).ready(function(){

    $('#field').on('keyup keypress', function(event) {
        var keyCode = event.keyCode || event.which;
        if (keyCode === 13) { 
            event.preventDefault();
            return false;
        }
    });
    
    $('#field').on('input', function(event) {
        
    var test = $('#field').val();
    $('#output').removeClass().html('Searching...');
    
    if (test.length !== 0) {
     
      $.ajax({
        type: 'post',
        url: 'main.php',
        dataType: 'text',
        data: $('#form1').serialize(),
        success: function(data){
            $('#output').html(data);
            console.log('.ajax() request returned successfully.');
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log('.ajax() request failed: ' + textStatus + ', ' + errorThrown);    
        }
      });
    }
    $('#output').removeClass().html('');
    return false;
    });
});