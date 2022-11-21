
<!DOCTYPE html>

<html>

<head>

    <title>ContactForm</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />

</head>

<body>

<div class="container">

    <div class="row mt-5 mb-5">

        <div class="col-10 offset-1 mt-5">

            <div class="card">

                <div class="card-header bg-primary">

                    <h3 class="text-white">Форма обратной связи</h3>

                </div>

                <div class="card-body">



                    @if(Session::has('success'))

                        <div class="alert alert-success">

                            {{Session::get('success')}}

                        </div>

                    @endif



                    <form method="POST" action="{{ route('sendReport') }}" id="contactUSForm">

                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <strong>ФИО:</strong>

                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))

                                        <span class="text-danger">{{ $errors->first('name') }}</span>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <strong>Телефон:</strong>

                                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">

                                    @if ($errors->has('phone'))

                                        <span class="text-danger">{{ $errors->first('phone') }}</span>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <strong>Сообщение:</strong>

                                    <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>

                                    @if ($errors->has('message'))

                                        <span class="text-danger">{{ $errors->first('message') }}</span>

                                    @endif

                                </div>

                            </div>

                        </div>



                        <div class="form-group text-center">

                            <button class="btn btn-success btn-submit">Submit</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
