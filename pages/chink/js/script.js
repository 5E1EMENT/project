$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"../../pages/php/chink/select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }
    fetch_data();
    $(document).on('click', '#btn_add', function(){
        var nhole = $('#nhole').text();
        var nfield = $('#nfield').text();
        var x = $('#x').text();
        var y = $('#y').text();
        var z = $('#z').text();
        var a = $('#a').text();
        var b = $('#b').text();
        var d = $('#d').text();
        if(nhole == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите номер скважины'
            }).show();
            return false;
        }
        if(nfield == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите номер месторождения'
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
        if(a == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите угол альфа'
            }).show();
            return false;
        }
        if(b == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите угол бета'
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
                text: 'Введите глубину скважины'
            }).show();
            return false;
        }
        $.ajax({
            url:"/pages/php/chink/insert.php",
            method:"POST",
            data:{nhole:nhole, nfield:nfield, x:x, y:y,z:z,a:a,b:b,d:d},
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
            url:"/pages/php/chink/edit.php",
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
    $(document).on('blur', '.nhole', function(){
        var id = $(this).data("id1");
        var first_name = $(this).text();
        edit_data(id, first_name, "nhole");
    });
    $(document).on('blur', '.nfield', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "nfield");
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
    $(document).on('blur', '.a', function(){
        var id = $(this).data("id6");
        var last_name = $(this).text();
        edit_data(id,last_name, "a");
    });
    $(document).on('blur', '.b', function(){
        var id = $(this).data("id7");
        var last_name = $(this).text();
        edit_data(id,last_name, "b");
    });
    $(document).on('blur', '.d', function(){
        var id = $(this).data("id8");
        var last_name = $(this).text();
        edit_data(id,last_name, "d");
    });
    // $(document).on('click', '.btn_delete', function(){
    //     var id=$(this).data("id9");
    //     if(confirm("Вы уверены, что хотите удалить скважину?"))
    //     {
    //         $.ajax({
    //             url:"/pages/php/chink/delete.php",
    //             method:"POST",
    //             data:{id:id},
    //             dataType:"text",
    //             success:function(data){
    //                 new Noty({
    //                     theme: 'nest',
    //                     type: 'success',
    //                     layout: 'topRight',
    //                     timeout: 3000,
    //                     text: data
    //                 }).show();
    //                 fetch_data();
    //             }
    //         });
    //     }
    // });
});  