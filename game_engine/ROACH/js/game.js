var cvs = document.getElementById("canvas");
var ctx = cvs.getContext("2d");
// var win;
// vat lose;
// var user1;
// var user2;
// Создание переменных
var bug_1 = new Image();
var bug_2 = new Image();
var bg = new Image();
var fg1 = new Image();
var fg2 = new Image();
var fin = new Image();
var gap = 220;
// Впихивание файлов в переменные
bug_1.src = "/game_engine/ROACH/img/bug1.png";
bug_2.src = "/game_engine/ROACH/img/bug1.png";
bg.src = "/game_engine/ROACH/img/kovrik.jpg";
fin.src = "/game_engine/ROACH/img/finish.png";
fg1.src = "/game_engine/ROACH/img/fg.png";
fg2.src = "/game_engine/ROACH/img/fg.png";

// Ассоциативные массивы с координатами жуков
var bug_crd_1 = [];
var bug_crd_2 = [];
bug_crd_1[0] = {
	x : 100,
	y : cvs.height - 120
}
bug_crd_2[0] = {
	x : 100 + gap,
	y : cvs.height - 120
}
// document.createElement('div');
function draw(){

	ctx.drawImage(bg, 0, 0);
	ctx.drawImage(fg1, 120, 0);
	ctx.drawImage(fg2, 120 + gap, 0);
	ctx.drawImage(fin, 0, 0);
	for(var i = 0; i < bug_crd_1.length; i++){
		ctx.drawImage(bug_1, bug_crd_1[i].x, bug_crd_1[i].y);
		ctx.drawImage(bug_2, bug_crd_2[i].x, bug_crd_2[i].y);
		var rand_num_1 = Math.random() * (5 - 0.00001) + 0.00001;// Создание рандомных переменных при каждом вызове
		var rand_num_2 = Math.random() * (5 - 0.00001) + 0.00001;// Создание рандомных переменных при каждом вызове
		bug_crd_1[i].y -= rand_num_1;
		bug_crd_2[i].y -= rand_num_2;
		/*console.log('Левый таракан находится в координате', bug_crd_1[i].y);
		console.log('Правый таракан находится в координате', bug_crd_2[i].y);*/
		if((bug_crd_1[i].y <= fin.height - 51) || (bug_crd_2[i].y <= fin.height - 51)){
			if(bug_crd_2[i].y <= fin.height - 51){
				/*var win = "right";
				document.getElementById('win').innerHTML = win;*/
				ctx.fillStyle = "#EA1935";
				ctx.font = "39px Verdana";
				ctx.fillText("Выиграл правый таракан!", 0, 63);
			}else if(bug_crd_1[i].y <= fin.height - 51){
			/*var win = "left";
			document.getElementById('win').innerHTML = win;*/
			ctx.fillStyle = "#EA1935";
			ctx.font = "39px Verdana";
			ctx.fillText("Выиграл левый таракан!", 0, 63);
				// AJAX
			}
		}else{
			requestAnimationFrame(draw);
		}
	}
} 
fg2.onload = draw; // .onload - проверка на загруженность (если fg2 загружен, выполнить draw)
/*$("#roachform").submit(function() {
	var roach = $("#roachform").serialize();
	$.ajax({
		type: 'POST',
		url: 'gameroach',
		data: {roach: roach},
		dataType: 'json',
		success: function() {
		}        
	});
	console.log(roach);
	return false;        
});*/
