<x-app-layout>
    {{-- <div class="p-3 p-md-5 m-md-3 text-center">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1>Elections To-Go</h1>
            <p class="lead">An election simulator that teaches you about democracy.</p>
            <p class="lead">
                <a href="/documentation" class="btn btn-outline-primary">Learn more</a>
            </p>
        </div>
    </div> --}}
    <style>
        .carousel-item {
            width: 100%;
            background: rgb(131, 119, 119);
        }
    </style>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h1>Elections To-Go</h1>
                <p class="lead">An election simulator that teaches you about democracy.</p>
                <p class="lead">
                <a href="/documentation" class="btn btn-outline-primary">Learn more</a>
            </p>
            </div>
            <div class="carousel-item">
                <h1>Ready to join us?</h1>
                <a href="/documentation" class="btn btn-outline-primary">Sign in</a>
                
                <a href="/documentation" class="btn btn-outline-primary">Create an account</a>
            </div>
            <div class="carousel-item">
                <h1>Test3</h1>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>

    {{-- Below are required to able to use carousel --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</x-app-layout>
