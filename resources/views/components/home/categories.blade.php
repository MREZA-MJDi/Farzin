<section
    class="section home-section home-section--categories"
    aria-labelledby="categories-title"
>
    <div class="container">

        <div class="section__inner">

            <x-ui.section-header
                eyebrow="دسته‌بندی محصولات"
                title="برای هر آشپزخانه، یک انتخاب درست"
                description="محصول مناسب را سریع‌تر پیدا کنید."
                title-id="categories-title"
                centered
            />

            <div class="section-content">

                <div class="category-grid">

                    <x-product.category-card
                        title="هود"
                        eyebrow="آشپزخانه"
                        description="هودهای مدرن با طراحی تمیز و عملکرد قابل اعتماد."
                        image="/images/categories/hood.webp"
                        href="{{ route('category.hood') }}"
                    />

                    <x-product.category-card
                        title="سینک"
                        eyebrow="آشپزخانه"
                        description="سینک‌هایی با طراحی کاربردی و ظاهر ماندگار."
                        image="/images/categories/sink.webp"
                        href="{{ route('category.sink') }}"
                    />

                </div>

            </div>

        </div>

    </div>
</section>
