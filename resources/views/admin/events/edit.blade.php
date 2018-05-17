@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Список событий @endslot
            @slot('parent') Главная @endslot
            @slot('active') События @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{ route('admin.event.update', $category) }}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('admin.events.partials.form')

        </form>
    </div>

@endsection