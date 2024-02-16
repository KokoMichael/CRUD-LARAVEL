<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{route('product.create')}}">Ajouter un produit</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="col-lg-10">
            <form action="{{route('product.index')}}">
                @csrf

                <div class="col-lg-5">
                    <input type="text" value="{{request()->search}}" name="search" placeholder="recherche" class="form-control">
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-secondary">Recherche</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <h1 class="text-danger">Produits</h1>
        <table class="table">
            <tr>
                <th>picture</th>
                <th>Nom du produit</th>
                <th>Description</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            @forelse($products as $product)
                <tr>
                    <td><img src="{{Storage::url($product->picture)}}" alt="" width="200" height="200"></td>
                    <td>{{$product->nom}}</td>
                    <td>{{$product->description}}</</td>
                    <td><a  class="btn btn-success" href="{{route('product.edit', ['product' => $product])}}">Modifier</a></td>
                    <td>
                        <form action="{{route('product.delete', ['product' => $product])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <p style="color:red;">Aucun resultat</p>
            @endforelse
            </div>
        </table>
        {{$products->links()}}
        @if(session('status'))
         <a href="#">{{session('status')}}</a>
        @endif
    </div>
</body>
</html>