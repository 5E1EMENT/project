// Кнопка просмотр 3д модели
var btnView = $('.btn_view');
var loadingArea = $('.loading-area');

//Контейнер для отрисовки
var container = document.getElementById( 'scene' );

//Функция построения модели !!!!
var buildModel = function (l,d,w,ub) {

//Считываем параметры с ячеек таблицы
    l = parseInt($(this).closest('.table-row').find('.l').attr('data-l'));
    d = parseInt($(this).closest('.table-row').find('.d').attr('data-d'));
    w = parseInt($(this).closest('.table-row').find('.w').attr('data-w'));
    ub = parseInt($(this).closest('.table-row').find('.ub').attr('data-ub'));

    //Выводим их в консоль
    console.log(l,d,w,ub);


// Стандартные глобальные переменные
var  scene, camera, renderer, control, stats, cube;




// Кастомные глобальные переменные


//Функция инициализации
function init() {

    //Условие, если есть активный класс у кнопки по которой нажали
    if(that.hasClass('active-btn')) {


        renderer = new THREE.WebGLRenderer({
            //Сглаживание
            antialias: true
        });

        //Высота
        height = window.innerHeight-(window.innerHeight/10);

        //Ширина
        width = window.innerWidth;

        //Угол обзора
        fov = 20;

        //Соотношение сторон
        aspect = width/height;

        //Приближение
        near = 1;

        //Отдаление
        far = 10000;

        //Создаем камеру
        camera = new THREE.PerspectiveCamera(fov, aspect, near, far);

        //Создаем сцену
        scene = new THREE.Scene();

        //Заливаем сцену цветом
        scene.background = new THREE.Color(0xffffff);
        renderer.setClearColor(0xffffff);

        //Размер сцены
        renderer.setSize(width, height);

        //Прикрепляем сцену к контейнеру

        container.appendChild( renderer.domElement );

        //Инициализируем функцию вращения
        createOrbit();

        //Размер сетки
        let gridL = l*2;

        //Функция отрисовки сетки
    (function grid(size) {
        var gridXZ = new THREE.GridHelper(gridL, size/ub);
        //Функция проверки на чётность длины модели

        const even = n => !(n % 2);
        //Позиция сетки
        var gPositionY = ub/2;//Смещение по высоте
        var gPosition; //Позиция сетки
        var lPosition; //Позиция линий
        //проверки на чётность длины модели
         if(even(l)) {
            gPosition = l/2 - gPositionY;
             lPosition = l/2 + gPositionY;
             console.log('even')
         } else {
             gPosition = l/2;
             lPosition = l/2;
             console.log('noteven')
         }
        //Позиция линий
        gridXZ.position.set(gPosition,-gPositionY,gPosition );
        scene.add(gridXZ);

        // var gridXY = new THREE.GridHelper(size, size/ub);
        // gridXY.position.set( l,l,-l );
        // gridXY.rotation.x = Math.PI/2;
        // //gridXY.setColors( new THREE.Color(0x000066) );
        // scene.add(gridXY);
        //
        // var gridYZ = new THREE.GridHelper(size, size/ub);
        // gridYZ.position.set( -l,l,l );
        // gridYZ.rotation.z = Math.PI/2;
        // //gridYZ.setColors( new THREE.Color(0x660000) );
        // scene.add(gridYZ);

        var lineL = gridL * 1.5;
        //Отрисовка направляющей линии Y (Зеленая)
        var origin = new THREE.Vector3(-lPosition,-gPositionY,-lPosition);
        var terminus  = new THREE.Vector3(0,50,0);
        var direction = new THREE.Vector3().subVectors(terminus, origin);
        var arrow = new THREE.ArrowHelper(direction, origin, lineL, 0x008000);

        //Отрисовка направляющей линии X (Красная)
        var copyX = new THREE.Vector3().copy(origin);
        var terminusX  = new THREE.Vector3(1000000,-gPositionY,-gPositionY);
        var directionX = new THREE.Vector3().subVectors(terminusX, origin);
        var arrow2 = new THREE.ArrowHelper(directionX, copyX, lineL, 0xff0000);


        //Отрисовка направляющей линии Z (Синяя)
        var copyZ = new THREE.Vector3().copy(origin);
        var terminusZ  = new THREE.Vector3(-lPosition,-gPositionY,-gPositionY);
        var directionZ = new THREE.Vector3().subVectors(terminusZ, origin);
        var arrow3 = new THREE.ArrowHelper(directionZ, copyZ, lineL, 0x0000ff);


        scene.add(arrow);
        scene.add(arrow2);
        scene.add(arrow3);
           })(gridL);

        //Добавление подписей


    } else {

        btnView.removeClass('active-btn');
        return false;
    }

}

//Функция отрисовки
function draw(x,y,z,color,pi,ub) {
    if(that.hasClass('active-btn')) {
        //Геометрия куба(глубина, ширина, высота)
        let cubeGeom = new THREE.BoxGeometry(ub, ub, ub);

        //Материал для рисования геометрических фигур
        //Задаем цвет, прозрачность
        let cubeMat = new THREE.MeshBasicMaterial({color: color, transparent: true, opacity: pi/100});

        // События при изменении размера окна
        THREEx.WindowResize(renderer, camera);
        THREEx.FullScreen.bindKey({charCode: 'm'.charCodeAt(0)});

        //Плоскость
        cube = new THREE.Mesh(cubeGeom, cubeMat);

        //Позиция куба
        cube.position.set(x, z, y);

        //Прикрепляем куб к сцене
        scene.add(cube);

        //Цвет обводки
        var hex = 0x000000;
        var bbox = new THREE.BoundingBoxHelper(cube, hex);
        bbox.update();
        scene.add(bbox);
        //После выполнения отрисовки, убираем прелоадер
        loadingArea.removeClass('active-loader');

    }

};
//Создаем свет
function initLight() {
        light = new THREE.DirectionalLight(0xffffff, 1);
        light.position.set(-25, 50, 50);
        scene.add(camera);
        camera.add(light);
        camera.position.set(0, 0, 500);
}

//Создаем орбиту вращения куба
function createOrbit() {

    control = new THREE.OrbitControls(camera, renderer.domElement);
    control.enableZoom = true
    control.update();

}
//Создаем функцию рендера
function render() {
        renderer.render(scene, camera);
        requestAnimationFrame(render);
}
//Функция очистки

    //Обёртке прелоадеру добавляем класс загрузки
    $('.loading-area').addClass('active-loader');
    //Сохраняем контекст
    var that = $(this);
    //Запускаем через маленький промежуток времени, чтобы сработал прелоадер


    setTimeout(function () {

        //Если у кнопки Просмотр нет активного класса, то добавим
        if(!that.hasClass('active-btn')) {
            //location.reload();
            //Уберём неактивность у всех кнопок
            btnView.attr('disabled', false);
            //Добавим класс актив
            btnView.removeClass('active-btn');
            that.toggleClass('active-btn');
            //Сделаем ее неактивной
            that.attr('disabled', true);
            //Номер модели
            var nmod = that.attr("data-nmod");
            //Чтобы вместе с загрузкой появлялась панель
            $('.canvas-wrapper').css('display','flex');
            //Инициализируем
               init();
            //Проходимся циклом по длине
            console.time('q');

            
                //Запрос
                let result =  new Promise ( (resolve,reject) => {
                    let xhr = new XMLHttpRequest;
                    xhr.open('POST', '/pages/3dmodel/data.json', false);

                    xhr.onload = function() {
                          if (this.status == 200) {
                            resolve(this.response);




                          } else {
                            var error = new Error(this.statusText);
                            error.code = this.status;
                            reject(error);
                          }
                        };

                        xhr.onerror = function() {
                          reject(new Error("Network Error"));
                        };

                    xhr.send();

                });
            
            result
              .then(
                function(result) {
                        let ResultArr = JSON.parse(result);
                            console.log(ResultArr);
                          for (var x=0; x<=l; x=x+ub) {
                                        //Проходимся циклом по ширине
                                        for (var y=0; y<=w; y=y+ub) {
                                            //Проходимся циклом по глубине
                                            for (var z=0; z<d; z=z+ub) {
                                                //Цвет
                                              
                                               var dd = ResultArr[x][y][z];
                                                var c = 0xFFFFFF;
                                                var xxx=0;
                                                c = 0xff0000;
                                                xxx=0;

                                                var zzzzz=dd[0];

                                                
                                               if(zzzzz==1){
                                                c = 0xc6c44d;
                                                xxx=25;
                                                if(dd[2]>0) {
                                                        c = 0x000066;
                                                        xxx=dd[2];
                                                     //Отрисовать
                                                    //}
                                               //c=0xff0000;        
                                                };
                                                draw(y,x,d-z-1,c,xxx,ub); 
                                            };    
                                                

                                                 

                                            }
                                        }
                            }
            

                } 
                
              );


           

            console.timeEnd('q');
            //Рендерим
            render();
            //Добавляем свет
            initLight();
            //Если нет активного класса, то убираем неактивность у кнопки
        } else {

            that.attr('disabled', false);
            that.removeClass('active-btn');



        }
    },300)
    //проверка на наличие детей у контейнера, если больше 0 то удалять первый
    if(container.childNodes.length > 0) {
        container.firstChild.remove();

    }

}


