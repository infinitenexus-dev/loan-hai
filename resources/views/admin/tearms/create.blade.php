@extends('admin.include.master')
@section('title', 'Create Or Edit Tearms & Condition')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">Edit Tearms & Condition</h5>
            <form class="card-body" id="tearms-form" action="{{ route('admin.termscondition.update') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="termscondtion_id" class="form-control"
                    value="{{ isset($termscondtion) ? $termscondtion->id : '' }}" />
                <hr class="my-4 mx-n4" />
                <div class="row g-4">
                    <div class="col-md-6">
                        <textarea id="tearms_description" name="tearms_description">{{ $termscondtion->description }}</textarea>
                        @error('tearms_description')
                            <span id="tearms_description" class="error">{{ $message }}</span>
                        @enderror
                        <span id="tearms_description_error"></span>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 proceed-btn">Update</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @push('script')
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('tearms_description', {
                allowedContent: true, // Allow all HTML content
                toolbar: [
                    { name: 'clipboard', items: ['Undo', 'Redo'] },
                    { name: 'styles', items: ['Format', 'FontSize'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'tools', items: ['Maximize'] },
                    { name: 'document', items: ['Source'] },
                    '/',
                    { name: 'others', items: ['Source', 'RemoveFormat'] },
                    { name: 'about', items: ['About'] }
                ]
            });
        });
    </script>
    @endpush
@endsection
