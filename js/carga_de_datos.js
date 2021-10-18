
$(document).ready(function () 
{
    var consulta;
    //hacemos focus al campo de búsqueda
    $("#txt_b").focus();
    $("#btn_b").on("click keyup", function (e) 
    {
        if (e.type == "keyup" && e.which != 13) return;
        //obtenemos el texto introducido en el campo de búsqueda
        consulta = $("#txt_b").val();
        //alert (consulta);
        //hace la búsqueda
        $.ajax({
            type: "GET",
            url: $("body").data("pagina_busqueda"),
            data: "b=" + consulta,
            dataType: "html",
            beforeSend: function () {
                //imagen de carga
                $("#capa_L").html("<p align='center'><img src='images/ajax-loader.gif' /></p>");
            },
            error: function () {
                alert("error petición ajax");
            },
            success: function (data) {
                $("#capa_L").empty();
                $("#capa_L").append(data);
            }
        });
    });
});


function cargar(div, desde) {
    $(div).load(desde);
}


function cargar_archivo(archivo, tipo) {
    var ruta = "libros_d/" + archivo;
    $.ajax({
        type: "POST",
        url: "ver_archivo.php",
        data: { archivo: ruta, tipo: tipo }
    }).done(function (html) {
        $("#capa_d").html(html);
    });
}

function prestar(id) {
    $.ajax({
        type: "POST",
        url: "prestamo.php",
        data: { id_lib: id }
    }).done(function (html) {
        $('#capa_d').html(html);
    });
}

function devolver(id) {
    $.ajax({
        type: "POST",
        url: "devolucion.php",
        data: { id_lib: id }
    }).done(function (html) {
        $("#capa_d").html(html);
    })
}

function editar(id) {

    $.ajax({
        type: "POST",
        url: $("body").data("pagina_form"),
        data: { operacion: 'edicion', id_obj: id }
    }).done(function (html) {
        $('#capa_d').html(html);
    });
}

function ver_info(id) {

    $.ajax({
        type: "POST",
        url: $("body").data("pagina_form"),
        data: { operacion: 'ver', id_obj: id }
    }).done(function (html) {
        $('#capa_d').html(html);
    });
}

function borrar(id) {

    $.ajax({
        type: "POST",
        url: $("body").data("pagina_form"),
        data: { operacion: 'baja', id_obj: id }
    }).done(function (html) {
        $('#capa_d').html(html);
    });
}


function ver(id) {


    $.ajax({
        type: "POST",
        url: $("body").data("pagina_form"),
        data: { operacion: 'edicion', id_obj: id }
    }).done(function (html) {
        $('#capa_d').html(html);
    });
}


function upload_image(id) {//Funcion encargada de enviar el archivo via AJAX
    var msg = [".upload-msg", ".upload-msg1"];
    var dest = ["fileToUpload", "fileToUpload1"];
    $(msg[id]).text('Cargando...');
    var inputFileImage = document.getElementById(dest[id]);
    var file = inputFileImage.files[0];
    var data = new FormData();
    data.append(dest[id], file);

    $.ajax({
        url: "subir_img_c.php",        // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: false,        // To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {
            $(msg[id]).html(data);
            window.setTimeout(function () {
                $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    });

}


function upload_pdf()
//Funcion encargada de enviar el archivo via AJAX
{
    $(".upload-msg").text('Cargando...');
    var inputFileImage = document.getElementById("fileToUpload");
    var file = inputFileImage.files[0];
    var data = new FormData();
    data.append('fileToUpload',file);
                            
    $.ajax({
        url: "subir_pdf_d.php",        // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            $(".upload-msg").html(data);
            window.setTimeout(function() {
            $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
            });	}, 5000);
        }
    });				
}


function poner_cat() {
    var opt = $("#sel_categoria option:selected").text();
    //alert (opt);
    $("#tit_categoria").val(opt);

}


function preview() {
    var shtml = '<div class="plantilla' + $("#tit_Plantilla").val() + '">' +
        '<div style="background-image: url(images/cartelera/' + $("#t_file1").val() + ');">' +
        '<header>            <h1>' + $("#tit_titulo").val() + '</h1>        </header>    </div>';

    if ($("#tit_link").val() != '') {
        shtml = shtml + '<nav><a href="' + $("#tit_link").val() + '" target="_blank">' + $("#tit_titulo").val() + ' en la web</a></nav>';
    }

    shtml = shtml + '<article> ' + $("#aut_texto").val() + ' </article>';

    if ($("#t_file").val() != '' && $("#aut_texto1").val() != '' && $("#aut_texto2").val() != '') {
        shtml = shtml + '<div id="cartel_imagen" class="row">' +
            '<div class="col-sm-4">' + $("#aut_texto1").val() + '</div>' +
            '<div class="col-sm-4"><img src="images/cartelera/' + $("#t_file").val() + '">' +
            '</div> <div class="col-sm-4">' + $("#aut_texto2").val() + '</div>' +
            '</div>';
    }

    if ($("#t_file").val() != '' && $("#aut_texto1").val() == '' && $("#aut_texto2").val() == '') {
        shtml = shtml + '<div id="cartel_imagen" class="row">' +
            '<div class="col-sm-2">' + '  ' + '</div>' +
            '<div class="col-sm-10"><img src="images/cartelera/' + $("#t_file").val() + '">' +
            '</div>';
    }

    if ($("#t_file").val() != '' && $("#aut_texto1").val() != '' && $("#aut_texto2").val() == '') {
        shtml = shtml + '<div id="cartel_imagen" class="row">' +
            '<div class="col-sm-6">' + $("#aut_texto1").val() + '</div>' +
            '<div class="col-sm-6"><img src="images/cartelera/' + $("#t_file").val() + '">' +
            '</div>';
    }

    if ($("#t_file").val() != '' && $("#aut_texto1").val() == '' && $("#aut_texto2").val() != '') {
        shtml = shtml + '<div id="cartel_imagen" class="row">' +
            '<div class="col-sm-6"><img src="images/cartelera/' + $("#t_file").val() + '">' +
            '</div> <div class="col-sm-6">' + $("#aut_texto2").val() + '</div>' +
            '</div>';
    }

    if ($("#tit_fechaD").val() != '' || $("#tit_fechaH").val() != '') {
        shtml = shtml + '<footer><h3>' + $("#tit_fechaD").val() + '  ' + $("#tit_fechaH").val() + '</h3></footer>';
    }

    shtml = shtml + '</div>';
    $('#capa_L').html(shtml);
}

function abrirPU(tit, tex) {
    //alert ('CLick');
    $('#titulo_PU').html(tit);
    $('#texto_PU').html(tex);
    $('#popup').fadeIn('slow');
    $('.popup-overlay').fadeIn('slow');
    $('.popup-overlay').height($(window).height());
    return false;
}

function cerrarPU() {
    $('#popup').fadeOut('slow');
    $('.popup-overlay').fadeOut('slow');
    return false;
}