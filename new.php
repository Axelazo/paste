<?php require_once('header.php');?>
<?php if(!$_SESSION['loggedin']) {
    header('location: login.php');
}?>
<div class="row" style="margin:25px">
    <div class="col-lg-9 justify-content-center">
        <form id="paste-form" method="post">
            <div class="row">
                <div class="col">
                    <label>TÍTULO DEL PASTE</label>
                    <input id="title" type="text" name="paste-title" class="form-control" placeholder="Avatar (2009) 1080p Dual Latino-Inglés">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>CONTENIDO DEL PASTE</label>
                    <textarea id="editor" name="paste-content"><p>Contenido del paste aquí</p></textarea>
                </div>
            </div>
            <div class="row">
                <div id="status-message" class="col">
                    <div id="warning" class="alert alert-warning fade show" role="alert" style="display: none;">
                        <strong>¡Rayos!</strong> Parece que te has olvidado del <strong>TÍTULO</strong> o <strong>CONTENIDO</strong>!.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="button" name="save" class="btn btn-success float-right" value="Save to database" id="save">
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3">
        <div class="alert alert-warning fade show text-left" role="alert">
            <strong>¡Recomendaciones!</strong>
            <ol>
                <li>No uses sólo <strong>MAYÚSCULAS</strong></li>
                <li>Sólo puedes usar <strong>ouo.io</strong></li>
                <li>Sube a los servidores elegidos por <strong>la comunidad</strong></li>
                <li>Sigue el estilo de publicación elegido por <strong>la comunidad</strong></li>
            </ol>
        </div>
    </div>
</div>
<div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="linkModalTitle">Paste credo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="linkModalBody"class="modal-body">
                <div id="success" class="alert alert-success fade show" role="alert">
                    <strong>¡EXCELENTE!</strong> El paste se ha creado con éxito!.
                </div>
                <div class="row">
                    <div class="col-12">
                        <input id="pasteLinkPh" class="form-control" type="text" placeholder="Readonly input here…" readonly>
                    </div>
                    <div class="col-12">
                        <a id="pasteLink" class='btn btn-warning mr-2'><i class="material-icons">link</i> Copiar link</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var viewID;

        $('#save').click(function() {
            $("#save").attr("disabled", "disabled");
            var p_title = $('#title').val();
            var p_content = $('#editor').summernote('code');

            if (p_title != "" && p_content != "") {
                $.ajax({
                    url: "save.php",
                    type: "POST",
                    data: {
                        title: p_title,
                        content: p_content,
                    },
                    async: true,
                    success: function(dataResult) {
                        console.log(dataResult);
                        var dataResult = JSON.parse(dataResult);
                        viewID = dataResult.viewId;
                        if (dataResult.statusCode == 200) {
                            $("#save").removeAttr("disabled");
                            $('#paste-form').find('input:text').val('');
                            emptystr = "";
                            $('#editor').summernote('code',emptystr);
                            $('#pasteLinkPh').val(window.location.protocol + "//" + window.location.host + "/paste/view.php?viewID=" + viewID) // cambiar por base url al desplegar en internet
                            $("#linkModal").modal();
                        } else if (dataResult.statusCode == 201) {
                            alert("Ha ocurrido un error conectándose a la base de datos!");
                        }
                    }
                });
                return false;
            } else {
                $("#save").removeAttr("disabled");
                $("#warning").show();
                setTimeout(function() {
                    $("#warning").hide();
                }, 5000);
            }
        });

        $("#pasteLink").click(function(){
            $("#pasteLinkPh").focus(); 
            $("#pasteLinkPh").select(); 
            document.execCommand("copy");
            console.log("copied!");
        });

        $("#editor").summernote({
            height: 400,
            focus: true
        });

    });
</script>