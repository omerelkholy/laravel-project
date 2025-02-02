<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Yard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container text-center mt-5">
    <form method="get">
        <input type="text" class="text-success form-control m-1" name="search" placeholder="search here"
               value="{{request()->get('search')}}">
        <button type="submit" class="btn btn-success">search</button>
    </form>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4 m-5">
    @foreach($jobs as $job)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$job->title}}</h5>
                    <p class="card-text">{{$job->benefits}}</p>
                    <p class="card-text">{{$job->requirements}}</p>
                    <p class="card-text">{{$job->salary_range}}</p>
                    <p class="card-text">{{$job->location}}</p>
                    <p class="card-text">{{$job->work_type}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