//По кнопке ПРОСМОТР запускам функцию построения модели

 btnView.on('click',buildModel);













// var example = document.getElementById("model-canvas"),
//     ctx     = example.getContext('2d');
//     ctx.fillStyle = 'green';
//     ctx.strokeStyle = 'black'; 
//     var scale = example.width/40/2;//40 - получить из максимального размера месторождения из php
//     var pointX = (example.width/8)-30;
//     var pointY = (example.height/2)+140;
//     var nx = 40; //получить из php
//     var ny =40;//получить из php
//     var nz= 8;//получить из php
//     var block = new Array([[]]);
//     var xx;
//     var yy;
//     var zz;
//     var y;
//     var x;

 
// //ось координат
//     ctx.moveTo(pointX, pointY);
//     ctx.lineTo(pointX, pointY - (scale*40)+5);
//     ctx.moveTo(pointX, pointY);
//     ctx.lineTo(pointX + (scale*40)*Math.cos(30*3.14/180), pointY - (scale*40)*Math.sin(30*3.14/180));
//     ctx.moveTo(pointX, pointY);
//     ctx.lineTo(pointX + (scale*40)*Math.cos(30*3.14/180), pointY + (scale*40)*Math.sin(30*3.14/180));
	
// 	ctx.fillRect(0, 0, example.width, example.height);
// 	ctx.stroke();
			
