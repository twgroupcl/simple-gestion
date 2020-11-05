<div class="border-top border-bottom my-lg-3 py-5">
    <div class="container pt-md-2" id="reviews">
        <livewire:reviews.general-rating :model="$seller">
        <hr class="mt-4 pb-4 mb-3">
        <div class="row">
            <!-- Reviews list-->
            <livewire:reviews.review-list :model="$seller">
            <!-- Leave review form-->
            <livewire:reviews.seller.seller-review-form :seller="$seller">
        </div>
    </div>
</div>
