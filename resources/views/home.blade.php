@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <th scope="row">{{ $contact->id }}</th>
                                <td>{{ $contact->firstname }}</td>
                                <td>{{ $contact->lastname }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->contact_number }}</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="showModal({{ json_encode($contact) }})">Edit</button></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Paginator -->
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>

                    <contactform-component title="Edit" v-bind:contactdata="contactdata"></contactform-component>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    var contactdata = null;
    function showModal(data) {

        contactdata = data;

        console.log(data);
    }
</script>
