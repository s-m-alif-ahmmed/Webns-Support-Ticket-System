@extends('company.master')

@section('title')
    Ticket Details
@endsection

@section('content')

    <section style="margin-bottom: 100px; margin-top: 15px;">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('user.index.ticket') }}">Tickets</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['ticket_create']) && $companyPermissionData['company_users_tickets']['ticket_create'] == 'ticket_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3 justify-content-end" href="{{ route('user.create.ticket') }}"> Create Ticket</a>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        @if(session('message'))
        <p class="text-center text-muted">{{session('message')}}</p>
        @endif

        <hr/>

{{--        Ticket View--}}
        @include('company.company-user.ticket.include.ticket-view')

{{--        Assign View--}}
        @if($ticket_assigns->isNotEmpty())
        @include('company.company-user.ticket.include.assign-view')
        @endif

{{--        Assign View--}}
        @if($companyPermissionData && isset($companyPermissionData['company_users_tickets']['assign_user_view']) && $companyPermissionData['company_users_tickets']['assign_user_view'] == 'assign_user_view')
            @if($company_ticket_assigns->isNotEmpty())
                @include('company.company-user.ticket.include.company-assign-view')
            @else
                @if($ticket->status == 'Open')
                    @include('company.company-user.ticket.include.company-assign-create')
                @else
                @endif
            @endif
        @endif

        @include('company.company-user.ticket.include.company-assign-create')

{{--        Massage System--}}
        @include('company.company-user.ticket.include.message')


    </section>

@endsection
