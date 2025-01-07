@extends('frontend.main_index.main_index')
@section('content')
<section class="page-header bg-tertiary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Added text-center class -->
            <h1>Home Improvement Loan</h1>
            <p>LoanHai provides Home Improvement Loans, assisting customers in enhancing their living spaces. Our services offer accessible funding solutions to support your renovation projects and create the home of your dreams.</p>
        </div>
        <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#applyLoan">Apply Now </a>
    </div>
</section>

<section class="homepage_tab position-relative">
    <div class="section container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="section-title text-center">
                    <h2>Apply for a Personal Loan in 3 easy steps</h2>
                </div>
            </div>
            <div class="col-lg-10">
                <ul class="payment_info_tab nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item m-2" role="presentation"> <a
                            class="nav-link btn btn-outline-primary effect-none text-dark active"
                            id="pills-how-much-can-i-recive-tab" data-bs-toggle="pill"
                            href="#pills-how-much-can-i-recive" role="tab" aria-controls="pills-how-much-can-i-recive"
                            aria-selected="true">Check eligibility</a>
                    </li>
                    <li class="nav-item m-2" role="presentation"> <a
                            class="nav-link btn btn-outline-primary effect-none text-dark "
                            id="pills-how-much-does-it-costs-tab" data-bs-toggle="pill"
                            href="#pills-how-much-does-it-costs" role="tab" aria-controls="pills-how-much-does-it-costs"
                            aria-selected="true">Upload KYC Documents</a>
                    </li>
                    <li class="nav-item m-2" role="presentation"> <a
                            class="nav-link btn btn-outline-primary effect-none text-dark "
                            id="pills-how-do-i-repay-tab" data-bs-toggle="pill" href="#pills-how-do-i-repay" role="tab"
                            aria-controls="pills-how-do-i-repay" aria-selected="true">Get your money</a>
                    </li>
                </ul>
                <div class="rounded shadow bg-white p-5 tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-how-much-can-i-recive" role="tabpanel"
                        aria-labelledby="pills-how-much-can-i-recive-tab">
                        <div class="row align-items-center">
                            <div class="col-md-6 order-1 order-md-0">
                                <div class="content-block">
                                    <h3 class="mb-4">Check eligibility click to apply now and provide your details</h3>
                                    <div class="content">
                                        <p>Discover your eligibility effortlessly and choose from a variety of
                                            personalized personal loan plans. Our streamlined process ensures
                                            convenience and efficiency, allowing you to access the right financial
                                            solution that meets your specific requirements. </p>
                                        <p>With transparent terms and competitive rates, we make it easy for you to make
                                            informed decisions. Experience hassle-free application and swift approval,
                                            ensuring quick access to the funds you need. Take control of your financial
                                            future with our accessible loan options tailored just for you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                                <div class="image-block text-center">
                                    <img loading="lazy" decoding="async" src="Frontend/images/payment-info.png"
                                        alt="How Much Can I Recive?" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade " id="pills-how-much-does-it-costs" role="tabpanel"
                        aria-labelledby="pills-how-much-does-it-costs-tab">
                        <div class="row align-items-center">
                            <div class="col-md-6 order-1 order-md-0">
                                <div class="content-block">
                                    <h3 class="mb-4">Upload KYC Documents</h3>
                                    <div class="content">
                                        <p>Streamline your loan application with ease by uploading your KYC documents
                                            online. Our convenient process ensures quick verification, allowing you to
                                            access personalized loan plans tailored to your needs.</p>
                                        <p>Say goodbye to lengthy paperwork and enjoy a hassle-free experience as you
                                            unlock financial solutions designed to empower your aspirations. Get started
                                            today and take the first step towards achieving your financial goals with
                                            confidence and efficiency.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                                <div class="image-block text-center">
                                    <img loading="lazy" decoding="async" src="Frontend/images/illustration-2.png"
                                        alt="How Much Does It Costs?" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade " id="pills-how-do-i-repay" role="tabpanel"
                        aria-labelledby="pills-how-do-i-repay-tab">
                        <div class="row align-items-center">
                            <div class="col-md-6 order-1 order-md-0">
                                <div class="content-block">
                                    <h3 class="mb-4">Get your money</h3>
                                    <div class="content">
                                        <p>Verify your eligibility, choose a personalized personal loan plan, and
                                            seamlessly upload your KYC documents. Following this process, experience the
                                            efficiency of quick verification and approval, enabling you to access your
                                            funds promptly. </p>
                                        <p>Say goodbye to delays and paperwork hassles; our streamlined approach ensures
                                            you get the money you need without unnecessary delays. Take control of your
                                            financial goals today with our straightforward and efficient loan
                                            disbursement process.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                                <div class="image-block text-center">
                                    <img loading="lazy" decoding="async" src="Frontend/images/illustration-1.png"
                                        alt="How Do I Repay?" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="has-shapes">
            <svg class="shape shape-left text-light" width="290" height="709" viewBox="0 0 290 709" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M-119.511 58.4275C-120.188 96.3185 -92.0001 129.539 -59.0325 148.232C-26.0649 166.926 11.7821 174.604 47.8274 186.346C83.8726 198.088 120.364 215.601 141.281 247.209C178.484 303.449 153.165 377.627 149.657 444.969C144.34 546.859 197.336 649.801 283.36 704.673"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M-141.434 72.0899C-142.111 109.981 -113.923 143.201 -80.9554 161.895C-47.9878 180.588 -10.1407 188.267 25.9045 200.009C61.9497 211.751 98.4408 229.263 119.358 260.872C156.561 317.111 131.242 391.29 127.734 458.631C122.417 560.522 175.414 663.463 261.437 718.335"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M-163.379 85.7578C-164.056 123.649 -135.868 156.869 -102.901 175.563C-69.9331 194.256 -32.086 201.934 3.9592 213.677C40.0044 225.419 76.4955 242.931 97.4127 274.54C134.616 330.779 109.296 404.957 105.789 472.299C100.472 574.19 153.468 677.131 239.492 732.003"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M-185.305 99.4208C-185.982 137.312 -157.794 170.532 -124.826 189.226C-91.8589 207.919 -54.0118 215.597 -17.9666 227.34C18.0787 239.082 54.5697 256.594 75.4869 288.203C112.69 344.442 87.3706 418.62 83.8633 485.962C78.5463 587.852 131.542 690.794 217.566 745.666"
                    stroke="currentColor" stroke-miterlimit="10" />
            </svg>
            <svg class="shape shape-right text-light" width="474" height="511" viewBox="0 0 474 511" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M601.776 325.899C579.043 348.894 552.727 371.275 520.74 375.956C478.826 382.079 438.015 355.5 412.619 321.6C387.211 287.707 373.264 246.852 354.93 208.66C336.584 170.473 311.566 132.682 273.247 114.593C220.12 89.5159 155.704 108.4 99.7772 90.3769C53.1531 75.3464 16.3392 33.2759 7.65012 -14.947"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M585.78 298.192C564.28 319.945 539.378 341.122 509.124 345.548C469.472 351.341 430.868 326.199 406.845 294.131C382.805 262.059 369.62 223.419 352.278 187.293C334.936 151.168 311.254 115.417 275.009 98.311C224.74 74.582 163.815 92.4554 110.913 75.3971C66.8087 61.1784 31.979 21.3767 23.7639 -24.2362"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M569.783 270.486C549.5 290.99 526.04 310.962 497.501 315.13C460.111 320.592 423.715 296.887 401.059 266.641C378.392 236.402 365.963 199.965 349.596 165.901C333.24 131.832 310.911 98.1265 276.74 82.0034C229.347 59.6271 171.895 76.4848 122.013 60.4086C80.419 47.0077 47.5905 9.47947 39.8431 -33.5342"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M553.787 242.779C534.737 262.041 512.691 280.809 485.884 284.722C450.757 289.853 416.568 267.586 395.286 239.173C373.993 210.766 362.308 176.538 346.945 144.535C331.581 112.533 310.605 80.8723 278.502 65.7217C233.984 44.6979 180.006 60.54 133.149 45.4289C94.0746 32.8398 63.2303 -2.41965 55.9568 -42.8233"
                    stroke="currentColor" stroke-miterlimit="10" />
                <path
                    d="M537.791 215.073C519.964 233.098 499.336 250.645 474.269 254.315C441.41 259.126 409.422 238.286 389.513 211.704C369.594 185.13 358.665 153.106 344.294 123.17C329.923 93.2337 310.293 63.6078 280.258 49.4296C238.605 29.7646 188.105 44.5741 144.268 30.4451C107.714 18.6677 78.8538 -14.3229 72.0543 -52.1165"
                    stroke="currentColor" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-5 pb-2">
                    <p class="text-primary text-uppercase fw-bold mb-3">Things To Know</p>
                    <h2>Now get a loan on your own terms with our flexible EMI options and take control of what & when
                        you pay</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordion shadow rounded py-5 px-0 px-lg-4 bg-white position-relative" id="accordionFAQ">
                    <div class="accordion-item p-1 mb-2">
                        <h2 class="accordion-header accordion-button h5 border-0 active"
                            id="heading-ebd23e34fd2ed58299b32c03c521feb0b02f19d9" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-ebd23e34fd2ed58299b32c03c521feb0b02f19d9" aria-expanded="true"
                            aria-controls="collapse-ebd23e34fd2ed58299b32c03c521feb0b02f19d9">Eliginility Criteria
                        </h2>
                        <div id="collapse-ebd23e34fd2ed58299b32c03c521feb0b02f19d9"
                            class="accordion-collapse collapse border-0 show"
                            aria-labelledby="heading-ebd23e34fd2ed58299b32c03c521feb0b02f19d9"
                            data-bs-parent="#accordionFAQ">
                            <div class="accordion-body py-0 content">
                                <p><b>Are you eligible for a personal loan?</b>
                                    <br>To be eligible to get a personal loan from LoanHai, you should fulfil the
                                    following eligibility criteria
                                </p>

                                <ul>
                                    <li class="li_color_marker">Resident of India</li>
                                    <li class="li_color_marker">Age: 18 years to 60 years</li>
                                    <li class="li_color_marker">Employment Type: Salaried and Self-employed</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item p-1 mb-2">
                        <h2 class="accordion-header accordion-button h5 border-0 "
                            id="heading-a443e01b4db47b3f4a1267e10594576d52730ec1" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-a443e01b4db47b3f4a1267e10594576d52730ec1" aria-expanded="false"
                            aria-controls="collapse-a443e01b4db47b3f4a1267e10594576d52730ec1">Documets Required
                        </h2>
                        <div id="collapse-a443e01b4db47b3f4a1267e10594576d52730ec1"
                            class="accordion-collapse collapse border-0 "
                            aria-labelledby="heading-a443e01b4db47b3f4a1267e10594576d52730ec1"
                            data-bs-parent="#accordionFAQ">
                            <div class="accordion-body py-0 content">
                                <p><b>Which documents are required to get a personal loan?</b>
                                    <br>To get a personal loan instantly, you should keep some documents handy before
                                    you start applying.
                                </p>
                            </div>
                            <ul>
                                <li class="li_color_marker">Proof of Identity<br><small>PAN Card & Selfie</small>
                                </li>
                                <li class="li_color_marker">Proof of Address<br><small>Aadhaar card, Voter ID,
                                        Passport or Driving License</small></li>
                                <li class="li_color_marker">Proof of Income<br><small>Net-Banking or last 3 months
                                        bank e-statements</small></li>

                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item p-1 mb-2">
                        <h2 class="accordion-header accordion-button h5 border-0 "
                            id="heading-4b82be4be873c8ad699fa97049523ac86b67a8bd" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-4b82be4be873c8ad699fa97049523ac86b67a8bd" aria-expanded="false"
                            aria-controls="collapse-4b82be4be873c8ad699fa97049523ac86b67a8bd">Credit Score
                        </h2>
                        <div id="collapse-4b82be4be873c8ad699fa97049523ac86b67a8bd"
                            class="accordion-collapse collapse border-0 "
                            aria-labelledby="heading-4b82be4be873c8ad699fa97049523ac86b67a8bd"
                            data-bs-parent="#accordionFAQ">
                            <div class="accordion-body py-0 content">
                                <p><b>What is a good credit score required to get a personal loan?</b><br>Have you ever
                                    been to a bank for a personal loan and got rejected because your credit score was
                                    low? Yeah, we get you! Credit Score is a 3-digit number on which banks and NBFCs
                                    (Non Banking Financial Corporations, such as loan and insurance companies,
                                    co-operative banks, stock broking firms, etc.) evaluate your capacity to pay the
                                    loan on time.

                                </p>
                            </div>
                            <table class="ScoreTable_score-table__ymuTe" style="text-align: center;">
                                <thead>
                                    <tr style="    background-color: #51B56D;
    color: black;">
                                        <th>Range</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-f-14">0 or -1</td>
                                        <td class="ps-f-14">No Credit History</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-f-14">300 - 550</td>
                                        <td class="ps-f-14">Bad</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-f-14">551 - 649</td>
                                        <td class="ps-f-14">Poor</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-f-14">650 - 699</td>
                                        <td class="ps-f-14">Fair</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-f-14">700 - 749</td>
                                        <td class="ps-f-14">Good</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-f-14">750 and above</td>
                                        <td class="ps-f-14">Excellent</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="shadow rounded py-5 px-4 ms-0 ms-lg-4 bg-white position-relative">
                    <div class="block mx-0 mx-lg-3 mt-0">
                        <h4 class="h5">Still Have Questions?</h4>
                        <div class="content">Call Us We Will Be Happy To Help
                            <br> <a href="tel:+919558633008">+91 95586 33008</a>
                            <br>Monday - Friday
                            <br>9AM TO 8PM
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection