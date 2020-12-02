var navItems = document.querySelectorAll('.navlink a[href^="#"]');

navItems.forEach(item => {
  item.addEventListener('click', scrollToIdOnClick);
});

function getScrollTopByHref(element) {
  var id = element.getAttribute('href');
  return document.querySelector(id).offsetTop;
}

function scrollToIdOnClick(event) {
  event.preventDefault();
  var to = getScrollTopByHref(event.target); // - 80 se quiser

  scrollToPosition(to);
}

function scrollToPosition(to) {
  window.scroll({
    top: to,
    behavior: "smooth",
  });

  // smoothScrollTo(0, to); usar essa parte caso queira usar a função para funcionar em outros navegadores function ~~ smoothScrollTo ~~
}

// function smoothScrollTo(endX, endY, duration) {
//   const startX = window.scrollX || window.pageXOffset;
//   const startY = window.scrollY || window.pageYOffset;
//   const distanceX = endX - startX;
//   const distanceY = endY - startY;
//   const startTime = new Date().getTime();

//   duration = typeof duration !== 'undefined' ? duration : 1000;

//   // Easing function
//   const easeInOutQuart = (time, from, distance, duration) => {
//     if ((time /= duration / 2) < 1) return distance / 2 * time * time * time * time + from;
//     return -distance / 2 * ((time -= 2) * time * time * time - 2) + from;
//   };

//   const timer = setInterval(() => {
//     const time = new Date().getTime() - startTime;
//     const newX = easeInOutQuart(time, startX, distanceX, duration);
//     const newY = easeInOutQuart(time, startY, distanceY, duration);
//     if (time >= duration) {
//       clearInterval(timer);
//     }
//     window.scroll(newX, newY);
//   }, 1000 / 60); // 60 fps
// };




function modalLoginP() {
  document.getElementById("modalLP").style.display = "block";
}

$("#carouselExampleIndicators .fechar, #modalLP").click(function(e) {
  if (e.target !== this) return;
  $("#modalLP").fadeOut(500);
});

//////////////////////////////////////

function modalLogin() {
  document.getElementById("modalLR").style.display = "block";
}

$("#carouselExampleIndicators .fechar, #modalLR").click(function(e) {
  if (e.target !== this) return;
  $("#modalLR").fadeOut(500);
});

//////////////////////////////

function modalLoginAdm() {
  document.getElementById("modalLA").style.display = "block";
}

$("#carouselExampleIndicators .fechar, #modalLA").click(function(e) {
  if (e.target !== this) return;
  $("#modalLA").fadeOut(500);
});

//////////////////////////////////////////

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

// functions reminderJS ->

var lembretesSelecionados = [];

//funtion deletar
function deletarLembrete() {
	if (lembretesSelecionados.length > 0) {
		var lembretesExistentes = localStorage.getItem("lembretes");
		if (lembretesExistentes != null || lembretesExistentes != "" ) {
			var lembretesRecuperados = JSON.parse(lembretesExistentes);
			for (var i = 0; i < lembretesSelecionados.length; i++) {
				for (var j = 0; j < lembretesSelecionados.length; j++) {
					if (lembretesSelecionados[i] == lembretesRecuperados[j].id) {
						lembretesRecuperados[j].id =-1;
					}
				}
			}
			var lembretesTemporario = [];
			for (var i = 0; i < lembretesRecuperados.length; i++) {
				if (lembretesRecuperados[i].id != -1) {
					lembretesTemporario.push(lembretesRecuperados[i]);
				}
			}

			//delete lembrete
			if (lembretesTemporario.length == 0) {
				localStorage.setItem("lembretes", "");
			}
			else {
				salvarLembretes(lembretesTemporario);
			}

			mostrarLembretes();
			selecionarLembrete();
		}
	}
}


//funtion verificar se há texto.
function textoValido(texto) {
	if (texto == null || texto == "" || texto.length < 1) {
		return false;
	}
	else {
		return true;
	}
}

//funtion mostra erros.
function mostrarErro() {
	var html = "";
	html += '<div class="alert alert-danger" role="alert">';
	html += 'Anote para não esquecer !';
	html += '</div>';

	document.getElementById('error').innerHTML = html;
}

function limparErros() {
	document.getElementById("error").innerHTML = "";
}

function criandoLembrete() { //createRecordatorio
	var conteudoTextArea = document.getElementById("texto").value;
	if (!textoValido(conteudoTextArea)) {
		mostrarErro();
		return;
	}

	limparErros();

	//var dos tempos
	var referencia = new Date();
	var id = referencia.getTime();
	var data = referencia.toLocaleDateString(); //ver se fica com () ou não, se é função ou não. toLocaleDateString();
	var texto = conteudoTextArea;

	//json = objeto javascript, tipo de retorno de dados.
	var lembrete = {"id": id, "data": data, "texto": texto}; //recordatorio

	//function para ver se existe o lembrete
	checkLembrete(lembrete); //comprovarRecordatorio
	document.getElementById("texto").value = "";

}

function lembreteValido(lembretesExistentes) { //recordatorioValido ---- aqui ele bota no plural cuidar
	if (lembretesExistentes == null || lembretesExistentes == "" || typeof lembretesExistentes == "undefined" || lembretesExistentes == "undefined" ) {
		return false;
	}
	else {
		return true;
	}
}

function checkLembrete(lembrete) { //comprovarRecordatorio
	var lembretesExistentes = localStorage.getItem("lembretes"); // cuidar se é lembrete ou lembretes
	if (!lembreteValido(lembretesExistentes)) {
		var lembretes = [];
		lembretes.push(lembrete);

		//salvar lembrete
		salvarLembretes(lembretes); // saveRecordatorio
	}
	else {
		var lembretesRecuperados = JSON.parse(lembretesExistentes);
		//salvar lembrete
		lembretesRecuperados.push(lembrete);
		salvarLembretes(lembretesRecuperados); // saveRecordatorio
	}
	mostrarLembretes();
}

// recuperar lembretes
function selecionarLembrete() {
	console.log('1');
	var lembretes = document.getElementsByClassName("lembrete");
	console.log('2');
	 // erro aqui. talvez seja getElementById();
	for (var i = 0; i < lembretes.length; i++) {
		console.log('3');
		document.getElementById(lembretes[i].id).onclick = function(e) {
			e.stopPropagation();
			//caso tenha lembrete
			if (lembretesSelecionados.indexOf(this.id) == -1) {
				console.log('4');
				this.style.backgroundColor = "red";
				lembretesSelecionados.push(this.id);
			}
			else {
				console.log('5');
				this.style.backgroundColor = "#41dff4";
				for (var j = 0; j < lembretesSelecionados.length; j++) {
					if(lembretesSelecionados[j] == this.id) {
						lembretesSelecionados[j] = 0;
					}
				}
			}
			console.log('6');
			var lembreteTemporario = [];
			console.log(lembreteTemporario);
			for (var k = 0; k < lembretesSelecionados.length; k++) {
				if (lembretesSelecionados[k] != 0) {
					lembreteTemporario.push(lembretesSelecionados[k]);
				}
			}
			
			lembretesSelecionados = lembreteTemporario;
			console.log(lembretesSelecionados);
		};
	}
}

// salvar lembrete
function salvarLembretes(lembretes) {
	var lembretesJSON = JSON.stringify(lembretes);
	localStorage.setItem("lembretes", lembretesJSON);
}

//exibir itens
function mostrarLembretes() {
	var html = "";
	var lembretesExistentes = localStorage.getItem("lembretes");
	if (!lembreteValido(lembretesExistentes)) { // ver o nome da funcao. acho que ele usa recordatorioValido

		html = "Não existem lembretes !";
		document.getElementById("lembretes").innerHTML = html;
	}
	else {
		// var lembretesRecuperados; //estava fuçando aqui
		// lembretesRecuperados - JSON.parse(lembretesExistentes); // no video parece ser ( - ) em vez de ( = )
		var lembretesRecuperados = JSON.parse(lembretesExistentes);
		for (var i = 0; i < lembretesRecuperados.length; i++) {
			html += formatarLembrete(lembretesRecuperados[i]);
		}
		document.getElementById("lembretes").innerHTML = html;
	}
}

//function exibir lembretes
function formatarLembrete(lembrete) {
	var html = "";
	html += '<div class="lembrete" id="' + lembrete.id + '">';
	html += '<div class="row">';
	html += '<div class="col-6 text-left">';
	html += '<small><i class="fa fa-calendar-alt" aria-hidden="true"></i>' + lembrete.data + '</small>';
	html += '</div>';
	html += '<div class="col-6 text-right">';
	// html += '<small><i class="fa fa-window-close" aria-hidden="true"></i></small>';
	html += '</div>';
	html += '</div>';
	html += '<br>';
	html += '<div class="row">';
	html += '<div class="col-12">';
	html += lembrete.texto;
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '<br>';

	return html;
}

document.addEventListener('DOMContentLoaded', function() {
	document.getElementById("buttonSave").onclick = criandoLembrete;
	document.getElementById("buttonDelete").onclick = deletarLembrete;
	mostrarLembretes();
	selecionarLembrete();

});

// end functions reminderJS
