<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un produit</h1>
        <form action="{{route('product.store')}}" method="post">
        @csrf
        @method('post')
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-5">
                    <label for="">Nom</label>
                    <input type="text" name="nom" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div></br>
            <div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </div>
        </form>
    </div>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>