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
        <h2>Doctors Form</h2>

        @if (isset($editdata))
            {{ Form::model($editdata, [
                'id' => 'doctors',
                'class' => 'FromSubmit form-horizontal',
                'data-redirect_url' => route('doctors.index'),
                'url' => route('doctors.update',$editdata->id),
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
            ]) }}
        @else
            {{ Form::open([
                'id' => 'doctors',
                'class' => 'FromSubmit form-horizontal',
                'url' => route('doctors.store'),
                'data-redirect_url' => route('doctors.index'),
                'name' => 'doctors',
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
            <label>Position:</label>
            {!! Form::text('position', null, [
                'id' => 'position',
                'placeholder' => 'Enter Position',
                'class' => 'form-control',
            ]) !!}
            @if ($errors->has('position'))
                <span class="text-danger">{{ $errors->first('position') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label> Description:</label>
            {!! Form::text('description', null, [
                'id' => 'description',
                'placeholder' => 'Enter description',
                'class' => 'form-control',
            ]) !!}
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
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

        {!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}

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
