$(document).ready(function() {
    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        $('#mainContent').append('<p>' + e.data + '</p>');
    };

    conn.onclose = function(e) {
        console.log("Connection closed!");
    };

    conn.onerror = function(e) {
        console.log("Error occurred: ", e);
    };

    $('#mainContent').click(function() {
        conn.send("Hello Server!");
    });
});
