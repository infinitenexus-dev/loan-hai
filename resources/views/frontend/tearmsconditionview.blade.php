@extends('frontend.main_index.main_index')
<style>
    b {
        font-size: 12px !important;
    }

    h6 {
        font-size: 17px !important;
    }
</style>
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h1 class="mb-3 text-capitalize">Terms & Condition</h1>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ route('termsconditions.frontend') }}">Terms &
                                Condition</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {!! $termscondtion->description !!}
@endsection
