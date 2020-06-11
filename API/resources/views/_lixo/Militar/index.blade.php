
@extends('layouts.app')

@section('title', 'Home')


@section('content')
{{--    <ul>--}}
{{--        <li>Nome: {{$user->TELEF}}</li>--}}
{{--        <li>Nome: {{$user->SENHA}}</li>--}}
{{--    </ul>--}}

<div class="flex-center position-ref full-height">

{{$titulo}}

    <select>
        @foreach($users as $user)
        <option id="{{$user->NUMREGISTO}}">{{$user->EMAIL}}</option>
            @endforeach
    </select>


  INDEX

    <div id="divDados"> </div>
</div>

@endsection


@section('js')
<script>

</script>
@endsection
