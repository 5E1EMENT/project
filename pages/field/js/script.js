$(document).ready(function(){


    function fetch_data()
    {
        $.ajax({
            url:"../../pages/php/field/select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }
    fetch_data();
    $(document).on('click', '#btn_add', function(){
        var nfield = $('#nfield').text();
        var namefield = $('#namefield').text();
        var x = $('#x').text();
        var y = $('#y').text();
        var z = $('#z').text();
        var l = $('#l').text();
        var d = $('#d').text();
        var w = $('#w').text();

        // if(nfield == '')
        // {
        //     new Noty({
        //         theme: 'nest',
        //         type: 'error',
        //         layout: 'topRight',
        //         timeout: 3000,
        //         text: 'Введите номер месторождения'
        //     }).show();
        //     return false;
        // }
        if(namefield == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите имя месторождения'
            }).show();
            return false;
        }
        if(x == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите Х координату'
            }).show();
            return false;
        }
        if(y == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите Y координату'
            }).show();
            return false;
        }
        if(z == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите Z координату'
            }).show();
            return false;
        }
        if(l == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите длину месторождения'
            }).show();
            return false;
        }
        if(d == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите глубину месторождения'
            }).show();
            return false;
        }
        if(w == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите ширину месторождения'
            }).show();
            return false;
        }
        $.ajax({
            url:"../../pages/php/field/insert.php",
            method:"POST",
            data:{nfield:nfield, namefield:namefield, x:x, y:y,z:z,l:l,d:d,w:w},
            dataType:"text",
            success:function(data)
            {
                new Noty({
                    theme: 'nest',
                    type: 'success',
                    layout: 'topRight',
                    timeout: 5000,
                    text: data
                }).show();
                fetch_data();
            }
        })
    });



    function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"../../pages/php/field/edit.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
                //$('#result').html("<div class='alert alert-success'>"+data+"</div>");
                new Noty({
                    theme: 'nest',
                    type: 'info',
                    layout: 'topRight',
                    timeout: 4000,
                    text: data
                }).show();
            }
        });
    }
    // $(document).on('blur', '.nfield', function(){
    //     var id = $(this).data("id1");
    //     var first_name = $(this).text();
    //     edit_data(id, first_name, "nfield");
    // });
    $(document).on('blur', '.namefield', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "namefield");
    });
    $(document).on('blur', '.x', function(){
        var id = $(this).data("id3");
        var last_name = $(this).text();
        edit_data(id,last_name, "x");
    });
    $(document).on('blur', '.y', function(){
        var id = $(this).data("id4");
        var last_name = $(this).text();
        edit_data(id,last_name, "y");
    });
    $(document).on('blur', '.z', function(){
        var id = $(this).data("id5");
        var last_name = $(this).text();
        edit_data(id,last_name, "z");
    });
    $(document).on('blur', '.l', function(){
        var id = $(this).data("id6");
        var last_name = $(this).text();
        edit_data(id,last_name, "l");
    });
    $(document).on('blur', '.d', function(){
        var id = $(this).data("id7");
        var last_name = $(this).text();
        edit_data(id,last_name, "d");
    });
    $(document).on('blur', '.w', function(){
        var id = $(this).data("id8");
        var last_name = $(this).text();
        edit_data(id,last_name, "w");
    });
    $(document).on('click', '.btn_delete', function(){
        var id=$(this).data("id9");
        if(confirm("Вы уверены, что хотите удалить месторождение?"))
        {
            $.ajax({
                url:"../../pages/php/field/delete.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    new Noty({
                        theme: 'nest',
                        type: 'success',
                        layout: 'topRight',
                        timeout: 3000,
                        text: data
                    }).show();
                    fetch_data();
                }
            });
        }
    });


        // body...



});

window.onload = function(){
    // function fetch_data()
    // {
    //     $.ajax({
    //         url:"../../pages/php/field_doc/select.php",
    //         method:"POST",
    //         success:function(data){
    //             $('#live_data_doc').html(data);
    //         }
    //     });
    // }
    // var btnDoc = $('.btn_doc');
    //
    // btnDoc.on('click', fetch_data);

};
