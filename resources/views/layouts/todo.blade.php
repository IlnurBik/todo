<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ToDo list</title>
</head>
<body>
@yield('content')
<script type="text/javascript">
    $('#submitForm').click(function (e) {
        e.preventDefault();
        let name = $("input[name=name]").val();
        let tag = $("input[name=tag]").val();
        let img = $("input[name=max_img]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        let form = $('form')[0];
        let formData = new FormData(form);
        $.ajax({
            url: "/",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                addTask(response);
                console.log(response.tags);
                clearForm();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status===422) {
                    let errors = jqXHR.responseJSON.errors;
                    displayFormErrors(errors);
                }
            }
        });


    });

    function addTask(response){
        $('#tbody').prepend('<tr class="align-middle" class="align-middle"><th scope="row">'+ response.id
            +'</th><td><img ' +
            'src="storage/'+ response.min_img +'"></td><td>'+ response.name +'</td><td>'+ response.tag +'</td><td><a ' +
            'type="button" ' +
            'href="'+ response.id +'/edit" ' +
            'class="btn btn-warning">Редактировать</a></td><td><form action="/'+ response.id +'" ' +
            'method="post">@csrf @method('delete')<button type="submit" ' +
            'class="btn btn-danger">Удалить</button></form></td></tr>');
    }

    function displayFormErrors(errors) {
        clearFormErrors();

        for (let fieldName in errors) {
            if (errors.hasOwnProperty(fieldName)) {
                let errorMessage = errors[fieldName];
                let errorElement = document.getElementById('error-' + fieldName);
                errorElement.innerText = errorMessage;
                errorElement.style.display = 'block';
            }
        }
    }

    function clearFormErrors() {
        var errorElements = document.getElementsByClassName('form-error');
        for (let i = 0; i < errorElements.length; i++) {
            errorElements[i].innerText = '';
            errorElements[i].style.display = 'none';
        }
    }

    function clearForm(){
        let formdata = document.querySelectorAll('.form-control');
        for (let i = 0; i < formdata.length; i++) {
            let input = formdata[i];
            input.value = '';
        }
        clearFormErrors()
    }


</script>
</body>
</html>
