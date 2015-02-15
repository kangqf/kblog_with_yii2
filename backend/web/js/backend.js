/**
 * Created by kqf on 15-2-15.
 */
$( document ).ready(function() {
    var phpClickCount = 1;
    $('#phpInfo').on('click', function() {
        if(phpClickCount % 2){
            $.ajax({
                url: '/site/index',
                type: 'get',
                success: function(data) {
                    document.getElementById('info').innerHTML = data;
                }
            });
        }
        else{
            document.getElementById('info').innerHTML = '';
        }
        phpClickCount++;
    });
});

