var valida = {
    vacio: function(objecte){  
        if($(objecte).val()==""){
            valida.mostrarError(objecte,"El campo es necesario");
            return true;
        }
        return false;
    },
    valida: function(id_form){
        $("div.error").each(function(){
            $(this).removeClass("error");
        })
        $(".error").hide();
        
        var hi_ha_error = false;
        $('#'+id_form+' input:text').each(function(){
            var esta_buit = false;
            if($(this).is(":visible")){
                if($(this).hasClass("precis")){
                    esta_buit = valida.vacio($(this));
                    if(esta_buit){
                        hi_ha_error =  true;
                    }
                    if(!esta_buit && $(this).hasClass("precis")){   
                        if(!valida.validatipo($(this))){
                            hi_ha_error =  true;
                        }
                    } 
                }  
                else{
                    if(!valida.validatipo($(this)))
                            hi_ha_error =  true;  
                }
            }     
                         
        });
        
        $('#'+id_form+' textarea').each(function(){
            esta_buit = valida.vacio($(this));
            if(esta_buit)
                hi_ha_error =  true;
        });
        $('#'+id_form+' input:password').each(function(){
            esta_buit = valida.vacio($(this));
            if(esta_buit)
                hi_ha_error =  true;
        });
        
        if(hi_ha_error){
            return false;
        }
        return true;
        
    },
    mostrarError: function(objecte,mensaje){
        $("#error_"+$(objecte).attr("id")).html(mensaje);
        $("#error_"+$(objecte).attr("id")).show();
        $("#contenedor_"+$(objecte).attr("id")).addClass("error");
    },
    validatipo: function(obj){
        var sense_error = true;
        var posibles_validacions = ["lletres","numeros","telefon","email"];
       
        for(var i=0;i<posibles_validacions.length && sense_error;i++){
            if($(obj).hasClass(posibles_validacions[i]))
                switch(posibles_validacions[i]){
                    case "lletres": 
                        if(!valida.validaLletres($(obj).val())){
                            valida.mostrarError(obj,"El campo no puede tener n&uacutemeros.");
                            sense_error = false;
                            return false;
                        }
                        return true;
                        break;
                    case "numeros":
                        if(!valida.validaNumeros($(obj).val())){
                            valida.mostrarError(obj,"El campo no puede tener letras ni simbolos.");
                            sense_error = false;
                            return false;
                        }
                        return true;
                        break;
                    case "telefon":
                        if(!valida.validaNumeros($(obj).val())){
                            valida.mostrarError(obj,"El campo no puede tener letras ni simbolos.");
                            sense_error = false;
                            return false;
                        }else if( $(obj).val()!="" && $(obj).val().length<9){
                            valida.mostrarError(obj,"El telefono debe tener como m&iacutenimo 9 n&uacutemeros.");
                            sense_error = false;
                            return false;
                        }
                        return true;
                        break;
                    case "plazas":
                        ;
                        return true; 
                        break;
                    case "email":
                        if(!valida.validaEmail($(obj).val())){
                            valida.mostrarError(obj,"El e-mail no es correcto");
                            return false;
                        }
                        return true;
                        break;
                    default:return true;
                }
        }
        return true;
    },
    validaLletres: function(texto){
        for(i=0; i<texto.length; i++){
            if (valida.numeros.indexOf(texto.charAt(i),0)!=-1 || valida.simbols.indexOf(texto.charAt(i),0)!=-1){
                return false;
            }
        }
        return true;
    },
    validaNumeros: function(texto){
        for(i=0; i<texto.length; i++){
            if (valida.lletres.indexOf(texto.charAt(i),0)!=-1 || valida.simbols.indexOf(texto.charAt(i),0)!=-1){
                return false;
            }
        }
        return true;   
    },
    validaTelefon: function(texto){
        this.validaNumeros(texto)
        return true;
    },
    validaEmail: function(texto){
        if(texto.charAt(0)=='@' || texto.charAt(texto.length-1)=='@' || valida.numeros.indexOf(texto.charAt(texto.length-1),0)!=-1 || valida.simbols.indexOf(texto.charAt(texto.length-1),0)!=-1 )
            return false;
        if(texto.indexOf(".")==-1)
            return false;
        var sub = texto.substr(texto.indexOf('@'));
        if(sub.indexOf('.')<2)
            return false;
        if(texto.match(/@/g).length!=1)
            return false;
        return true;
    },
    validaPlazas: function(max_plazas,plazas_act,plazas){
        if(plazas_act+plazas>max_plazas){
            return false;
        }
        return true;
    }
    ,
    lletres: "abcdefghyjklmnñopqrstuvwxyzABCDEFGHYJKLMNÑOPQRSTUVWXYZ",
    numeros: "0123456789",
    simbols: "@!\"·$%&/()=?¿¡'~€,.-_:;¨{}+^*[]\\"
}