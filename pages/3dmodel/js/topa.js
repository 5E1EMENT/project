var topaBtn = document.querySelector('.btn_view_topa');

topaBtn.addEventListener('click', function () {

	//Считываем параметры с ячеек таблицы
    l = parseInt($(this).closest('.table-row').find('.l').attr('data-l'));
    d = parseInt($(this).closest('.table-row').find('.d').attr('data-d'));
    w = parseInt($(this).closest('.table-row').find('.w').attr('data-w'));
    ub = parseInt($(this).closest('.table-row').find('.ub').attr('data-ub'));

    //Инициализируем канвас
	var topaWrapper = document.querySelector('.wrapper-topa');
	var topa = document.createElement('canvas');
	var k = 500 / l;
	topa.setAttribute('width',l * k + 10 + 'px');//x 
	topa.setAttribute('height',w * k + 10 + 'px');//x 
	// topa.style.width = l * k + 'px';//y
	// topa.style.height = w * k + 'px';//y
	topa.id = 'canvas-topa'; 
    topaWrapper.appendChild(topa);
    ctx     = topa.getContext('2d');
    ctx.fillStyle = 'white';
    ctx.strokeStyle = 'black'; 

    //Запрос
    let result =  new Promise ( (resolve,reject) => {
        let xhr = new XMLHttpRequest;
        xhr.open('POST', '/pages/3dmodel/dataHole.json', false);
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
                //console.log(ResultArr);

               for(item in ResultArr) {
               		//console.log(item);
               	//while(item) {
               		var dd=ResultArr[item];
               		var x=dd[0];
               		var y=dd[1];
               		 console.log('x:',x,'y:',y);
                	ctx.beginPath();
                	ctx.arc(x*k+5,w*k+5 - y*k, 2, 0, Math.PI * 2, true); // Outer circle
				    ctx.stroke();
                //}
               } 	
               


        } 
      );

	

//ось координат
 
	ctx.fillRect(0, 0, topa.width, topa.height);
	ctx.stroke();
			console.log(1);

})

