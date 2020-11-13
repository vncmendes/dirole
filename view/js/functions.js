// function modalLogin(openModal) {
//   var display = document.getElementById("modalLR").style.display;
//   if (display == "block") {
//     document.getElementById("modalLR").style.display = "none";
//   } else {
//     document.getElementById("modalLR").style.display = "block";
//     document.querySelector("body").style.overflow = "hidden";
//   }
// }
// function removeModal(rmModal) {
//   var remove = "block";
//   if (remove == "") {
//     document.getElementById("modalLR").style.display = "none";
//   }
// }

function modalLoginP() {
  document.getElementById("modalLP").style.display = "block";
}

$("#carouselExampleIndicators .fechar, #modalLP").click(function(e) {
  if (e.target !== this) return;
  $("#modalLP").fadeOut(500);
});

function modalLogin() {
  document.getElementById("modalLR").style.display = "block";
}

$("#carouselExampleIndicators .fechar, #modalLR").click(function(e) {
  if (e.target !== this) return;
  $("#modalLR").fadeOut(500);
});

function signUPB() {
  document.getElementById("modalSignUPB").style.display = "block";
}

$("#carouselExampleIndicators .fecharSUB, #modalSignUPB").click(function(e) {
  if (e.target !== this) return;
  $("#modalSignUPB").fadeOut(500);
});

function signUPP() {
  document.getElementById("modalSignUPP").style.display = "block";
}

$("#carouselExampleIndicators .fecharSUP, #modalSignUPP").click(function(e) {
  if (e.target !== this) return;
  $("#modalSignUPP").fadeOut(500);
});
