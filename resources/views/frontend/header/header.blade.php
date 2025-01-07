<!-- navigation -->
<header class="navigation bg-tertiary">
    <nav class="navbar navbar-expand-xl navbar-light text-center py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="Frontend/images/logo.png"
                    alt="Loan Hai">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item {{ request()->is('/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item {{ request()->is('about*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item {{ request()->is('work*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('work') }}">How It Works</a>
                    </li>
                    <li class="nav-item {{ request()->is('services*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item {{ request()->is('contact*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <!-- <li class="nav-item ">
                        <a class="nav-link" href="services.html">Terms &amp; Condition</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="services.html">Privacy &amp; Policy</a>
                    </li> -->
                </ul>
                <!-- account btn --> <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal"
                    data-bs-target="#applyLoan">Apply Now </a>
            </div>
        </div>
    </nav>
</header>
<div class="modal applyLoanModal fade" id="applyLoan" tabindex="-1" aria-labelledby="applyLoanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="exampleModalLabel">Unlock Best Loans Offers </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loanForm" action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text"
                                    class="form-control shadow-none @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 pb-2">
                            <div class="form-group">
                                <label for="tel" class="form-label">Mobile Number</label>
                                <input type="tel"
                                    class="form-control shadow-none @error('tel') is-invalid @enderror" id="tel"
                                    name="tel" placeholder="" value="{{ old('tel') }}">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 pb-2">
                            <div class="form-group">
                                <label for="age" class="form-label">Age</label>
                                <input type="number"
                                    class="form-control shadow-none @error('age') is-invalid @enderror" id="age"
                                    name="age" placeholder="Minimum age: 18" value="{{ old('age') }}">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <select class="form-select @error('city') is-invalid @enderror" id="city"
                                    name="city" style="color:black; height: 50px;">
                                    <!-- Adjust the height as needed -->
                                    <option value="" selected>City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if (old('city') == $city->id) selected @endif>{{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <select class="form-select @error('services') is-invalid @enderror" id="services"
                                    name="services" style="color:black; height: 50px;">
                                    <!-- Adjust the height as needed -->
                                    <option value="" selected>Services</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            @if (old('services') == $service->id) selected @endif>
                                            {{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 pb-2">
                            <div class="form-group">
                                <label for="email" class="form-label">Email address</label>
                                <input class="form-control shadow-none @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 pb-2">
                            <div class="form-group">
                                <label for="income" class="form-label">Monthly Income</label>
                                <input type="number"
                                    class="form-control shadow-none @error('income') is-invalid @enderror"
                                    id="income" name="income" value="{{ old('income') }}">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary w-100">Get Your Loan Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>  --}}