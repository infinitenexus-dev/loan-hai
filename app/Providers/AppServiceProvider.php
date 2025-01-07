<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('frontend.header.header_link', function ($view) {
            $metaData = $this->getMetaData();
            $view->with('meta', $metaData);
        });

        view()->composer('frontend.header.header', function ($view) {
            $services = Service::select('*')->get();
            $cities = City::orderBy('city', 'asc')->get();
            $view->with('services', $services)->with('cities', $cities);
        });
    }

    protected function getMetaData()
    {
        $url = request()->path();

        $metaData = [
            'title' => 'Get Instant Personal Loan Of Up To Rs. 20 Lakh',
            'description' => 'Loanhai offers a wide range of loans including Personal Loans, Home Improvement Loans, Education Loans, Mobile Loans, New Car Loans, Business Loans, Laptop Loans, and Two Wheeler Loans. Fast approval, low interest rates, and flexible repayment options. Apply online today!',
        ];

        switch ($url) {
            case '/':
                $metaData['title'] = 'Get Instant Personal Loan Online - Apply in 2 Minutes';
                $metaData['description'] = 'Loanhai offers a wide range of loans including Personal Loans, Home Improvement Loans, Education Loans, Mobile Loans, New Car Loans, Business Loans, Laptop Loans, and Two Wheeler Loans. Fast approval, low interest rates, and flexible repayment options. Apply online today!';
                break;

            case 'about':
                $metaData['title'] = 'About Loanhai: Your Trusted Partner in Financial Solutions';
                $metaData['description'] = 'Learn about Loanhai, your trusted partner in financial solutions. Discover our mission, values, and commitment to providing personalized loan options, competitive rates, and excellent customer service. Get to know us and start your journey towards financial stability with Loanhai.';
                break;

            case 'services':
                $metaData['title'] = 'Loanhai Service – Personal Loans up to ₹20 Lakh';
                $metaData['description'] = 'Discover the wide range of services offered by Loanhai, including personal loans, Mobile Loans, New Car Loans, Business Loans, Laptop Loans, and Two Wheeler Loans. Fast approval, low interest rates, and flexible repayment options. Apply online today!';
                break;

            case 'contact':
                $metaData['title'] = 'Loanhai Customer Care Number – Get instant support';
                $metaData['description'] = 'Contact Loanhai Customer Care Number for instant support and assistance with your personal loans. Our dedicated team is here to help you with any queries or issues you may have. Reach out today for quick and reliable customer service.';
                break;

            case 'personal-loan':
                $metaData['title'] = 'Personal Loan - Loanhai: Quick & Easy Personal Loans';
                $metaData['description'] = 'Explore Loanhai Personal Loan options for quick and easy financing solutions. Get competitive rates, flexible terms, and hassle-free application process. Apply now and fulfill your financial needs with Loanhai.';
                break;

            case 'home-improvement-loan':
                $metaData['title'] = 'Home Improvement Loan - Loanhai: Enhance Your Home with Easy Financing';
                $metaData['description'] = 'Upgrade your home with Loanhai Home Improvement Loan. Enjoy easy financing, competitive rates, and flexible repayment options. Transform your living space today with Loanhai.';
                break;

            case 'education-loan':
                $metaData['title'] = 'Education Loan - Loanhai: Empowering Your Future with Education Financing';
                $metaData['description'] = 'Invest in your education with Loanhai Education Loan. Benefit from competitive rates, flexible repayment plans, and quick approval process. Fulfill your academic dreams with Loanhai.';
                break;

            case 'mobile-loan':
                $metaData['title'] = 'Mobile Loan - Loanhai: Upgrade Your Mobile Experience with Easy Financing';
                $metaData['description'] = 'Upgrade to your dream mobile phone with Loanhai Mobile Loan. Enjoy quick approvals, low interest rates, and convenient repayment options. Get your desired device hassle-free with Loanhai.';
                break;

            case 'new-car-loan':
                $metaData['title'] = 'Car Loan - Loanhai: Drive Your Dream Car with Easy Financing';
                $metaData['description'] = 'Get behind the wheel of your dream car with Loanhai New Car Loan. Benefit from competitive rates, flexible terms, and fast approval process. Start your car ownership journey with Loanhai.';
                break;

            case 'business-loan':
                $metaData['title'] = 'Business Loan - Loanhai: Fuel Your Business Growth with Financing Solutions';
                $metaData['description'] = 'Empower your business with Loanhai Business Loan. Enjoy competitive rates, customized financing options, and expert support. Take your business to new heights with Loanhai.';
                break;

            case 'laptop-loan':
                $metaData['title'] = 'Laptop Loan - Loanhai: Upgrade Your Tech Experience with Easy Financing';
                $metaData['description'] = 'Upgrade to your desired laptop with Loanhai Laptop Loan. Benefit from low interest rates, quick approvals, and flexible repayment options. Get the latest tech hassle-free with Loanhai.';
                break;

            case 'two-wheeler-loan':
                $metaData['title'] = 'Two-Wheeler Loan - Loanhai: Ride Your Way with Easy Financing';
                $metaData['description'] = 'Get your dream two-wheeler with Loanhai Two-Wheeler Loan. Enjoy competitive rates, flexible repayment plans, and quick approval process. Start your journey on the road with Loanhai.';
                break;

            default:
                if (preg_match('/^work/', $url)) {
                    $metaData['title'] = 'How It Works - Loanhai: Simplifying Loan Solutions';
                    $metaData['description'] = 'Discover how Loanhai simplifies the loan process to provide you with the best loan solutions. Learn about our quick and efficient application process, competitive interest rates, and personalized loan options. Get started today!';
                }
                break;
        }

        return $metaData;
    }
}
