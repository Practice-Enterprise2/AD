    <?php
    use App\Http\Controllers\contractController;
    use App\Http\Controllers\AirportController;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">

    </script>
    <script>
        $(document).ready(function() {
    $('.chosen-select').chosen();
    });

    </script>
    </head>
    <body>

        <select class="chosen-select">
        @foreach ($contracts as $contract )
        <option value="{{ $contract->contract_ID }}">{{$contract->contract_ID}} </option>

        @endforeach
        </select>

    </body>
    </html>
