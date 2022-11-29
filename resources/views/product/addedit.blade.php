<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        form {
            margin-top: 27px;
            margin-right: 250px;
        }

        .card.card-primary {
            margin-top: 40px;
        }

        .container {
            width: 1046px;
        }

        .error {
            color: red;
        }
    </style>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('theme/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/additional-methods.min.js') }}"></script>
</head>

<body>



    <div class="container">
        <h2>Product Form</h2>

        @if (isset($editdata))
            {{ Form::model($editdata, [
                'id' => 'productForm',
                'class' => 'FromSubmit form-horizontal',
                'data-redirect_url' => route('product.index'),
                'url' => route('product.update', $editdata->id),
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
            ]) }}
        @else
            {{ Form::open([
                'id' => 'productForm',
                'class' => 'FromSubmit form-horizontal',
                'url' => route('product.store'),
                'data-redirect_url' => route('product.index'),
                'name' => 'product',
                'enctype' => 'multipart/form-data',
            ]) }}
        @endif


        @csrf

        <div class="form-group">
            <label>Name:</label>
            {!! Form::text('name', null, [
                'id' => 'name',
                'placeholder' => 'Enter name',
                'class' => 'form-control',
            ]) !!}
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Details:</label>
            {!! Form::text('details', null, [
                'id' => 'details',
                'placeholder' => 'Enter details',
                'class' => 'form-control',
            ]) !!}
            @if ($errors->has('details'))
                <span class="text-danger">{{ $errors->first('details') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Status:</label>
            {!! Form::select('status', ['1' => 'Active', '2' => 'Inactive'], null, [
                'id' => 'status',
                'placeholder' => 'select status',
                'class' => 'form-control',
            ]) !!}
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>

        {!! Form::submit('submit', ['class' => 'btn btn-primary', 'id' => 'saveBtn']) !!}

        <a href="{{ route('doctors.index') }}" class="btn btn-danger">Cancle</a>

        {!! Form::close() !!}

    </div>


    <script>
        $('form.FromSubmit').submit(function(event) {


            event.preventDefault();
            var formId = $(this).attr('id');
            if ($(this).valid()) {

                var formAction = $(this).attr('action');
                var $btn = $('#' + formId + ' button[type="submit"]').button('loading');
                var redirectURL = $(this).data("redirect_url");
                $.ajax({
                    type: "POST",
                    url: formAction,
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        if (response.status == 1 && response.msg != "") {
                            window.location = redirectURL;
                        }
                    },
                    error: function(jqXhr) {
                        // var errors = $.parseJSON(jqXhr.responseText);
                        //     showErrorMessages(formId, errors);
                        // $btn.button('reset');
                    }
                });
                return false;
            };
        });

    </script>
</body>

</html>
