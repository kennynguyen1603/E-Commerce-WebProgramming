<div class="contact-container">
    <div class="contact-wrapper">
        <div class="contact-info">
            <h1>Contact Information</h1>
            <p class="info-subtitle">Say something to start a live chat!</p>
            <p class="contact-item">+91 73569 83827</p>
            <p class="contact-item">support@apple.com</p>
            <p class="contact-item">7th Avenue, <br> California Park, Calicut, KL</p>

            <div class="social-icons">
                <!-- Facebook SVG - màu xanh dương -->
                <span class="social-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="#3b5998">
                        <path d="M22.675 0H1.325C.595 0 0 .6 0 1.325v21.351C0 23.4.595 24 1.325 24H12.82V14.708h-3.238V11.08h3.238V8.412c0-3.223 1.966-4.983 4.837-4.983 1.375 0 2.553.101 2.894.148v3.353h-1.986c-1.556 0-1.857.74-1.857 1.822v2.39h3.713l-.485 3.629h-3.228V24h6.331c.73 0 1.325-.6 1.325-1.325V1.325C24 .6 23.4 0 22.675 0z" />
                    </svg>
                </span>

                <!-- Instagram SVG - màu gradient -->
                <span class="social-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="#E1306C">
                        <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.332 3.608 1.308.975.976 1.245 2.242 1.308 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.332 2.633-1.308 3.608-.976.975-2.242 1.245-3.608 1.308-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.976-1.245-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.849c.062-1.366.332-2.633 1.308-3.608.976-.975 2.242-1.245 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.738 0 8.332.015 7.052.072 5.772.129 4.658.345 3.713 1.29c-.945.945-1.161 2.059-1.218 3.339C2.015 8.332 2 8.738 2 12s.015 3.668.072 4.948c.057 1.28.273 2.394 1.218 3.339.945.945 2.059 1.161 3.339 1.218C8.332 21.985 8.738 22 12 22s3.668-.015 4.948-.072c1.28-.057 2.394-.273 3.339-1.218.945-.945 1.161-2.059 1.218-3.339.057-1.28.072-1.686.072-4.948s-.015-3.668-.072-4.948c-.057-1.28-.273-2.394-1.218-3.339-.945-.945-2.059-1.161-3.339-1.218C15.668.015 15.262 0 12 0z" />
                        <path d="M12 5.838a6.163 6.163 0 1 0 0 12.326 6.163 6.163 0 1 0 0-12.326zm0 10.163a3.999 3.999 0 1 1 0-8 3.999 3.999 0 1 1 0 8z" />
                        <circle cx="18.406" cy="5.594" r="1.44" />
                    </svg>
                </span>

                <!-- Twitter SVG - màu xanh dương nhạt -->
                <span class="social-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="#1DA1F2">
                        <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775 1.014-.611 1.794-1.574 2.163-2.724-.95.555-2.005.959-3.127 1.184-.896-.959-2.178-1.555-3.594-1.555-2.717 0-4.917 2.2-4.917 4.917 0 .39.045.765.127 1.124-4.083-.205-7.697-2.158-10.125-5.134-.422.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.062c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.085.631 1.953 2.445 3.376 4.604 3.416-1.68 1.316-3.8 2.101-6.102 2.101-.39 0-.765-.023-1.139-.067 2.191 1.394 4.768 2.205 7.548 2.205 9.056 0 14.003-7.496 14.003-13.986 0-.209 0-.423-.015-.637.961-.69 1.8-1.56 2.46-2.548l-.047-.02z" />
                    </svg>
                </span>
            </div>


            <div class="circle-small"></div>
            <div class="circle-large"></div>
        </div>

        <form class="contact-form" method="post" action="/e-commerce/app/server/contact_handler.php">
            <div class="form-grid">
                <div>
                    <label for="Cách">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Enter your First Name" class="contact-input">
                </div>
                <div>
                    <label for="secondName">Second Name</label>
                    <input type="text" id="secondName" name="secondName" placeholder="Enter your Second Name" class="contact-input">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" class="contact-input">
                </div>
                <div>
                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your Phone Number" class="contact-input">
                </div>
            </div>
            <label for="subject">Select Subject</label>
            <div class="radio-group">
                <label><input type="radio" name="subject" value="general"> General Inquiry</label>
                <label><input type="radio" name="subject" value="support"> Support</label>
                <label><input type="radio" name="subject" value="feedback"> Feedback</label>
                <label><input type="radio" name="subject" value="other"> Other</label>
            </div>
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Enter your Message" class="contact-input"></textarea>
            <input type="submit" value="Send Message" class="submit-button">
        </form>
    </div>
</div>