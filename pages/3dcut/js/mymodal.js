
var btn = document.querySelector('#btn_add_cut');
// var btn1 = document.querySelector('.fadebtn');
var body = document.querySelector('body');
var div = document.querySelector('.div');
var overlayDiv = document.createElement('div');
overlayDiv.className = 'modal-overlay';
overlayDiv.innerHTML = '<div class="mymodal"></div>';
body.insertBefore(overlayDiv, div);
var overlay = document.querySelector('.modal-overlay');
var modal = document.querySelector('.mymodal');

var closeBtn = document.createElement('div');
closeBtn.className = 'close';
modal.appendChild(closeBtn);

closeBtn.onclick = function() {
    console.log(5);
    overlay.classList.remove('show');
    modal.classList.remove('show');
}

/*Инициализация
1)При загрузке добавить в body добавить дивы для попапа и оверлея
2)Задаем стили
3)При вызове метода open, дивы получают дисплей block.
При вызове метода close, дивы получают дисплей none.
На оверлей подвешиваем событие клик и вызвыаем close.
Метод open должен класть переданный html p.open('HTML');
*/

/*Можно было не добавлять класс modal внутрь оверлея, а сделать их siblings и
расставить их с помощью z-index;
Тогда не нужно было бы отслеживать событие клика по window  и ограничится просто
this.modal.onclick = popup.close;
*/
function Popup(obj) {

    this.overlay = document.querySelector(obj.overlay);
    this.modal = document.querySelector(obj.modal);
    this.closeBtn = document.querySelector('.close');

    var  popup = this;

    this.open = function(content) {
        console.log(content);
        div.innerHTML = content;
        this.modal.appendChild(div);
        this.overlay.classList.add('show');
        this.modal.classList.add('show');
    }

    this.close = function(content) {
        div.innerHTML = content;
        this.overlay.classList.remove('show');
        this.modal.classList.remove('show');
    }
    // this.overlay.onclick = popup.close;
    window.onclick = function(e) {
        const target = e.target;
        if(target == overlay ) {
            popup.close();
        }
    };

}
window.onload = function(){

    var p = new Popup({

        overlay: '.modal-overlay',
        modal: '.mymodal'


    });

    btn.onclick = function() {
        console.log(1);
        p.open('<form action="/pages/3dcut/3dcut.php" name="add1" class="form_cut form-group" id="form_cut" method="GET">' +
            'Имя разреза или карты   <input class="form-control" type="text" name="namemap"/> ' +
            'Разрез по X   <input class="form-control" type="radio" name="rbx"/> ' +
            'Разрез по Y <input class="form-control" type="radio" name="rby"/>' +
            'Карта по Z   <input class="form-control" type="radio" name="rbz"/>' +
            'Значение координаты <input class="form-control" type="text" name="coordinate"><br>'+
            '<button type="submit" class="btn btn-xs btn-primary" id="cut_submit" name="cut_add" >Подтвердить</button> ' +
            '</form>');
        //var form = document.querySelector('обёртка для сверстанной формы');
        //для обертки дать display:none;
        //p.open(form.innerHTML);
        //Свойство innerHTML позволяет получить HTML-содержимое элемента в виде строки.
    };

    //btn1.onclick = function() {
    //    p.open('<div class="oo">РАБОТАЕТ БЛЯ!</div>');
    // };


};
