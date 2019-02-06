function checkLogin() {

  // on recupere le login et mdp
  var username = $("#username").val();
  var password = $("#password").val();
//  alert('user : ' + username);

  //on definer l'action pour php
  var data_send = {'action':"checkLogin", 'username': username, 'password': password};

  //on demande à php verifier les informations
  $.ajax({
    url:"php/get_login.php",
    type:"POST",
    dataType:"json",
    data: data_send,

    // on Reponse de php
    success:function(reponsePhp){
      console.log("role : " + reponsePhp.role + " id : " + reponsePhp.id);

      // on cache le section login,
      $("#login_sec").css("display", "none");

      // si un etudiant {role =1} on affiche questionaire
      if(reponsePhp.role === "1") {
        $("#question_qcm_sec").css("display", "block");
      }

      if(reponsePhp.role === "2") {
        //si un ensignant {role =2}  formulaire creation
        $("#form_qcm_crea_sec").css("display", "block");
      }

    },
    error:function(err){
      alert("error");
    }
  });




}
