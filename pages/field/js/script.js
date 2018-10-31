



$(document).ready(function() {
    $('#form_field').submit(function() { // проверка на пустоту заполненных полей. Атрибут html5 — required не подходит (не поддерживается Safari)


        // $.ajax({
        //     type: "GET",
        //     url: "/pages/php/field.php",
        //     data: $(this).serialize()
        // }).done(function() {
        //     $('.modal-overlay').fadeOut();
        //     alert("Спасибо!");
        //     $(this).find('input').val('');
        //     $('.form_field').trigger('reset');
        // });
        // return false;
    });
});
