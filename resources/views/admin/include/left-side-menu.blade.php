<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
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
            <ul class="side-menu" style="margin-bottom: 100px;">

                <li>
                    <h3>Menu</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z"/>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                @if($permissionData && isset($permissionData['users_all']))
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="16" width="20" viewBox="0 0 640 512">
                                <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/>
                            </svg>
                            <span class="side-menu__label">Users</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1">
                                <a href="javascript:void(0)">Users</a>
                            </li>
                            @if($permissionData && isset($permissionData['users_all']['employ_create']) && $permissionData['users_all']['employ_create'] == 'employ_create')
                                <li>
                                    <a href="{{ route('users.registration') }}" class="slide-item"> Create User</a>
                                </li>
                            @endif
                            @if($permissionData && isset($permissionData['users_all']['employ_manage']) && $permissionData['users_all']['employ_manage'] == 'employ_manage')
                                <li>
                                    <a href="{{ route('users') }}" class="slide-item"> User List & Settings</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($permissionData && isset($permissionData['company_everything_all']))
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg width="20" height="20" class="side-menu__icon" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect x="94.4648" y="30.167" width="188.935" height="349.833" rx="10" />
                            <rect x="298.672" y="153.265" width="66.7667" height="226.735" rx="10" />
                            <rect x="14.5625" y="153.265" width="66.7667" height="226.735" rx="10" />
                            <rect x="298.672" y="131.37" width="81.3275" height="15.5698" />
                            <rect y="131.37" width="81.3275" height="15.5698" />
                            <rect x="82.3906" width="213.085" height="21.895" />
                            <rect x="150.602" y="216.044" width="76.7761" height="155.184" rx="9.5" fill="white" stroke="black"/>
                            <rect x="314.805" y="175.659" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="314.805" y="235.02" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="314.805" y="294.379" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 107.183 104.133)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 150.511 104.133)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 193.836 104.133)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 237.273 104.133)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 107.183 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 150.511 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 193.836 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 237.273 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 107.183 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 150.511 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 193.836 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 237.273 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 107.183 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 150.511 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 193.836 177.602)" fill="white" stroke="black"/>
                            <rect x="0.502241" y="-0.495755" width="47.6551" height="34.5148" rx="9.5" transform="matrix(0.00451791 -0.99999 0.999964 0.00847983 237.273 177.602)" fill="white" stroke="black"/>
                            <rect x="30.6836" y="175.659" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="30.6836" y="235.02" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="30.6836" y="294.379" width="34.5142" height="47.6555" rx="9.5" fill="white" stroke="black"/>
                            <rect x="165.301" y="266.95" width="47.5002" height="56.9999" fill="url(#pattern0_111_128)"/>
                            <defs>
                                <pattern id="pattern0_111_128" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_111_128" transform="matrix(0.00454545 0 0 0.0037879 0 -0.0113666)"/>
                                </pattern>
                                <image id="image0_111_128" width="220" height="270" xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                        <span class="side-menu__label">Companies</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Companies</a>
                        </li>
                        @if($permissionData && isset($permissionData['company_everything_all']['industry_all']['industry_manage']) && $permissionData['company_everything_all']['industry_all']['industry_manage'] == 'industry_manage')
                        <li>
                            <a href="{{ route('industries.index') }}" class="slide-item">Industry Settings</a>
                        </li>
                        @endif
                        @if($permissionData && isset($permissionData['company_everything_all']['company_all']['company_manage']) && $permissionData['company_everything_all']['company_all']['company_manage'] == 'company_manage')
                        <li>
                            <a href="{{ route('companies.index') }}" class="slide-item">Manage Companies </a>
                        </li>
                        @endif
                        @if($permissionData && isset($permissionData['company_everything_all']['sub_company_all']['sub_company_manage']) && $permissionData['company_everything_all']['sub_company_all']['sub_company_manage'] == 'sub_company_manage')
                        <li>
                            <a href="{{ route('sub_companies.index') }}" class="slide-item">Manage Sub Companies</a>
                        </li>
                        @endif
                        @if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_manage']) && $permissionData['company_everything_all']['location_all']['location_manage'] == 'location_manage')
                        <li>
                            <a href="{{ route('locations.index') }}" class="slide-item">Sub Company Location Settings</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if($permissionData && isset($permissionData['company_users_all']))
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="16" width="20" viewBox="0 0 640 512">
                            <path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/>
                        </svg>
                        <span class="side-menu__label">Company User</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Company User</a>
                        </li>
                        @if($permissionData && isset($permissionData['company_users_all']['department_all']['department_manage']) && $permissionData['company_users_all']['department_all']['department_manage'] == 'department_manage')
                        <li>
                            <a href="{{ route('department.index') }}" class="slide-item"> Department </a>
                        </li>
                        @endif
                        @if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_manage']) && $permissionData['company_users_all']['designation_all']['designation_manage'] == 'designation_manage')
                        <li>
                            <a href="{{ route('designation.index') }}" class="slide-item"> Designation </a>
                        </li>
                        @endif
                        @if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_manage']) && $permissionData['company_users_all']['company_all_user']['company_user_manage'] == 'company_user_manage')
                        <li>
                            <a href="{{ route('company-users.index') }}" class="slide-item"> Company User Settings </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if($permissionData && isset($permissionData['tickets_all']))
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('ticket-assigns.index') }}">
                                <svg height="16" width="20" class="side-menu__icon" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M44.4444 50C19.9306 50 0 72.4219 0 100V150C0 156.875 5.13889 162.266 10.9028 164.531C23.9583 169.609 33.3333 183.594 33.3333 200C33.3333 216.406 23.9583 230.391 10.9028 235.469C5.13889 237.734 0 243.125 0 250V300C0 327.578 19.9306 350 44.4444 350H355.556C380.069 350 400 327.578 400 300V250C400 243.125 394.861 237.734 389.097 235.469C376.042 230.391 366.667 216.406 366.667 200C366.667 183.594 376.042 169.609 389.097 164.531C394.861 162.266 400 156.875 400 150V100C400 72.4219 380.069 50 355.556 50H44.4444ZM88.8889 137.5V262.5C88.8889 269.375 93.8889 275 100 275H300C306.111 275 311.111 269.375 311.111 262.5V137.5C311.111 130.625 306.111 125 300 125H100C93.8889 125 88.8889 130.625 88.8889 137.5ZM66.6667 125C66.6667 111.172 76.5972 100 88.8889 100H311.111C323.403 100 333.333 111.172 333.333 125V275C333.333 288.828 323.403 300 311.111 300H88.8889C76.5972 300 66.6667 288.828 66.6667 275V125Z"/>
                                </svg>
                                <span class="side-menu__label">Tickets</span>
                                <i class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li class="side-menu-label1">
                                    <a href="javascript:void(0)">Tickets</a>
                                </li>
                                @if($permissionData && isset($permissionData['tickets_all']['tickets']['ticket_manage']) && $permissionData['tickets_all']['tickets']['ticket_manage'] == 'ticket_manage')
                                    <li>
                                        <a href="{{ route('tickets.index') }}" class="slide-item"> Ticket List </a>
                                    </li>
                                @endif
                                @if($permissionData && isset($permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_manage']) && $permissionData['ticket_helpers_all']['ticket_nature_all']['ticket_nature_manage'] == 'ticket_nature_manage')
                                    <li>
                                        <a href="{{ route('ticket-natures.index') }}" class="slide-item">Ticket Nature</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                @endif
                @if($permissionData && isset($permissionData['tickets_all']))
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('ticket-assigns.index') }}">
                                <svg width="20" height="20" class="side-menu__icon" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="400" fill="white"/>
                                    <path d="M134.375 282.105C152.49 282.105 167.188 297.769 167.188 317.076V328.732L216.748 289.099C222.422 284.582 229.326 282.105 236.436 282.105H331.25C337.266 282.105 342.188 276.86 342.188 270.449V60.627C342.188 54.2158 337.266 48.9703 331.25 48.9703H68.75C62.7344 48.9703 57.8125 54.2158 57.8125 60.627V270.449C57.8125 276.86 62.7344 282.105 68.75 282.105H134.375ZM167.188 372.445L167.051 372.591L163.564 375.359L151.875 384.685C148.594 387.307 144.15 387.745 140.391 385.778C136.631 383.81 134.375 379.803 134.375 375.359V359.841V355.179V354.96V352.046V317.076H101.562H68.75C44.6191 317.076 25 296.166 25 270.449V60.627C25 34.9093 44.6191 14 68.75 14H331.25C355.381 14 375 34.9093 375 60.627V270.449C375 296.166 355.381 317.076 331.25 317.076H236.436L167.188 372.445Z"/>
                                    <g clip-path="url(#clip0_116_145)">
                                        <path d="M179.536 106C179.536 98.5408 176.582 91.3871 171.324 86.1126C166.067 80.8382 158.936 77.875 151.5 77.875C144.064 77.875 136.933 80.8382 131.676 86.1126C126.418 91.3871 123.464 98.5408 123.464 106C123.464 113.459 126.418 120.613 131.676 125.887C136.933 131.162 144.064 134.125 151.5 134.125C158.936 134.125 166.067 131.162 171.324 125.887C176.582 120.613 179.536 113.459 179.536 106ZM106.643 106C106.643 94.0653 111.369 82.6193 119.781 74.1802C128.194 65.7411 139.603 61 151.5 61C163.397 61 174.806 65.7411 183.219 74.1802C191.631 82.6193 196.357 94.0653 196.357 106C196.357 117.935 191.631 129.381 183.219 137.82C174.806 146.259 163.397 151 151.5 151C139.603 151 128.194 146.259 119.781 137.82C111.369 129.381 106.643 117.935 106.643 106ZM90.277 224.125H212.758C209.639 201.871 190.575 184.75 167.55 184.75H135.52C112.495 184.75 93.431 201.871 90.3121 224.125H90.277ZM73 230.559C73 195.93 100.966 167.875 135.485 167.875H167.515C202.034 167.875 230 195.93 230 230.559C230 236.324 225.339 241 219.592 241H83.4083C77.6609 241 73 236.324 73 230.559Z"/>
                                    </g>
                                    <g clip-path="url(#clip1_116_145)">
                                        <path d="M242.744 204.957C240.422 206.229 240.422 208.293 242.744 209.565L272.457 225.838C274.778 227.11 278.548 227.11 280.87 225.838C283.191 224.567 283.191 222.502 280.87 221.231L261.277 210.511H318.253C321.54 210.511 324.195 209.056 324.195 207.256C324.195 205.456 321.54 204.001 318.253 204.001H261.296L280.851 193.281C283.172 192.01 283.172 189.945 280.851 188.674C278.53 187.402 274.76 187.402 272.438 188.674L242.725 204.947L242.744 204.957Z"/>
                                    </g>
                                    <g clip-path="url(#clip2_116_145)">
                                        <path d="M321.647 182.835C323.968 181.563 323.968 179.498 321.647 178.227L291.934 161.954C289.612 160.682 285.842 160.682 283.521 161.954C281.2 163.225 281.2 165.29 283.521 166.561L303.113 177.281H246.138C242.851 177.281 240.195 178.736 240.195 180.536C240.195 182.336 242.851 183.791 246.138 183.791H303.095L283.54 194.511C281.218 195.782 281.218 197.847 283.54 199.118C285.861 200.39 289.631 200.39 291.952 199.118L321.665 182.845L321.647 182.835Z"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_116_145">
                                            <rect width="157" height="180" fill="white" transform="translate(73 61)"/>
                                        </clipPath>
                                        <clipPath id="clip1_116_145">
                                            <rect width="83.1973" height="52.0755" fill="white" transform="matrix(-1 0 0 -1 324.195 233.294)"/>
                                        </clipPath>
                                        <clipPath id="clip2_116_145">
                                            <rect width="83.1973" height="52.0755" fill="white" transform="translate(242.195 148)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="side-menu__label">Assign & Message</span>
                                <i class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li class="side-menu-label1">
                                    <a href="javascript:void(0)">Assign & Message</a>
                                </li>
                                @if($permissionData && isset($permissionData['tickets_all']['assign_all']['assign_manage']) && $permissionData['tickets_all']['assign_all']['assign_manage'] == 'assign_manage')
                                    <li>
                                        <a href="{{ route('ticket-assigns.index') }}" class="slide-item"> Assign </a>
                                    </li>
                                @endif
                                @if($permissionData && isset($permissionData['tickets_all']['company_user_assign_all']['company_user_assign_manage']) && $permissionData['tickets_all']['company_user_assign_all']['company_user_assign_manage'] == 'company_user_assign_manage')
                                    <li>
                                        <a href="{{ route('ticket-company-assigns.index') }}" class="slide-item">Company User Assign</a>
                                    </li>
                                @endif
                                @if($permissionData && isset($permissionData['tickets_all']['messages_all']['message_manage']) && $permissionData['tickets_all']['messages_all']['message_manage'] == 'message_manage')
                                    <li>
                                        <a href="{{ route('ticket-messages.index') }}" class="slide-item"> Message & Settings</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                @endif
                @if($permissionData && isset($permissionData['ticket_helpers_all']))
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">

                        <svg width="20" height="20" class="side-menu__icon" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="400" fill="white"/>
                            <path d="M294.617 128.156C294.617 144.113 294.691 160.07 294.543 176.027C294.543 178.773 295.434 179.812 297.883 180.703C324.156 190.203 350.43 199.777 376.703 209.351C382.863 211.578 383.457 212.468 383.457 219.074C383.457 252.472 383.457 285.871 383.457 319.269C383.457 324.39 382.566 325.726 377.742 327.508C349.391 337.898 321.039 348.14 292.688 358.605C289.496 359.793 286.75 359.347 283.781 358.308C257.063 348.511 230.27 338.789 203.625 328.992C201.027 328.027 198.801 327.953 196.203 328.918C169.484 338.789 142.766 348.437 116.047 358.308C112.633 359.57 109.516 359.644 106.027 358.308C78.1953 348.066 50.2148 337.898 22.3086 327.73C16.9648 325.801 16.0742 324.687 16.0742 319.121C16.0742 285.203 16.0742 251.359 16 217.441C16 213.359 17.8555 211.207 21.5664 209.871C48.1367 200.297 74.5586 190.574 101.129 181C104.023 179.961 104.988 178.699 104.988 175.508C104.84 143.965 104.914 112.422 104.914 80.8786C104.914 75.5349 105.805 74.2732 110.777 72.4177C138.906 62.1755 167.035 51.9333 195.164 41.5427C198.355 40.3552 201.25 40.4294 204.441 41.5427C232.199 51.7107 259.957 61.8044 287.789 71.9724C293.949 74.199 294.543 75.0154 294.543 81.695C294.617 97.281 294.617 112.718 294.617 128.156ZM28.0977 224.566C28.0234 225.679 27.9492 226.347 27.9492 226.941C27.9492 256.109 27.9492 285.277 27.875 314.445C27.875 316.82 28.9141 317.562 30.8438 318.23C49.25 324.91 67.6562 331.59 86.0625 338.343C92.2969 340.57 98.457 342.797 104.766 345.097C104.914 344.504 104.988 344.281 104.988 343.984C104.988 314.297 104.988 284.683 105.062 254.996C105.062 252.621 103.875 252.176 102.168 251.582C90.5898 247.426 79.0117 243.195 67.4336 238.965C54.5195 234.14 41.5313 229.465 28.0977 224.566ZM282.742 345.097C282.742 314.519 282.742 284.535 282.816 254.476C282.816 252.398 281.629 252.101 280.219 251.582C256.395 242.898 232.57 234.289 208.746 225.531C206.223 224.566 205.703 225.086 205.703 227.683C205.777 256.48 205.777 285.277 205.703 314.074C205.703 316.523 206.594 317.488 208.746 318.23C218.84 321.793 228.859 325.504 238.953 329.215C253.352 334.484 267.75 339.679 282.742 345.097ZM116.789 345.023C117.754 344.726 118.273 344.652 118.867 344.429C143.062 335.597 167.184 326.765 191.453 318.082C193.828 317.265 193.902 315.781 193.902 313.851C193.902 285.277 193.828 256.777 193.977 228.203C193.977 224.863 193.16 224.64 190.34 225.754C166.887 234.437 143.434 242.972 119.906 251.433C117.531 252.324 116.789 253.363 116.863 255.886C116.938 284.461 116.938 312.961 116.938 341.535C116.789 342.574 116.789 343.687 116.789 345.023ZM294.617 344.949C295.434 344.801 295.805 344.726 296.102 344.578C320.52 335.672 344.938 326.765 369.355 318.008C371.805 317.117 371.656 315.558 371.656 313.703C371.656 285.277 371.582 256.851 371.73 228.426C371.73 224.937 370.988 224.64 367.945 225.754C344.492 234.437 321.039 242.972 297.512 251.433C295.285 252.25 294.543 253.215 294.543 255.59C294.691 271.621 294.617 287.726 294.617 303.758C294.617 317.414 294.617 330.996 294.617 344.949ZM193.531 207.422C193.68 206.531 193.828 206.16 193.828 205.789C193.828 176.324 193.828 146.933 193.902 117.468C193.902 115.316 192.863 114.797 191.23 114.203C167.48 105.593 143.73 96.9841 120.055 88.2263C117.531 87.2615 116.715 87.4841 116.789 90.4529C116.863 119.176 116.863 147.824 116.789 176.547C116.789 178.847 117.605 179.738 119.609 180.406C133.859 185.527 148.109 190.722 162.359 195.918C172.602 199.777 182.918 203.488 193.531 207.422ZM282.742 87.9294C281.629 87.4099 281.035 87.9294 280.293 88.1521C256.246 96.9099 232.125 105.742 208.004 114.351C205.629 115.242 205.629 116.652 205.629 118.582C205.629 146.933 205.703 175.211 205.555 203.562C205.555 206.828 206.074 207.57 209.34 206.383C232.645 197.773 256.098 189.238 279.477 180.777C282 179.886 282.742 178.625 282.742 176.027C282.668 147.676 282.668 119.398 282.668 91.0466C282.742 89.9333 282.742 88.82 282.742 87.9294ZM128.516 78.6521C130.074 79.32 130.594 79.5427 131.188 79.7654C153.379 87.8552 175.645 95.8708 197.836 104.109C199.691 104.777 201.176 104.332 202.809 103.738C222.848 96.4646 242.812 89.1169 262.852 81.8435C265.301 80.9529 267.75 79.988 270.199 79.0974C269.754 77.7615 268.863 77.8357 268.195 77.613C246.078 69.5232 224.035 61.5075 201.918 53.3435C200.062 52.6755 198.578 53.0466 197.02 53.6404C181.062 59.5036 165.105 65.2927 149.148 71.156C142.543 73.531 136.012 75.906 128.516 78.6521ZM181.434 216.402C180.617 215.883 180.098 215.511 179.578 215.289C157.238 207.125 134.898 198.961 112.559 190.797C110.926 190.203 109.516 190.351 107.957 190.945C86.582 198.812 65.1328 206.605 43.7578 214.398C42.6445 214.769 41.3086 214.843 40.4922 216.254C41.0117 216.476 41.3828 216.699 41.8281 216.847C64.2422 225.011 86.7305 233.176 109.145 241.414C110.703 242.008 111.965 241.636 113.375 241.191C119.535 238.965 125.621 236.738 131.781 234.511C148.258 228.5 164.66 222.488 181.434 216.402ZM359.93 216.105C358.52 215.437 358.074 215.215 357.629 215.066C335.512 206.976 313.469 198.886 291.352 190.797C289.57 190.129 288.086 190.426 286.379 191.093C271.461 196.586 256.543 202.004 241.625 207.422C233.906 210.242 226.188 213.062 217.949 216.105C219.137 216.625 219.656 216.922 220.176 217.144C242.367 225.234 264.633 233.324 286.824 241.488C288.531 242.156 289.941 241.711 291.426 241.191C303.375 236.812 315.25 232.508 327.199 228.129C337.812 224.195 348.426 220.336 359.93 216.105Z" />
                        </svg>
                        <span class="side-menu__label">Modules </span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Modules</a>
                        </li>
                        @if($permissionData && isset($permissionData['ticket_helpers_all']['module_all']['module_manage']) && $permissionData['ticket_helpers_all']['module_all']['module_manage'] == 'module_manage')
                            <li>
                                <a href="{{ route('modules.index') }}" class="slide-item"> Modules</a>
                            </li>
                        @endif
                        @if($permissionData && isset($permissionData['ticket_helpers_all']['sub_module_all']['sub_module_manage']) && $permissionData['ticket_helpers_all']['sub_module_all']['sub_module_manage'] == 'sub_module_manage')
                            <li>
                                <a href="{{ route('sub-modules.index') }}" class="slide-item"> Sub Modules</a>
                            </li>
                        @endif
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
