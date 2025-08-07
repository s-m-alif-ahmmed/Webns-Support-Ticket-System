<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('company.dashboard') }}">
                <img src="{{asset('/')}}admin/images/brand/webns_logo.png" class="header-brand-img desktop-logo w-100" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/favicon.png" class="header-brand-img toggle-logo w-100 py-2" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/favicon.png" class="header-brand-img light-logo w-100 py-2" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/webns_logo.png" class="header-brand-img light-logo1 w-100" alt="logo" style="height: 50px;">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">

                <li>
                    <h3>Menu</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('company.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z"/>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                @if($companyPermissionData && isset($companyPermissionData['company_users_all_user']))
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('user.index.company') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="16" width="20" viewBox="0 0 640 512">
                                <path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/>
                            </svg>
                            <span class="side-menu__label">User List</span>
                        </a>
                    </li>
                @endif
                @if($companyPermissionData && isset($companyPermissionData['company_users_tickets']))
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg height="16" width="20" class="side-menu__icon" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M44.4444 50C19.9306 50 0 72.4219 0 100V150C0 156.875 5.13889 162.266 10.9028 164.531C23.9583 169.609 33.3333 183.594 33.3333 200C33.3333 216.406 23.9583 230.391 10.9028 235.469C5.13889 237.734 0 243.125 0 250V300C0 327.578 19.9306 350 44.4444 350H355.556C380.069 350 400 327.578 400 300V250C400 243.125 394.861 237.734 389.097 235.469C376.042 230.391 366.667 216.406 366.667 200C366.667 183.594 376.042 169.609 389.097 164.531C394.861 162.266 400 156.875 400 150V100C400 72.4219 380.069 50 355.556 50H44.4444ZM88.8889 137.5V262.5C88.8889 269.375 93.8889 275 100 275H300C306.111 275 311.111 269.375 311.111 262.5V137.5C311.111 130.625 306.111 125 300 125H100C93.8889 125 88.8889 130.625 88.8889 137.5ZM66.6667 125C66.6667 111.172 76.5972 100 88.8889 100H311.111C323.403 100 333.333 111.172 333.333 125V275C333.333 288.828 323.403 300 311.111 300H88.8889C76.5972 300 66.6667 288.828 66.6667 275V125Z"/>
                            </svg>
                            <span class="side-menu__label">Tickets</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Tickets</a></li>
                            <li><a href="{{ route('user.create.ticket') }}" class="slide-item">Create Ticket</a></li>
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span
                                        class="sub-side-menu__label">Ticket List</span><i
                                        class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    <li><a class="sub-slide-item" href="{{ route('user.index.ticket') }}">All Tickets</a></li>
                                    <li><a class="sub-slide-item" href="{{ route('user.ticket.list') }}">Assigned Ticket List</a></li>
                                    <li><a class="sub-slide-item" href="{{ route('user.created.ticket') }}">My Created Ticket List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                                           width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
