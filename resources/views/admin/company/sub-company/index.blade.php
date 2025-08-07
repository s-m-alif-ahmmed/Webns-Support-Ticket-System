@extends('admin.master')

@section('title')
    Add Sub Company
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('sub_companies.index') }}">Sub Companies</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Sub Company</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add New Sub Company </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" action="{{ route('sub_companies.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-6 form-group">
                                    <label for="industry" class="form-label"> Industries Name </label>
                                    <select class="form-control select2-show-search form-select" name="industry_id" id="industry" data-placeholder="Choose one industry" required>
                                        <option value="" selected>Choose one industry</option>
                                        @foreach($industries as $industry)
                                            <option value="{{ $industry->id }}" {{$industry->company_id == $industry->id ? 'selected' : ''}} >{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('industry_id')" class="" />
                                </div>

                                <div class="col-md-6">
                                    <label for="company" class="form-label">Company</label>
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            <option value="">Select Company</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('company_id')" class="" />
                                </div>

                                <div class="col-6">
                                    <label for="name" class="form-label"> Sub Company Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter company name" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="web_slug" class="form-label"> Sub Company Website Url </label>
                                    <input class="form-control" type="text" name="web_slug" id="web_slug" placeholder="Enter company website url"  />
                                    <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label"> Sub Company Logo </label>
                                    <input class="form-control" type="file" name="image" id="image" placeholder="Enter company logo" />
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="email" class="form-label"> Sub Company Contact Email </label>
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Enter company contact email"  />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="number" class="form-label"> Sub Company Contact Number </label>
                                    <input class="form-control" type="text" name="number" id="number" placeholder="Enter company contact number"  />
                                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="sister_concern" class="form-label"> Is Sister Concern? </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="sister_concern" id="sister_concern" data-placeholder="Choose one" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('sister_concern')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="branch" class="form-label"> Is It Branch? </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="branch" id="branch" data-placeholder="Choose one" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
