var web = {
    enviaFormulari: function(id_form){
        if(valida.valida(id_form)){
            $("#"+id_form).submit();
        }
    }
}