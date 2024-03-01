<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devicewidth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8eb701f6a4.js" crossorigin="anonymous"></script>
</head>
<body>
  <h1 class="text-center p-3">CRUD en laravel</h1>
  <!-- Condicional mensaje post operacion -->
  @if (session("correcto"))
  <div class="alert alert-success">{{session("correcto")}} </div>
  @endif
  @if (session("incorrecto"))
  <div class="alert alert-danger">{{session("incorrecto")}} </div>
  @endif

  <script> 
    var res=function(){
      var not=confirm("¿Estas seguro de eliminar?");
      return not;
    }
  </script>

  <div class="p-5 table-responsive">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Añadir producto</button>
    <!-- Modal AÑADIR producto -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route("crud.create")}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Codigo del producto</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcodigo">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Precio €</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Cantidad</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad">
            </div>     
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Añadir</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr> <!-- Tabla de cabezera -->
          <th scope="col">CODIGO</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">PRECIO</th>
          <th scope="col">CANTIDAD</th>
          <th scope="col">IMAGEN</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($datos as $item)
        <tr>
          <th scope="row">{{$item->CODIGO}}</th>
          <td>{{$item->NOMBRE}}</td>
          <td>{{$item->PRECIO}}€</td>
          <td>{{$item->CANTIDAD}}</td>
          <td>{{$item->IMAGEN}}</td>
          <td>
            <a href="" data-bs-toggle="modal" data-bs-target="#modalModificar{{$item->CODIGO}}" class="btn btn-warning btn-sn"> <i class="fa-solid fa-pen-to-square"></i> </a>
            <a href="{{route("crud.delete", $item->CODIGO)}}" class="btn btn-danger btn-sn" onclick="return res()"> <i class="fa-solid fa-delete-left"></i> </a>
          </td>
          <!-- Modal Editar producto -->
          <div class="modal fade" id="modalModificar{{$item->CODIGO}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del producto</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route("crud.update")}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Codigo del producto</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcodigo" value="{{$item->CODIGO}}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre" value="{{$item->NOMBRE}}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Precio €</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio" value="{{$item->PRECIO}}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad" value="{{$item->CANTIDAD}}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="imagen" value="{{$item->IMAGEN}}">
                  </div>
                  <div class="mb-3">
                    <img id="imagenSeleccionada" style="max-height: 300px">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>