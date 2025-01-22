@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #414166; color: white; min-height: 100vh;">

    <main class="py-5">
        <!-- Header Section -->
        <div class="text-center">
            <h2 class="text-custom-primary">Physically Meet Here</h2>
        </div>

        <!-- Map Section -->
        <div class="mt-5">
            <div class="row">
                <div class="col-md-12">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1451.8502042819244!2d91.83591!3d22.3387534!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad275971a7ceaf%3A0x1300e42a953c30ec!2sPremier%20University%2C%20Department%20of%20CSE%2C%20Economics%20and%20Law!5e0!3m2!1sen!2sbd!4v1678371460033!5m2!1sen!2sbd" 
                        width="100%" 
                        height="500" 
                        style="border: 0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="text-center mt-4">
                    <h3 class="text-custom-primary">Where to reach us!</h3>
                    <p class="lead text-custom-secondary">
                        For any inquiries! Please contact us.
                    </p>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 bg-dark text-white">
                        <div class="card-body">
                            <h4 class="card-title text-custom-primary">Contact Information</h4>
                            <table class="table table-borderless text-white">
                                <tbody>
                                    <tr>
                                        <th scope="row"><i class="text-custom-primary fa fa-building me-2"></i>Trust Name:</th>
                                        <td>{{ env('TRUST_NAME') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="text-custom-primary fa fa-map-marker me-2"></i>Address:</th>
                                        <td>{{ env('TRUST_ADDRESS') }}, {{ env('TRUST_CITY') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="text-custom-primary fa fa-phone-alt me-2"></i>Phone:</th>
                                        <td>{{ env('TRUST_PHONE') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="text-custom-primary fa fa-envelope me-2"></i>Email:</th>
                                        <td>{{ env('TRUST_EMAIL') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="row mt-5">
            <div class="col-md-12 col-lg-10 col-xxl-8 mx-auto">
                <h3 class="mb-3 text-custom-primary">Get in touch with us</h3>
                <p class="text-custom-secondary">Please fill in all the following fields to get in touch with us.</p>
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <form method="POST" action="{{ route('home.contact.submit') }}">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Oops!</strong> Please clear the errors below:
                                <ul>{!! implode('', $errors->all('<li>:message</li>')) !!}</ul>
                            </div>
                            @endif

                            @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Oops!</strong> {{ Session::get('error') }}
                            </div>
                            @endif
                            @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('success') }}
                            </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control required bg-dark text-white" name="name" placeholder="Your name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control required bg-dark text-white" name="email" placeholder="Email address" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control required bg-dark text-white" name="mobile" placeholder="Mobile number" value="{{ old('mobile') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control required bg-dark text-white" name="message" rows="5" placeholder="Write a message for us...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-custom-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('javascript')
<style>
    .text-custom-primary {
        color:rgb(252, 252, 252);
    }

    .text-custom-secondary {
        color: #cccccc;
    }

    .btn-custom-primary {
        background-color: #1a73e8;
        color: #fff;
        border: none;
    }

    .btn-custom-primary:hover {
        background-color: #1557a1;
        color: #fff;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.required {
        border: 1px solid #ccc;
    }

    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<script>
    $(function() {
        $('form').on("submit", function(e) {
            e.preventDefault();

            let $form = $(this);
            let has_error = false;
            $.each($form.find("input.required"), function() {
                let $field = $(this);
                if ($field.val().trim() == "") {
                    $field.addClass("is-invalid");
                    has_error = true;
                } else {
                    $field.removeClass("is-invalid");
                }
            });

            $.each($form.find("textarea.required"), function() {
                let $field = $(this);
                if ($field.val().trim() == "") {
                    $field.addClass("is-invalid");
                    has_error = true;
                } else {
                    $field.removeClass("is-invalid");
                }
            });

            if (has_error) {
                toastr.error("Please fill in all required fields.", "Oops!");
                return false;
            }

            $form.find(":submit").prop("disabled", true).html("<i class='fa fa-spin fa-spinner'></i> Please wait...");
            $form.unbind("submit").submit();
        });
    });
</script>
@endsection
