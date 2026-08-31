<style>
    .alert {
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 5px;
    }
    .alert h4 {
        margin: 0;
        color: inherit;
    }

    .alert .alert-link {
        font-weight: bold;
    }
    .alert >p
    .alert >ul {
        margin: 0;
    }
    .alert-dismissable,
    .alert-dismissible {
        padding-right: 35px;
    }
    .alert-dismissable .close
    .alert-dismissible {
        position: relative;
        top: -2px;
        right: -21px;
        color: inherit;
    }
    .alert-success {
        background-color: #dff0d8;
        color: #d6e9c6;
        border-color: #3c763d;
        border-radius: 5px;
        padding: 15px;
    }
    .alert-success hr {
        border-top-color: #c9e2b3;
    }
    .alert-success .alert-link {
        color: #2b542c;
    }
    .alert-info {
        background-color: #d9edf7;
        color: #bce8f1;
        border-color: #31708f;

    }
    .alert-info hr {
        border-top-color: #a6e1ec;
    }
    .alert-info .alert-link {
        color: #245269;
    }
    .alert-warning {
        background-color: #fcf8e3;
        color: #faebcc;
        border-color: #8a6d3b;
    }
    .alert-warning hr {
        border-top-color: #f7e1b5;
    }
    .alert-warning .alert-link {
        color: #66512c;
    }
    .alert-danger {
        background-color: #f2dede;
        color: #ebccd1;
        border-color: #a94442;
    }
    .alert-danger hr {
        border-top-color: #e4b9c0;
    }
    .alert-danger .alert-link {
        color: #843534;
    }


</style>

{{-- Display success or error messages --}}


@if(!empty(session('success')))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}

    </div>
@endif

@if(!empty(session('error')))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}

    </div>
@endif