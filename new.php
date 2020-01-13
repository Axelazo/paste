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
                    <textarea id="editor" name="paste-content"></textarea>
                </div>
            </div>
            <div class="row">
                <div id="status-message" class="col">
                    <div id="success" class="alert alert-success fade show" role="alert" style="display: none;">
                        <strong>¡EXCELENTE!</strong> El paste se ha creado con éxito!.
                    </div>
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
                <h5 class="modal-title" id="linkModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="linkModalBody"class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        if (!tinymce.get('editor')) {
            AddTinyMCE();
        } else {
            tinymce.remove('#editor')
            AddTinyMCE();
        }

        $('#save').click(function() {
            var p_title = $('#title').val();
            var p_content = tinymce.get('editor').getContent()
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
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#paste-create").removeAttr("disabled");
                            $('#paste-form').find('input:text').val('');
                            content = "";
                            tinymce.get('editor').setContent(content);
                            $("#success").show();
                            setTimeout(function() {
                                $("#success").hide();
                            }, 5000);
                        } else if (dataResult.statusCode == 201) {
                            alert("Ha ocurrido un error conectándose a la base de datos!");
                        }
                    }
                });
                return false;
            } else {
                $("#warning").show();
                setTimeout(function() {
                    $("#warning").hide();
                }, 5000);
            }
        });

    });

    function AddTinyMCE() {
        console.log("added tinymce");
        tinymce.init({
            selector: 'textarea#editor',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker link',
            toolbar: 'a11ycheck casechange checklist code formatpainter insertfile pageembed permanentpen table link',
            height: "400",
        });
    }
</script>