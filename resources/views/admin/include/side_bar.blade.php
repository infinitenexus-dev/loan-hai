<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('admin.dashboard.index')}}" class="app-brand-link">
        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="LoanHai">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
            fill="currentColor"
            fill-opacity="0.6" />
          <path
            d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
            fill="currentColor"
            fill-opacity="0.38" />
        </svg>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{route('admin.dashboard.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
      </li>
      {{-- <li class="menu-item">
        <a href="{{route('admin.member.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
            <div data-i18n="Members">Members</div>
        </a>
      </li> --}}
      <li class="menu-item {{ request()->is('admin/customers*') ? 'active' : '' }}">
        <a href="{{route('admin.customers.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-account-circle"></i>
            <div data-i18n="Customers">Customers</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/contactus*') ? 'active' : '' }}">
        <a href="{{route('admin.contactus.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-contacts"></i>
            <div data-i18n="ContactUs">ContactUs</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/agent*') ? 'active' : '' }}">
        <a href="{{route('admin.agent.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-face-agent"></i>
            <div data-i18n="Agent">Agent</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/services*') ? 'active' : '' }}">
        <a href="{{route('admin.services.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-account-wrench"></i>
            <div data-i18n="Services">Services</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/review*') ? 'active' : '' }}">
        <a href="{{route('admin.review.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-star-check"></i>
            <div data-i18n="Review">Review</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/state*') ? 'active' : '' }}">
        <a href="{{route('admin.state.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-home-group"></i>
            <div data-i18n="State">State</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/city*') ? 'active' : '' }}">
        <a href="{{route('admin.city.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-home-city"></i>
            <div data-i18n="City">City</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/privacypolicy*') ? 'active' : '' }}">
        <a href="{{route('admin.privacypolicy.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-lock-check-outline"></i>
            <div data-i18n="PrivacyPolicy">PrivacyPolicy</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/termscondition*') ? 'active' : '' }}">
        <a href="{{route('admin.termscondition.index')}}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-frequently-asked-questions"></i>
            <div data-i18n="TermsCondition">TermsCondition</div>
        </a>
      </li>
    </ul>
  </aside>
