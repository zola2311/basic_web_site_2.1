<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Category<b>  </b>


        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">


                <div class="col-md-8">


                    <div class="card">


                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                        @endif


                        <div class="card-header"> All multi pic </div>
                            <div class="card-group">
                            @foreach($images as $multi)
                                <div class="col-md-4 mt-5">
                                    <div class="card">
                                        <img src="{{ asset($multi->image) }}" alt="">

                                    </div>

                                </div>
                            @endforeach
                            </div>


                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> multi image </div>
                        <div class="card-body">




                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  multiple="">

                                    @error('image')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror

                                </div>




                                <button type="submit" class="btn btn-outline-primary">Add image</button>
                            </form>

                        </div>

                    </div>
                </div>



            </div>
        </div>



        <!-- Trash Part -->

        {{--        <div class="container">--}}
        {{--            <div class="row">--}}


        {{--                <div class="col-md-8">--}}
        {{--                    <div class="card">--}}




        {{--                        <div class="card-header">Trash List </div>--}}


        {{--                        <table class="table">--}}
        {{--                            <thead>--}}
        {{--                            <tr>--}}
        {{--                                <th scope="col">SL No</th>--}}
        {{--                                <th scope="col">Category Name</th>--}}
        {{--                                <th scope="col">User</th>--}}
        {{--                                <th scope="col">Created At</th>--}}
        {{--                                <th scope="col">Action</th>--}}
        {{--                            </tr>--}}
        {{--                            </thead>--}}
        {{--                            <tbody>--}}
        {{--                            <!-- @php($i = 1) -->--}}
        {{--                            @foreach($trachCat as $category)--}}
        {{--                                <tr>--}}
        {{--                                    <th scope="row"> {{ $categories->firstItem()+$loop->index  }} </th>--}}
        {{--                                    <td> {{ $category->category_name }} </td>--}}
        {{--                                    <td> {{ $category->user->name }} </td>--}}
        {{--                                    <td>--}}
        {{--                                        @if($category->created_at ==  NULL)--}}
        {{--                                            <span class="text-danger"> No Date Set</span>--}}
        {{--                                        @else--}}
        {{--                                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}--}}
        {{--                                        @endif--}}
        {{--                                    </td>--}}
        {{--                                    <td>--}}
        {{--                                        <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>--}}
        {{--                                        <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>--}}
        {{--                                    </td>--}}


        {{--                                </tr>--}}
        {{--                            @endforeach--}}


        {{--                            </tbody>--}}
        {{--                        </table>--}}
        {{--                        --}}{{--                        {{ $trachCat->links() }}--}}

        {{--                    </div>--}}
        {{--                </div>--}}


        {{--                <div class="col-md-4">--}}

        {{--                </div>--}}



        {{--            </div>--}}
        {{--        </div>--}}

        <!-- End Trush -->



    </div>
</x-app-layout>