// //Отрисовка

// function draw(color) {


// 	    	// block[x][y][z] =1;
// 	    	ctx.fillStyle = color;
	
// 	    	xx = pointX + scale*(Math.cos(30*3.14/180)*y+Math.cos(30*3.14/180)*x);
// 	    	yy = pointY - scale*(Math.sin(30*3.14/180)*y-Math.sin(30*3.14/180)*x);
// 	    	ctx.beginPath();
// 			ctx.moveTo(xx,yy-scale*zz); 
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(pointX + scale*(Math.cos(30*3.14/180)*(y+ub)+Math.cos(30*3.14/180)*(x+ub)),pointY - scale*(Math.sin(30*3.14/180)*(y+ub)-Math.sin(30*3.14/180)*(x+ub))-scale*zz); 
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy-Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(xx,yy-scale*zz);
// 			ctx.strokeStyle = 'black'; 
// 	     	ctx.stroke();
// 	     	ctx.fill();

// 	     	ctx.beginPath();
// 			ctx.moveTo(xx,yy-scale*zz);
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+scale*ub+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(xx,yy+scale*ub-scale*zz);
// 			ctx.lineTo(xx,yy-scale*zz);
// 			ctx.strokeStyle = 'black'; 
// 	     	ctx.stroke();
// 	     	ctx.fill();

// 	     	ctx.beginPath();
// 			ctx.moveTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+scale*ub+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 			ctx.lineTo(pointX + scale*(Math.cos(30*3.14/180)*(y+ub)+Math.cos(30*3.14/180)*(x+ub)),pointY+scale*ub - scale*(Math.sin(30*3.14/180)*(y+ub)-Math.sin(30*3.14/180)*(x+ub))-scale*zz);
// 			ctx.lineTo(pointX + scale*(Math.cos(30*3.14/180)*(y+ub)+Math.cos(30*3.14/180)*(x+ub)),pointY - scale*(Math.sin(30*3.14/180)*(y+ub)-Math.sin(30*3.14/180)*(x+ub))-scale*zz);
// 			ctx.lineTo(xx+ub*Math.cos(30*3.14/180)*ub*scale,yy+Math.sin(30*3.14/180)*ub*scale-scale*zz); 
// 	    	ctx.strokeStyle = 'black'; 
// 	     	ctx.stroke();
// 	     	ctx.fill();

  
// }
// 		var c;
// 	for (var z=0;z<=40;z++) {
// 			zz=z;
//     	for (y = 40; y >= 0; y--) {
    		
// 	    	for (x = 0; x <= 40; x++) {
// 	    	var i = Math.round(Math.random()*20);
// 	    	if (i==1) {
// 	    	  	draw('red');}
// 			if (i==2) {
// 	    	  	draw('blue');}
// 	    	if (i==3) {
// 	    	  	draw('purple');}
// 	    	if (i==4) {
// 	    	  	draw('white');}
// 	    	if (i==4) {
// 	    	  	draw('yellow');}    	  	

// 	   }
//     }
//    }
    


