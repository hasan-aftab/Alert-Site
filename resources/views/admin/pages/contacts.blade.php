@extends('admin.layout.main')

@section('content')
<style>
    /* Example styles for pagination */
    .pagination {
        font-size: 21px;
        float: inline-end;
        padding-right: 18px;
    }

    .pagination ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .pagination ul li {
        display: inline;
        margin-right: 5px;
    }

    .pagination ul li a {
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .pagination ul li a.active {
        background-color: #007bff;
        color: white;
    }

    /* Adjust the delete button */
  .btn-danger {
      width: auto; /* Automatically adjust the width */
      padding: 10px 20px; /* Add padding to make it look better */
      margin-bottom: 20px; /* Add some margin to separate it from the table */
      float: ;
  }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contacts List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">Contacts</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if(count($rec)>0)
                        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.contact.bulkDelete') }}">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete the selected contacts?')">Delete Selected</button>
    <table id="example" class="display">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>#Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Contact On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rec as $contact)
            <tr>
                <td><input type="checkbox" name="ids[]" value="{{ $contact->id }}" class="selectBox"></td>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->message }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>
                    <a onclick="return confirm('Are you sure?')" href="{{ url('admin/contact/delete/'.$contact->id) }}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
                        @else
                        <h6 class="display-8">THERE'S NO Contacts</h6>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>

<script>
    // Select/Deselect all checkboxes
    document.getElementById('selectAll').onclick = function() {
        var checkboxes = document.querySelectorAll('.selectBox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>
@endsection
