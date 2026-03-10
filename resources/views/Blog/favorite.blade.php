
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">

    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>Dashboard</title>
    <!-- Icons -->
    <link href="{{asset('dashboard/css/font-awesome.min.css')}} " rel="stylesheet">
    <link href="{{asset('dashboard/css/simple-line-icons.css')}} " rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('dashboard/dest/style.css')}} " rel="stylesheet">
</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button"></button>
            <a class="navbar-brand" href="#"></a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>


        </div>
    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-speedometer"></i> نظام المدونات</a>
                </li>

                <li class="nav-title">
                  أهلاً و سهلاً
                </li>
                 <li class="nav-item">
                   <a class="nav-link" href="{{ route('blogs.showAll') }}"><i class="fa fa-list-alt"></i> المدونات</a>
                    <a class="nav-link" href="{{ route('categories.showAll') }}"><i class="fa fa-list-alt"></i> الفئات</a>
                   <a class="nav-link">
                    <form action="{{ route('logout') }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="background: none; border: none; padding: 0; color: inherit; cursor: pointer;"
                        ><i class="fa fa-arrow-left"></i>الخروج</button>

                    </form></a>

                </li>



            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main">
 @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>  قائمة المدونات المفضلة
                    </div>
                    <div class="card-block">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-default">
                                    <tr>
                                        <th>#</th>
                                        <th>العنوان</th>
                                        <th>المحتوى</th>
                                        <th>الصورة</th>
                                        <th>تاريخ الإضافة</th>
                                        <th>الفئات</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ Str::limit($blog->content, 70) }}</td>
                                        <td>
                                            @if($blog->image)
                                                <img src="{{ asset('storage/'.$blog->image) }}"
                                                     alt="{{ $blog->title }}"
                                                     style="height: 40px; width: auto; border-radius: 4px;">
                                            @else
                                                <span class="text-muted">لا توجد صورة</span>
                                            @endif
                                        </td>
                                        <td>{{ $blog->created_at }}</td>
                                        <td>
                                            @foreach ($blog->categories as $category)
                                              {{ $category->name}}

                                            @endforeach
                                            {{-- $blog->categories
                                            is a dynamic query by Eloquent ORM ,it returns a collection of the categories
                                            but $blog->categories() =>returns builder`s object

                                            --}}
                                        </td>
                                        <td>


                                           <form action="{{ route('blogs.softDelete', $blog) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-secondary" title="أرشفة" onclick="return confirm('هل أنت متأكد من الأرشفة؟')">
                                                    <i class="fa fa-archive"></i>
                                                </button>
                                            </form>
                                             <form action="{{ route('blogs.forceDelete', $blog->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>



                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            لا توجد مدونات مضافة حتى الآن.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- نهاية table-responsive -->
                    </div> <!-- نهاية card-block -->
                </div> <!-- نهاية card -->
            </div> <!-- نهاية col-md-12 -->
        </div> <!-- نهاية row -->
    </div> <!-- نهاية container-fluid -->

    </main>




    <!-- Bootstrap and necessary plugins -->
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/tether.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/pace.min.js"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('dashboars/js/libs/Chart.min.js')}} "></script>

    <!-- CoreUI main scripts -->

    <script src="{{asset('dashboars/js/app.js')}} "></script>

    <!-- Plugins and scripts required by this views -->
    <!-- Custom scripts required by this view -->
    <script src="{{asset('dashboars/js/views/main.js')}} "></script>

    <!-- Grunt watch plugin -->
    <script src="//localhost:35729/livereload.js"></script>
</body>

</html>
