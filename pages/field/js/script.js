$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"/pages/php/field/select.php",
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
        if(nfield == '')
        {
            alert("Введите номер месторождения");
            return false;
        }
        if(namefield == '')
        {
            alert("Введите имя месторождения");
            return false;
        }
        if(x == '')
        {
            alert("Введите Х координату");
            return false;
        }
        if(y == '')
        {
            alert("Введите Y координату");
            return false;
        }
        if(z == '')
        {
            alert("Введите Z координату");
            return false;
        }
        if(l == '')
        {
            alert("Введите длину месторождения");
            return false;
        }
        if(d == '')
        {
            alert("Введите глубину месторождения");
            return false;
        }
        if(w == '')
        {
            alert("Введите ширину месторождения");
            return false;
        }
        $.ajax({
            url:"/pages/php/field/insert.php",
            method:"POST",
            data:{nfield:nfield, namefield:namefield, x:x, y:y,z:z,l:l,d:d,w:w},
            dataType:"text",
            success:function(data)
            {
                alert(data);
                fetch_data();
            }
        })
    });

    function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"/pages/php/field/edit.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
                $('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }
        });
    }
    $(document).on('blur', '.nfield', function(){
        var id = $(this).data("id1");
        var first_name = $(this).text();
        edit_data(id, first_name, "nfield");
    });
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
                url:"/pages/php/field/delete.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    alert(data);
                    fetch_data();
                }
            });
        }
    });
});  