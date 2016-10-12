@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>

                    <form action="" method="post" enctype="multipart/form-data">
                        selection une image à envoyer
                        <input type="file" name="photo" id="file">
                        <input type="submit" value="photo" name="submit">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection