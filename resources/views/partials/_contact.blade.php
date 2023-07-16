<div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
    <p>Lets get in touch and talk about your next project.</p>

    <div id="success-message" style="display: none;">
        <p>Thank you for your message. We will get back to you soon.</p>
    </div>
    <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <input class="w3-input w3-border" type="text" placeholder="Name"  name="name">
        <span class="error-message" id="name-error"></span>
        <input class="w3-input w3-section w3-border" type="text" placeholder="Email"  name="email">
        <span class="error-message" id="email-error"></span>
        <input class="w3-input w3-section w3-border" type="text" placeholder="Subject"  name="subject">
        <span class="error-message" id="subject-error"></span>
        <textarea class="w3-input w3-border" id="message" name="comment" placeholder="Comment">{{ old('comment') }}</textarea>
        <span class="error-message" id="comment-error"></span><br>
        <button class="w3-button w3-yellow w3-section" type="submit" id="submit-btn">
            <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
        <div id="loading-spinner" style="display: none;">
            <i class="fa fa-spinner fa-spin"></i> Sending...
        </div>
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $('#contact-form').submit(function(event) {
        event.preventDefault();

        $('.error-message').text('');

        $('#submit-btn').prop('disabled', true);
        $('#submit-btn').text('');
        $('#loading-spinner').show();

        var formData = new FormData(this);


        axios.post($(this).attr('action'), formData)
            .then(function(response) {
                $('#contact-form').hide();
                $('#success-message').show();
            })
            .catch(function(error) {
                if (error.response.status === 422) {
                    var errors = error.response.data.errors;
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            var errorMessage = errors[field][0];
                            $('#' + field + '-error').text(errorMessage);
                        }
                    }
                } else {

                }
            })
            .finally(function() {
                $('#submit-btn').prop('disabled', false);
                $('#submit-btn').text('SEND MESSAGE');
                $('#loading-spinner').hide();
            });
    });
</script>
