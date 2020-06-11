{{--{{$casas}}--}}

{{--@foreach($casas as $casa)--}}
{{--    <div class="row" style="border-bottom: 1px solid lightgrey; margin-bottom: 2px; padding-bottom: 4px;">--}}
{{--        <div class="col-md-4">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}}</div>--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    @for($i=0; $i<33; $i++)--}}
{{--                        @if($i<10)--}}
{{--                            <span class="badge badge-danger right badge-btn">{{$i}}</span>--}}
{{--                        @else--}}
{{--                            <span class="badge badge-success right badge-btn">{{$i}}</span>--}}
{{--                        @endif--}}

{{--                                                    <button type="button" class="btn btn-default">{{$i}}</button>--}}


{{--                    @endfor--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endforeach--}}



@foreach($casas as $casa)


{{--    =>>>{{$dataHojeNova}}<<<<==--}}
{{--    =>>>{{$data32Dias}}<<<<==--}}
{{--    <hr>--}}


{{--{{$casa->ocupada}}--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}}</h3>
                </div>
                <div class="card-body text-center">

                    @for($data=\Carbon\Carbon::parse($dataHojeNova); $data<=$data32Dias; $data->addDay())

                        @if ($casa->ocupada->contains($data->format('Y-m-d')))
                            <span class="badge badge-danger right badge-btn" title="{{$data->format('Y-m-d')}}" onclick="setInscricaoData({{$data->format('Y-m-d')}})">{{$data->format('d')}}</span>
                        @else
                            <span class="badge badge-success right badge-btn" title="{{$data->format('Y-m-d')}}" onclick="setInscricaoData({{$data->format('Y-m-d')}})">{{$data->format('d')}}</span>
                        @endif


                    @endfor




{{--                    @for($i=0; $i<33; $i++)--}}
{{--                        @if($i<10)--}}
{{--                            <span class="badge badge-danger right badge-btn">{{$i}}</span>--}}
{{--                            @elseif($i==18)--}}
{{--                                <span class="badge badge-primary right badge-btn">{{$i}}</span>--}}
{{--                        @elseif($i==16)--}}
{{--                            <span class="badge badge-secondary right badge-btn">{{$i}}</span>--}}
{{--                        @else--}}
{{--                            <span class="badge badge-success right badge-btn">{{$i}}</span>--}}
{{--                        @endif--}}
{{--                    @endfor--}}
                </div>
            </div>
        </div>
    </div>
@endforeach
