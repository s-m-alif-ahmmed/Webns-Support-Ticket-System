@extends('admin.master')

@section('title')
    Edit Sub Company
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('sub_companies.index') }}">Sub Company</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Sub Company</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-muted">{{session('message')}}</p>
        @endif

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Sub Company</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('sub_companies.update', Crypt::encryptString($sub_company->id) )}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="user_id" value="{{ $sub_company->user_id }}" />
                                <input type="hidden" name="update_user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-6 form-group">
                                    <label for="industry" class="form-label"> Industries Name </label>
                                    <select class="form-control select2-show-search form-select" name="industry_id" id="industry" data-placeholder="Choose one industry" required>
                                        <option value="" selected>Choose one industry</option>
                                        @foreach($industries as $industry)
                                            <option value="{{ $industry->id }}" {{ $industry->id ==  $sub_company->industry_id ? 'selected' : '' }}>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('industry_id')" class="" />
                                </div>

                                <div class="col-md-6">
                                    <label for="company" class="form-label">Company</label>
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="company_id" id="company" data-placeholder="Choose one company" required>
                                            @if ($sub_company->company_id)
                                                <option value="{{ $sub_company->company->id }}">{{ $sub_company->company->name }}</option>
                                            @else
                                                <option value="">Select Company</option>
                                            @endif
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('company_id')" class="" />
                                </div>

                                <div class="col-6">
                                    <label for="name" class="form-label"> Sub Company Name </label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ $sub_company->name }}" placeholder="Enter company name" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="web_slug" class="form-label"> Sub Company Website Url </label>
                                    <input class="form-control" type="text" name="web_slug" id="web_slug" value="{{ $sub_company->web_slug }}" placeholder="Enter company website url"  />
                                    <x-input-error :messages="$errors->get('web_slug')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label"> Sub Company Logo </label>
                                    <input class="form-control" type="file" name="image" id="image" value="{{ $sub_company->image }}" placeholder="Enter company logo" />
                                    @if($sub_company->image)
                                        <img class="img-fluid mt-1" src="{{ asset( $sub_company->image ) }}" alt="" style="height: 80px; width: auto;">
                                    @endif
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="email" class="form-label"> Sub Company Contact Email </label>
                                    <input class="form-control" type="text" name="email" id="email" value="{{ $sub_company->email }}" placeholder="Enter company contact email"  />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="number" class="form-label"> Sub Company Contact Number </label>
                                    <input class="form-control" type="text" name="number" id="number" value="{{ $sub_company->number }}" placeholder="Enter company contact number"  />
                                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                </div>

                                <div class="col-6">
                                    <label for="sister_concern" class="form-label"> Is Sister Concern? </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="sister_concern" id="sister_concern" data-placeholder="Choose one" required>
                                            <option value="{{ $sub_company->sister_concern }}">{{ $sub_company->sister_concern }}</option>
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
                                            <option value="{{ $sub_company->branch }}">{{ $sub_company->branch }}</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
