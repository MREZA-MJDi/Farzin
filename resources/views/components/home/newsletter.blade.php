<section class="section section--sm home-newsletter">

    <div class="container">

        <div class="newsletter">

            <div class="newsletter__content">

                <span class="newsletter__title">
                    انتخاب بعدی شما شاید همین‌جا باشد.
                </span>

                <p class="newsletter__text">
                    محصولات جدید و مطالب کاربردی فرزین را دنبال کنید.
                </p>

            </div>


            <form
                action="/newsletter"
                method="POST"
                class="newsletter__form"
            >

                @csrf

                <label
                    for="newsletter-email"
                    class="sr-only"
                >
                    ایمیل
                </label>

                <input
                    id="newsletter-email"
                    type="email"
                    name="email"
                    class="form-input newsletter__input"
                    placeholder="ایمیل شما"
                    autocomplete="email"
                    required
                >

                <button
                    type="submit"
                    class="btn btn--accent"
                >
                    عضویت
                </button>

            </form>

        </div>

    </div>

</section>
