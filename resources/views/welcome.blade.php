<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Football Scrapper</title>

    <style>
        .text-custom-success {
            color: #22c121 !important;
        }
    </style>
</head>

<body>


    <h3 class="d-flex justify-content-center my-5">
        Today's Football Match Results: Web Scraping Project
    </h3>
    <div>
        @foreach ($champions_names as $key => $item)
            <div class="list-group mx-auto w-50 my-4">
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                    <h3>{{ $item }}</h3>
                </button>
                @foreach ($matches[$key] as $match)
                    <button type="button" class="list-group-item list-group-item-action"
                        disabled>
                        <div class="row">
                            <b class="col-6">{{ $match['first_team']['name'][0] }} <span
                                    class="text-custom-success">({{ $match['first_team']['score'][0] }})</span></b>
                            <b class="col-1">🆚</b>
                            <b class="col-5 d-flex justify-content-end">
                                <span
                                    class="text-custom-success">({{ $match['second_team']['score'][0] }})</span>
                                {{ $match['second_team']['name'][0] }}</b>
                        </div>
                    </button>
                @endforeach
            </div>
        @endforeach
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
