$(document).ready(function () {
    let contador = document.getElementById("contador_usuarios");
    let host = "ws://localhost:8090";
    let socket = new WebSocket(host);

    socket.onmessage = function (msg)
    {
        contador.innerHTML = msg.data;
    }
});