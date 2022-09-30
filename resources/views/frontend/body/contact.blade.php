@php
    $footer = App\Models\Footer::find(1);
@endphp


<!--script concernant la validation du formulaire-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<section class="homeContact homeContact__style__two">
    <div class="container">
        <div class="homeContact__wrap">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section__title">
                        <span class="sub-title">07 - Say hello</span>
                        <h2 class="title">Any questions? Feel free <br> to contact</h2>
                    </div>
                    <div class="homeContact__content">
                        <p>For any suggestions or more information please send me your message to the address below; thank you for contributing to my learning and my improvement.</p>
                        <h2 class="mail"><a href="mailto:Info@webmail.com">{{ $footer->email }}</a></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="homeContact__form">
                        <form method="POST" action="{{ route('store.contact') }}" id="myFormFoot">
                            @csrf
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Enter name*">
                            </div>
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" name="email" placeholder="Enter mail*">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" class="form-control" name="phone" placeholder="Enter number*">
                            </div>
                            <div class="form-group mb-2">
                                <textarea name="message" class="form-control" placeholder="Enter Massage*"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit">Send Message</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myFormFoot').validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
                message: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter your name',
                },
                email: {
                    required : 'Please Enter your email',
                },
                message: {
                    required : 'Please Enter your message',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>