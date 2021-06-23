@php
    use App\Http\Controllers\sessionTime;
    $sessionTime = new sessionTime();

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>      
        
    </head>
    <body class="bg-light">
        <div class="container">   
          <div class="row">
            <div class="col-lg-12">
              <h4 class="mb-3">{{ __('Generar llave nueva') }}</h4>
              <div class="alert alert-primary" role="alert">
           Mostrar Llave
           <h6>{{session('key')}}</h6>
            </div>
              <form class="needs-validation" method="POST" action="{{ route('generateKey') }}">
                @csrf
                <div class="mb-3">
                  <label for="username">Method Encryption</label>
                  <div class="input-group">
                    <select name="method" id="method" class="form-control">
                        <option value="sha512">sha512</option>
                    </select>
                  </div>
                </div>
                   
                <hr class="mb-12">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Encriptar') }}</button>
                    </div>
                    @if(Session::has('ErrorGenerate'))
                    <br>
                    <div class="alert alert-danger ">
                      <i class="fas fa-bell" >
                      <strong>*{{session('ErrorGenerate')}}</strong> 
                    </div>
                    <br>
                    @endif
                </div>
              </form>
            </div>
          </div> 
        </div>
        <hr>
        <div class="container">   
          <div class="row">
            <div class="col-lg-12">
              <h4 class="mb-3">{{ __('Cadena a encriptar') }}</h4>
              <h3>{{session('comentario')}}</h3>
              <div class="alert alert-primary" role="alert">
           Mostrar Encrypted
           <h4>{{session('stringEncript')}}</h4>
            </div>
              <form class="needs-validation" method="POST" action="{{ route('encrypt') }}">
                @csrf
                <div class="mb-3">
                  <label for="username">Llave</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="keyEncript" placeholder="llave para encriptar" name="keyEncript" value="{{session('key')}}" required>
                    
                  </div> 
                  
                  

                </div>
                <div class="mb-3">
                  <label for="username">Cadena</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="encript" placeholder="Cadena a encriptar" name="encript"  required>
                  </div>
                </div>
                   
                <hr class="mb-12">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Encriptar') }}</button>
                    </div>
                   
                </div>
              </form>
            </div>
          </div>
        </div>
        <hr>
        <div class="container">   
          <div class="row">
            <div class="col-lg-12">
              <h4 class="mb-3">{{ __(' Mostrar Decrypt') }}</h4>
              <div class="alert alert-primary" role="alert">
           Mostrar Decrypt
           <h3>{{session('Decrypyt')}}</h3>
            </div>
              <form class="needs-validation" method="POST" action="{{ route('decrypt') }}">
                @csrf
                <div class="mb-3">
                  <label for="username">Llave</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="keyE" placeholder="Llave de encriptación" name="keyE" value="{{session('key')}}" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="username">Cadena</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="encriptEd" placeholder="Cadena a desencriptar" name="encriptEd" value="{{session('stringEncript')}}" required>
                  </div>
                </div>
                   
                <hr class="mb-12">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Desencriptar') }}</button>
                    </div>
                    @if(Session::has('ErrorDencrypt'))
                    <br>
                    <div class="alert alert-danger ">
                      <i class="fas fa-bell" >
                      <strong>*{{session('ErrorDencrypt')}}</strong> 
                    </div>
                    <br>
                    @endif
                </div>
              </form>
            </div>
          </div>
        </div>
    </body>
</html>
