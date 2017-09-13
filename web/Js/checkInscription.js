
var champUsername = document.getElementById("app_bundle_registration_type_username").value;
var champPassword = document.getElementById("app_bundle_registration_type_plainPassword_first").value;
var champEmail = document.getElementById("app_bundle_registration_type_email").value;

function Pseudominimum (){
    var champA = document.getElementById("app_bundle_registration_type_username").value;
    var message=  document.getElementById("messagePseudo");
    if(champA.length < 5 || champA.length>25){
        strHTML="<p>Pseudo entre 5 et 25 caracteres</p>";
        message.innerHTML=strHTML;
        document.getElementById('app_bundle_registration_type_valider').disabled = true;

        return false;

    }
    else{
        strHTML="<p></p>";
        message.innerHTML=strHTML;

        if(champEmail===0 || champPassword === 0){

        }
        else {
            document.getElementById('app_bundle_registration_type_valider').disabled = false;
        }


        return false;
    }
}

function Passminimum (){
    var champA = document.getElementById("app_bundle_registration_type_plainPassword_first").value;
    var message=  document.getElementById("messagePass");
    if(champA.length < 5 || champA.length>25){
        strHTML="<p>mot de passe : 5 caracteres minimum</p>";
        message.innerHTML=strHTML;
        document.getElementById('app_bundle_registration_type_valider').disabled = true;

        return false;

    }
    else{
        strHTML="<p></p>";
        message.innerHTML=strHTML;
        if(champEmail=== 0 || champUsername === 0){

        }
        else {
            document.getElementById('app_bundle_registration_type_valider').disabled = false;
        }
        return false;
    }
}

function emailminimum (){
    var champA = document.getElementById("app_bundle_registration_type_email").value;
    var message=  document.getElementById("messageEmail");
console.log(champA);
    if(champA.length < 5 || champA.length>25){
        strHTML="<p>Email obligatoire</p>";
        message.innerHTML=strHTML;
        document.getElementById('app_bundle_registration_type_valider').disabled = true;

        return false;

    }
    else{
        strHTML="<p></p>";
        message.innerHTML=strHTML;
        if(champUsername=== 0 || champPassword === 0){

        }
        else {
            document.getElementById('app_bundle_registration_type_valider').disabled = false;
        }
        return false;
    }
}



function init (){

    var pseudo= document.getElementById("app_bundle_registration_type_username");
    pseudo.oninput = Pseudominimum;

    var pass= document.getElementById("app_bundle_registration_type_plainPassword_first");
    pass.oninput = Passminimum;

   var email= document.getElementById("app_bundle_registration_type_email");
    email.oninput = emailminimum();



}


    document.getElementById('app_bundle_registration_type_valider').disabled = true;


window.onload=init;