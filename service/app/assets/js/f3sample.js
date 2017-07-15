$(function () {
    $('button').on('click', function () {
        var html = "";

        $.ajax({
            type: "get",
            url: "http://localhost:8888/api/messages",
            dataType: "json",
            success: function (response) {
                /*
                for (msg of response)
                {
                    html += '<p>' + msg.id + ' ' + msg.message + '</p>';
                }*/
                for (var i = 0; i < response.length; i++) {
                    var ctr=0;
                    for (attr in response[i]) ctr++;
                    html += '<p>' + response[i].id + ' ' + response[i].message + '</p>';
                }
                $('#msg-container').html(html);
            },
            error: function (jqXHR, status, error) {
                alert('error: ' + response +jqXHR.responseText + status + error);
            }
        });
    });
});

$(function () {
    $(document).on('ready', function () {
        var html = "";

        $.ajax({
            type: "get",
            url: "http://localhost:8888/api/messages",
            dataType: "json",
            success: function (response) {
                /*
                 for (msg of response)
                 {
                 html += '<p>' + msg.id + ' ' + msg.message + '</p>';
                 }*/
                for (var i = 0; i < response.length; i++) {
                    var ctr=0;
                    for (attr in response[i]) ctr++;
                    html += '<p>' + response[i].id + ' ' + response[i].message + '</p>';
                }
                $('#msg-container2').html(html);
            },
            error: function (jqXHR, status, error) {
                alert('error: ' + response +jqXHR.responseText + status + error);
            }
        });
    });
});

