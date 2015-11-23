window.addEventListener('load', clic_event, false);

function clic_event() {

    var boton_new = document.getElementById('nuevo');
    var boton_envia = document.getElementById('envia');
    var boton_cancel = document.getElementById('cancel');

    boton_new.addEventListener('click', show_new, false);
    boton_envia.addEventListener('click', enviar_ajax, false);
    boton_cancel.addEventListener('click', cancelar_form, false);

    // Se crea el evento para cada trash icon. Si alguno no existe el a_num augmentará de valor, hasta obtener el valor adecuado.
    var i, tr;
    $(document).ready(function() {
        var a_num = $('.trash_id').length;

        for (i = 1; i <= a_num; i++) {
            tr = document.getElementById('id' + i);
            if(tr===null){
                a_num++;
                tr = document.getElementById('id' + i);
            }
            if(tr!=null) {
                tr.addEventListener('click', delete_ajax, false);
            }
        }
    });

}

var back_formjs,back_form, oformjs, oform;
function show_new(){

    back_formjs = document.getElementById('back-ground-form');
    oformjs = document.getElementById('form');
    back_form = $('#back-ground-form');
    oform = $('#form');

    back_formjs.style.position = 'fixed';
    back_formjs.style.backgroundColor = 'black';
    back_formjs.style.Zindex = 1000;
    back_formjs.style.width = window.innerWidth+'px';
    back_formjs.style.height = window.innerHeight+'px';

    oformjs.style.position = 'fixed';
    oformjs.style.backgroundColor = 'white';
    oformjs.style.Zindex = 1001;
    oformjs.style.top = 20+'%';
    oformjs.style.paddingTop = 30+'px';
    oformjs.style.width = window.innerWidth-30+'px';
    oformjs.style.marginLeft = 15+'px';

    oform.css({display:'block'});
    oform.stop().animate({opacity:1}, 1000);
    back_form.css({display:'block'});
    back_form.stop().animate({opacity:0.6}, 1000);

    // z-index to -1 trash icons
    $('a').css({'z-index':-1});

    document.getElementById('name').focus(); // focus on first input form everytime to open for a new client


}
function cancelar_form(){
    hide_form();
}
function hide_form(){
    back_form.stop().animate({opacity:0}, 1000, function(){
        back_form.css({display:'none'});
    });
    oform.stop().animate({opacity:0}, 500, function(){
        oform.css({display:'none'});
        // z-index to 0 trash icons
        $('a').css({'z-index':0});
    });

}

var vals;
function values_form() {

    var name = document.getElementById('name').value;
    var ape = document.getElementById('ape').value;
    var fna = document.getElementById('fna').value;
    var pai = document.getElementById('pai').value;
    var sub = document.getElementById('envia').value;


    if( name == '' || ape == '' || fna == '' || pai == '') {
        vals = null;
    }
    else{
        vals = '&name='+encodeURIComponent(name)+
        '&ape='+encodeURIComponent(ape)+
        '&fna='+encodeURIComponent(fna)+
        '&pai='+encodeURIComponent(pai)+
        '&envia='+encodeURIComponent(sub);
    }

    return vals;

}

var conexio;
function enviar_ajax(){

    if(values_form() != null) {
        if(window.XMLHttpRequest) {
            conexio = new XMLHttpRequest();
        }
        conexio.onreadystatechange = envia_action;
        conexio.open('POST', 'action_client.php', true);
        conexio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        conexio.send(values_form());
    }else{
        var mens = document.getElementById('meensaje');

        mens.innerHTML='* Campos vacíos!';
    }

}

function envia_action(){

    var tbody = document.getElementsByTagName('tbody')[0];
    var mensaje = document.getElementById('mensaje');
    var mens = document.getElementById('mess');

    if( conexio.readyState == 4  && conexio.status == 200 ){

        mens.innerHTML='* Thanks! Cliente insertado!';
        mensaje.innerHTML='';

        oform.stop().animate({opacity:0}, 250, function(){
            oform.css({display:'none'});
            // z-index to 0 trash icons
            $('a').css({'z-index':0});
        });
        back_form.stop().animate({opacity:0}, 250, function(){
            back_form.css({display:'none'});

            tbody.innerHTML=conexio.responseText;
            clic_event();// load clic_event again, for tr objects from trah_ico new results

            document.getElementById('name').value = '' ;
            document.getElementById('ape').value = '';
            document.getElementById('fna').value = '';
            document.getElementById('pai').value = '';
        });

    }else{
        mensaje.innerHTML='* Registrando espere por favor...';
    }

}


function delete_ajax(e) {

    e.preventDefault();
    //
    if(window.XMLHttpRequest) {
        conexio = new XMLHttpRequest();
    }
    conexio.onreadystatechange = del_action;
    conexio.open('GET', 'action_client.php?id='+e.target.id, true);
    conexio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    conexio.send(null);

}

function del_action(){
    var tbody = document.getElementsByTagName('tbody')[0];
    var mens = document.getElementById('mess');

    if( conexio.readyState == 4  && conexio.status == 200 ){

        tbody.innerHTML=conexio.responseText;
        mens.innerHTML='* Eliminación satisfactoria!';
        clic_event();// load clic_event again, for tr objects from trah_ico new results

    }else{
        //alert("No action");
        mens.innerHTML='* Eliminando espere por favor...';
    }

}