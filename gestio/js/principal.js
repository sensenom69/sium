var principal = {
    elemento_a_borrar : 0,
    elemento_con_foco : "",
    nuevoAjax : function (){
        var xmlhttp=false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    },
    autentifica: function(id_form){
        
        if(valida.valida(id_form)){
           var retorno = this.irSincrono("exec/ajax/autentificar.php","email="+$("#email").val()+"&pass="+$("#pass").val());
           switch (retorno){
                case '0':{
                    valida.mostrarError($("#email"),"El usuario no existe.");return false;break;
                }
                case '1':{
                    valida.mostrarError($("#pass"),"El pass no es correcto.");return false;break;
                }
                case '3':{
                    location.href = "index.php";return false;break;
                }
                default:{
                    alert("Error del sistema, comuniquese con el administrador: 644422001");return false;break;
                }
           }
           return true;
        }
        return false;
    },
    salir: function(){
        window.location = "http://solimar.ideas2bits.com";
        this.ir("exec/ajax/cerrarSesion.php","cerrar=true");
        
    },
    ir : function(url,datos){        
        var dialogo = utilidades.mostrarDialogCargando();
        peticion=this.nuevoAjax();
        peticion.open("POST", url, true);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && (peticion.status == 200 || window.location.href.indexOf ("http") == - 1)){     
                dialogo.modal("hide");         
            }else{
                dialogo.modal("hide");
            } 
             $("#cargando").each(function(){
                $(this).remove()
            });
        }    
    },
    esActiu :function (){
        var retorno  = "mesa";
        $('ul.nav li').each(function(){
            if($(this).hasClass('active')){
                retorno = $(this).attr('id').split('_')[1]; 
            }
        })
        return retorno;
    },
    guardarTaules : function(params){
         var porDefecto = {
            id: 0,
            recarga: false
        }
        $.extend(porDefecto,params);
        var dialogo = utilidades.mostrarDialogCargando();
        var datos = "num_evento="+$("#id_evento").val()+"&num_salo="+$("#id_salon").val()+"&";
        $(".arrastable").each(function(){
            var posicion = $(this).position();
            var id = $(this).attr("id").split("_");
            if(rotate_angle[id[1]]==undefined)
                rotate_angle[id[1]]=0;
            x = $(this).css("left");
            y = $(this).css("top");
            if(params.id==$(this).attr("id")){
                x = params.x;
                y = params.y;
            }
            //datos += "id_"+$(this).attr("id")+"="+$(this).attr("id")+"&posx_"+$(this).attr("id")+"="+posicion.left+"&posy_"+$(this).attr("id")+"="+posicion.top+"&nom_"+$(this).attr("id")+"="+$("#nom_"+$(this).attr("id")).html()+"&tipo_"+$(this).attr("id")+"="+$(this).attr("data-action")+"&angle_"+$(this).attr("id")+"="+rotate_angle[id[1]]+"&";
            datos += "id_"+$(this).attr("id")+"="+$(this).attr("id")+"&posx_"+$(this).attr("id")+"="+x+"&posy_"+$(this).attr("id")+"="+y+"&nom_"+$(this).attr("id")+"="+$("#nom_"+$(this).attr("id")).html()+"&tipo_"+$(this).attr("id")+"="+$(this).attr("data-action")+"&id_tipo_mesa_"+$(this).attr("id")+"="+$(this).attr("data-id_tipo_mesa")+"&angle_"+$(this).attr("id")+"="+rotate_angle[id[1]]+"&";
            datos += "plazas_"+$(this).attr("id")+"="+$(this).attr("data-plazas")+"&"
        });
        peticion=this.nuevoAjax();
        /*
        peticion.open("POST", "secciones/mesa/guardar_pos_mesa.php", true);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && (peticion.status == 200 || window.location.href.indexOf ("http") == - 1)){ 
                //alert(peticion.responseText)
                dialogo.modal("hide");
                
                return peticion.responseText;          
            }else{
                $("#cargando").remove(); 
            } 
        }   
        */ 
        peticion.open("POST", "secciones/mesa/guardar_pos_mesa.php", false);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        dialogo.modal("hide");
         $("#cargando").each(function(){
            $(this).remove()
        });
        if(params.recarga)
            window.location.reload();
        return peticion.responseText;
    },
    guardarTaula : function(id,x,y){
        var dialogo = utilidades.mostrarDialogCargando();
        var datos = "num_evento="+$("#id_evento").val()+"&num_salo="+$("#id_salon").val()+"&";
        var posicion = $("#"+id).position();
        var id_numero = id.split("_");
        if(rotate_angle[id[1]]==undefined)
                rotate_angle[id[1]]=0;
            //datos += "id_"+$(this).attr("id")+"="+$(this).attr("id")+"&posx_"+$(this).attr("id")+"="+posicion.left+"&posy_"+$(this).attr("id")+"="+posicion.top+"&nom_"+$(this).attr("id")+"="+$("#nom_"+$(this).attr("id")).html()+"&tipo_"+$(this).attr("id")+"="+$(this).attr("data-action")+"&angle_"+$(this).attr("id")+"="+rotate_angle[id[1]]+"&";
        datos += "id_"+id+"="+id+"&posx_"+id+"="+$("#"+id).css("left")+"&posy_"+id+"="+$("#"+id).css("top")+"&nom_"+id+"="+$("#nom_"+id).html()+"&tipo_"+id+"="+$("#"+id).attr("data-action")+"&angle_"+id+"="+rotate_angle[id_numero[1]]+"&";
        
        /*$(".arrastable").each(function(){
            var posicion = $(this).position();
            var id = $(this).attr("id").split("_");
            if(rotate_angle[id[1]]==undefined)
                rotate_angle[id[1]]=0;
            //datos += "id_"+$(this).attr("id")+"="+$(this).attr("id")+"&posx_"+$(this).attr("id")+"="+posicion.left+"&posy_"+$(this).attr("id")+"="+posicion.top+"&nom_"+$(this).attr("id")+"="+$("#nom_"+$(this).attr("id")).html()+"&tipo_"+$(this).attr("id")+"="+$(this).attr("data-action")+"&angle_"+$(this).attr("id")+"="+rotate_angle[id[1]]+"&";
            datos += "id_"+$(this).attr("id")+"="+$(this).attr("id")+"&posx_"+$(this).attr("id")+"="+$(this).css("left")+"&posy_"+$(this).attr("id")+"="+$(this).css("top")+"&nom_"+$(this).attr("id")+"="+$("#nom_"+$(this).attr("id")).html()+"&tipo_"+$(this).attr("id")+"="+$(this).attr("data-action")+"&angle_"+$(this).attr("id")+"="+rotate_angle[id[1]]+"&";
        });
        */
        peticion=this.nuevoAjax();
        peticion.open("POST", "secciones/mesa/guardar_pos_mesa.php", false);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        dialogo.modal("hide");
         $("#cargando").each(function(){
            $(this).remove()
        });
        return peticion.responseText;
    },
    irSincrono: function(url,datos){
        var dialogo = utilidades.mostrarDialogCargando();
        peticion=this.nuevoAjax();
        peticion.open("POST", url, false);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        dialogo.modal("hide");
         $("#cargando").each(function(){
            $(this).remove()
        });
        return peticion.responseText;
    },
    irASincrono: function(url,datos,divrespuesta){
        //var dialogo = utilidades.mostrarDialogCargando();
        peticion=this.nuevoAjax();
        peticion.open("POST", url, false);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        //dialogo.modal("hide");
         $("#cargando").each(function(){
            $(this).remove()
        });
        
        return $('#'+divrespuesta).html(peticion.responseText);
    },
    irA : function(url,datos,divrespuesta){
        var dialogo = utilidades.mostrarDialogCargando();
        peticion=this.nuevoAjax();
        peticion.open("POST", url, true);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(datos);
        peticion.onreadystatechange = function() {
            if (peticion.readyState == 4 && (peticion.status == 200 || window.location.href.indexOf ("http") == - 1)){
                dialogo.modal("hide");
                $("#cargando").each(function(){
                    $(this).remove()
                }); 
                $('#'+divrespuesta).html(peticion.responseText);
            }else{
                dialogo.modal("hide"); 
                 $("#cargando").each(function(){
                    $(this).remove()
                }); 
            }
        }
    },
    aceptarFormularioDatos : function (url, formid,divrespuesta ,url_redireccion,datos_redir,datos){
        
        var dialogo = utilidades.mostrarDialogCargando();    
        /*if(!valida.valida(formid)){
            dialogo.modal("hide");
            $("#cargando").each(function(){
                $(this).remove()
            }); 
            return false;
        }
        */
        var Formulario = document.getElementById(formid);
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos='';
        $('#'+formid+' input:text').each(function(){
            cadenaFormulario += sepCampos+$(this).attr('id')+'='+encodeURI($(this).val());
            sepCampos="&";
        });
        $('#'+formid+' input:file').each(function(){
            var archivos = document.getElementById($(this).attr("id"));//Damos el valor del input tipo file
            var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo;
            //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo
            var data = new FormData();
            //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
            //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
            //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
            for(i=0; i<archivo.length; i++){
                data.append('archivo'+i,archivo[i]);	
            }
            //data.append('texto',texto);
            
            $.ajax({
                url:'../exec/uploader.php', //Url a donde la enviaremos
                type:'POST', //Metodo que usaremos
                contentType:false, //Debe estar en false para que pase el objeto sin procesar
                data:data, //Le pasamos el objeto que creamos con los archivos
                processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
                cache:false //Para que el formulario no guarde cache
                }).done(function(msg){
                    ; //Mostrara los archivos cargados en el div con el id "Cargados"
                    //alert(texto);
            });	
            
            cadenaFormulario += sepCampos+$(this).attr('name')+'='+encodeURI($(this).val());
            sepCampos="&";
        });
        //$('#'+formid+' input:hidden').each(function(){
         //   cadenaFormulario += sepCampos+$(this).attr('id')+'='+encodeURI($(this).val());
          //  sepCampos="&";
        //});
        $('#'+formid+' input:checkbox').each(function(){
            cadenaFormulario += sepCampos+$(this).attr('id')+'='+encodeURI($(this).is(":checked")?"1":"0");
            sepCampos="&";
        });
        $('#'+formid+' select').each(function(){
            cadenaFormulario += sepCampos+$(this).attr('id')+'='+encodeURI($(this).val());
            sepCampos="&";
        });
        $('#'+formid+' textarea').each(function(){
            cadenaFormulario += sepCampos+$(this).attr('id')+'='+encodeURI($(this).val());
            sepCampos="&";
        });
        
        peticion=this.nuevoAjax();
        peticion.open("POST", url, true);
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        peticion.send(cadenaFormulario+"&"+datos);
        peticion.processData = false;
        
        peticion.onreadystatechange = function() {
            
            if (peticion.readyState == 4 && (peticion.status == 200 || window.location.href.indexOf ("http") == - 1)){
                //alert(peticion.responseText);
                //principal.irA(url_redireccion,datos_redir,divrespuesta);
                window.location.replace(url_redireccion);
                return false;
            }
            dialogo.modal("hide");
            $("#cargando").each(function(){
                $(this).remove()
            }); 
        }        
        return false;
    },
    busquedainvitadoLlistat : function(busqueda){
        principal.irASincrono("secciones/mesa/llistat_invitados.php","id_evento="+$("#id_evento").val()+"&id="+elemento_activado+"&tipo_mesa="+$("#mesa_"+elemento_activado).attr("data-action")+"&nombre="+busqueda,"modal_listado_invitados_mesa #llistat_invitados");
    },
    busquedacliente :  function(busqueda){
        principal.irASincrono("secciones/cliente/listado.php","id_evento="+$("#id_evento").val()+"&busqueda="+busqueda+"&alfabetico="+alfabetico,"cos");
        $("#search_nom").focus();
        var valor = $("#search_nom").val();
        $("#search_nom").val("");
        if(!alfabetico)
            $("#search_nom").val(valor);
    }
}
var utilidades = {
    mostrarDialogCargando: function(){
        var $dialog = $('<div id="cargando"></div>')
			.html('<img src="../img/cargando.gif" width="50px"/>');
            /*
        var $dialog = $('<div></div>')
			.html('<img src="../img/cargando.gif" width="50px"/>')
			.dialog({
				autoOpen: false,
				title: 'Carregant',
                resizable: false,
                modal:true
			});
        $dialog.dialog('open');
        */	
        var $dialog = $(
        '<div id="cargando" class="modal hide fade" style="width:133px;" "><div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h4>Cargando</h4>'+
            '<div class="modal-body">'+
            '<img src="img/cargando.gif"/>'+
            '</div>'+
        '</div></div>');
			$dialog.modal('show');
        return $dialog;	
    },
    mostrarDialogBorrar: function(){
        var $dialog = $(
        '<div id="borrar" class="modal hide fade">'+
        '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
        '<h3>Atenci&oacuten</h3>'+
        '</div>'+
        '<div class="modal-body">'+
        '<p>Desea borrar el evento</p>'+
        '</div>'+
        '<div class="modal-footer">'+
        '<a href="#" onclick="javascript:alert(\"hey\");" class="btn">No</a>'+
        '<a href="#" class="btn btn-primary">Si</a>'+
        '</div>'+
        '</div>');
        $dialog.modal('show');
        return $dialog;	
    }
}

