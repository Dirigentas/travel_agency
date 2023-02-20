<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .mb-3 {
            margin: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .img img {
            height: 400px;
            width: auto;
        }

    </style>
</head>
<body>
    <h1></h1>
    <div class="mb-3">
        <label class="form-label">Drink type</label>

    </div>
    <div class="mb-3">
        <label class="form-label">Drink size</label>
        ml
    </div>
    <div class="mb-3">
        <label class="form-label">Drink price</label>
        Eur
    </div>
    <div class="mb-3">
        <label class="form-label">Drink description</label>
        <div>

        </div>
    </div>
    {{-- @if($value->photo)
    <img class='img-fluid img-thumbnail' src='{{asset($value->photo)}}'>
    @else
    <img class='img-fluid img-thumbnail' src='{{asset('no.jpg')}}'>
    @endif --}}
</body>
</html>
