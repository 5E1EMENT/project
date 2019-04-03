$(document).ready(function(){


    function fetch_data()
    {
        $.ajax({
            url:"../../pages/php/mine/select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }
    fetch_data();
    $(document).on('click', '#btn_add', function(){
        var name = $('#name').text();
        var clr = $('#clr').text();
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
        if(name == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите название полезного ископаемого'
            }).show();
            return false;
        }
        if(clr == '')
        {

            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите цвет в формате HTML'
            }).show();
            return false;
        }

        $.ajax({
            url:"../../pages/php/mine/insert.php",
            method:"POST",
            data:{name:name, clr:clr},
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
            url:"../../pages/php/mine/edit.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
                //console.log(id,text,column_name);
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

    $(document).on('blur', '.name', function(){
        var id = $(this).data("id1");
        var last_name = $(this).text();
        edit_data(id,last_name, "name");
        console.log(id);
    });
    $(document).on('blur', '.clr', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "clr");
    });

    $(document).on('click', '.btn_delete_mine', function(){
        var idmine=$(this).data("id3");

        if(confirm("Вы уверены, что хотите удалить полезное ископаемое?"))
        {
            $.ajax({
                url:"../../pages/php/mine/delete.php",
                method:"POST",
                data:{idmine:idmine},
                dataType:"text",
                success:function(data){
                    console.log(idmine);
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
