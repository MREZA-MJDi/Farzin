<section
    class="section home-section home-section--products"
    aria-labelledby="featured-products-title"
>
    <div class="container">

        <div class="section__inner">

            <x-ui.section-header
                eyebrow="محصولات منتخب"
                title="انتخاب‌های محبوب فرزین"
                description="چند انتخاب برای شروع ساده‌تر خرید."
                title-id="featured-products-title"
            >
                <x-slot:action>
                    <a
                        href="{{ route('shop') }}"
                        class="btn btn--outline"
                    >
                        مشاهده همه محصولات
                    </a>
                </x-slot:action>
            </x-ui.section-header>


            <div class="section-content">

                <x-product.product-grid columns="4">

                    <x-product.product-card
                        id="1"
                        name="هود مخفی مدل A"
                        image="{{ asset('images/products/hood-01.webp') }}"
                        href="{{ route('product.show', ['slug' => 'hood-model-a']) }}"
                        :price="12800000"
                        brand="FARZIN"
                        meta="عرض ۷۰ سانتی‌متر"
                        rating="4.8"
                        review-count="18"
                        badge="جدید"
                    />

                    <x-product.product-card
                        id="2"
                        name="سینک توکار مدل A"
                        image="{{ asset('images/products/sink-01.webp') }}"
                        href="{{ route('product.show', ['slug' => 'sink-model-a']) }}"
                        :price="10500000"
                        brand="FARZIN"
                        meta="استیل ضدزنگ"
                        rating="4.9"
                        review-count="27"
                        badge="محبوب"
                    />

                    <x-product.product-card
                        id="3"
                        name="هود شومینه‌ای مدل B"
                        image="{{ asset('images/products/hood-02.webp') }}"
                        href="{{ route('product.show', ['slug' => 'hood-model-b']) }}"
                        :price="15300000"
                        brand="FARZIN"
                        meta="طراحی شیشه‌ای"
                        rating="4.7"
                        review-count="11"
                        badge="پیشنهاد فرزین"
                    />

                    <x-product.product-card
                        id="4"
                        name="سینک روکار مدل B"
                        image="{{ asset('images/products/sink-02.webp') }}"
                        href="{{ route('product.show', ['slug' => 'sink-model-b']) }}"
                        :price="9750000"
                        brand="FARZIN"
                        meta="طراحی کاربردی"
                        rating="4.8"
                        review-count="14"
                        badge="ویژه"
                    />

                </x-product.product-grid>

            </div>

        </div>

    </div>
</section>
