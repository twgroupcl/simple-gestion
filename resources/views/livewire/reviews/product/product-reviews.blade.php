<div class="border-top border-bottom my-lg-3 py-5">
    <div class="container pt-md-2" id="reviews">
        <livewire:reviews.general-rating :model="$product">
        <hr class="mt-4 pb-4 mb-3">
        <div class="row">
            <!-- Reviews list-->
            <livewire:reviews.review-list :product="$product">
            <!-- Leave review form-->
            <livewire:reviews.product.product-review-form :product="$product">
        </div>
    </div>
</div>
