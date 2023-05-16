@extends('ui-panel.layouts.master')

@section('title', 'Mr.Min Personal Blog')

@section('content')

    <!-- My Profile Section -->
    <section class="bg-white">
        <!-- Profile -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="mt-5">
                        <h4 class="text-uppercase">Hi, There!</h4>
                        <h2 class="text-uppercase">I'm <span class="text-warning">Min Khant Naung</span></h2>
                        <h5 class="bg-warning badge text-black">Full Stack Web Developer</h5>
                        <p class="text-muted ">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores unde, autem odit ipsam ex
                            at quibusdam beatae! Dolorum deleniti, architecto sequi exercitationem perferendis,
                            similique commodi deserunt velit, non optio illum.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 p-5">
                    <img src="{{ asset('images/my.jpg') }}" class="img-fluid rounded-top w-100" alt="my image">
                </div>
            </div>
        </div>
    </section>

    <!-- About Me and My Skills Section -->
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <!-- About Me Section -->
                <div class="col-md-6">
                    <h6 class="display-6 fw-bold text-center my-4">About Me</h6>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde eaque maiores placeat quaerat?
                        Maiores beatae necessitatibus tenetur provident aut obcaecati architecto, cum iure illo sapiente quo
                        doloribus voluptate dolor facilis voluptatem ipsum magnam alias recusandae quia ea at quos ad labore
                        est. Aperiam dolores voluptates quod corporis amet alias consequuntur.
                    </p>
                    <div class="row my-4">
                        <div class="col-sm-6 mt-3">
                            <div class="text-center shadow py-3 px-2">
                                <h6 class="display-6 fw-bold"><i class="fa-solid fa-diagram-project"></i></h6>
                                <h2>{{ $projects->count() }}+</h2>
                                <h3>Total Projects</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <div class="text-center shadow py-3 px-2">
                                <h6 class="display-6 fw-bold"><i class="fa-solid fa-hands-holding-child"></i></h6>
                                <h2>
                                    @isset($studentCount)
                                        {{ $studentCount->count }}
                                    @endisset
                                </h2>
                                <h3>Total Students</h3>
                            </div>
                        </div>
                    </div>
                    <!-- My Projects Section -->
                    <div class="row my-4">
                        <h6 class="display-6 fw-bold text-center my-4">My Projects</h6>
                        @foreach ($projects as $project)
                            <div class="col-md-6 mt-3">
                                <a href="{{ $project->url }}">
                                    <div class="shadow w-100 position-relative">
                                        <img src="{{ asset("storage/images/$project->image") }}"
                                            class="img-fluid w-100 object-fit-cover rounded" alt="project image"
                                            style="height:130px;">
                                        <span class="position-absolute top-50 start-50 translate-middle text-center">
                                            <h6 class="display-6 fw-bold text-danger"><i
                                                    class="fa-solid fa-diagram-project"></i></h6>
                                            <h4 class="text-danger">{{ $project->name }}</h4>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- My Skills -->
                <div class="col-md-6">
                    <h6 class="display-6 fw-bold text-center my-4">My Skills</h6>
                    @foreach ($skills as $skill)
                        <div class="row">
                            <div class="col-8 mt-2 mb-4">
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $skill->percent }}%">
                                        <span class="fst-italic">{{ $skill->percent }}%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <h6 class="fst-italic text-uppercase mt-2">{{ $skill->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
